<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Attribute;
use App\Models\Product_attribute;


class ProductController extends Controller
{
    public function index()
    {
        return view('sellers.products.list');
    }

    public function store()
    {
        // Lấy danh sách thể loại
        $category = Category::all();
        $brand = Brand::all();
        $attribute = Attribute::all();
        return view('sellers.products.create', compact('category', 'brand', 'attribute'));
    }

    public function getSubCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subCategories);
    }

    public function create(Request $request)
    {
        try {
            $sellerId = Session::get('sellerId');

            // Validate request data
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'subCategory_id' => 'required|integer|exists:subcategories,id',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'brand_id' => 'required|integer|exists:brands,id',
                'img' => 'required|array|min:5|max:10', // Validate the number of images
                'img.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Validate image files
                'attributes' => 'required', // Ensure attributes are present

                'attributes.*.*' => 'required|string|max:255', // Ensure each attribute value is a non-empty string
            ], [
                'name.required' => 'Tên sản phẩm không được để trống.',
                'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
                'subCategory_id.required' => 'Danh mục con là bắt buộc.',
                'price.required' => 'Giá sản phẩm là bắt buộc.',
                'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
                'brand_id.required' => 'Thương hiệu là bắt buộc.',
                'img.required' => 'Bạn phải tải lên từ 5 đến 10 hình ảnh.',
                'img.array' => 'Hình ảnh phải được gửi dưới dạng mảng.',
                'img.min' => 'Bạn phải tải lên ít nhất 5 hình ảnh.',
                'img.max' => 'Bạn không thể tải lên quá 10 hình ảnh.',
                'img.*.image' => 'Tệp ảnh không hợp lệ.',
                'img.*.mimes' => 'Tệp ảnh phải có định dạng jpg, jpeg, webp,png hoặc gif.',
                'img.*.max' => 'Tệp ảnh không được vượt quá 2MB.',
                'attributes.required' => 'Bạn phải chọn ít nhất một thuộc tính.',
                'attributes.*.*.required' => 'Giá trị thuộc tính không được để trống.',
                'attributes.*.*.max' => 'Giá trị thuộc tính không được vượt quá 255 ký tự.',
            ]);


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Lưu ảnh vào thư mục 'public/products'
                $image->move(public_path('uploads'), $imageName);
            }
            // Create product
            $product = Product::create([
                'seller_id' => $sellerId,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subCategory_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'brand_id' => $request->brand_id,
                'status' => 'Chờ phê duyệt',
                'image' => $imageName,

            ]);

            // Handle image uploads
            if ($request->hasFile('img')) {
                $images = $request->file('img');
                foreach ($images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $imageName);

                    Product_image::create([
                        'product_id' => $product->id,
                        'url' => $imageName
                    ]);
                }
            }

            // Handle attributes
            if ($request->has('attributes')) {
                $attributes = $request->input('attributes');
                foreach ($attributes as $attributeId => $values) {
                    foreach ($values as $value) {
                        // Nếu giá trị là 1 hoặc 2, bỏ qua và không tạo bản ghi mới
                        if ($value == 1 || $value == 2) {
                            continue; // Bỏ qua giá trị này
                        }

                        // Tạo bản ghi mới nếu giá trị không phải là 1 hoặc 2
                        Product_attribute::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attributeId,
                            'value' => $value
                        ]);
                    }
                }
            }


            return redirect()->route('seller.product.list')->with('success', 'Thêm sản phẩn thành công.');

        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error creating product: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function list()
    {
        $sellerId = Session::get('sellerId');

        // Fetch products based on seller's ID
        $productAll = Product::where('seller_id', $sellerId)
            ->where('trash_can', '!=', 0)
            ->with(['subCategory', 'product_image'])
            ->paginate(10);

        $productSuccess = Product::where('seller_id', $sellerId)
            ->where('status', 'Đã phê duyệt')
            ->where('trash_can', '!=', 0)
            ->with('product_image')
            ->paginate(10);

        $productPending = Product::where('seller_id', $sellerId)
            ->where('status', 'Chờ phê duyệt')
            ->where('trash_can', '!=', 0)
            ->with('product_image')
            ->paginate(10);

        $productFail = Product::where('seller_id', $sellerId)
            ->where('status', 'Từ chối')
            ->where('trash_can', '!=', 0)
            ->with('product_image')
            ->paginate(10);

        // Đếm tổng số lượng sản phẩm
        $countProductAll = $productAll->total();
        $countProductSuccess = $productSuccess->total();
        $countProductPending = $productPending->total();
        $countProductFail = $productFail->total();

        return view('sellers.products.list', compact(
            'productAll',
            'productSuccess',
            'productPending',
            'productFail',
            'countProductAll',
            'countProductSuccess',
            'countProductPending',
            'countProductFail'
        ));
    }


    public function edit($id)
    {
        $category = Category::all();
        $brand = Brand::all();
        $attribute = Attribute::all();
        $product = Product::with(['product_image', 'product_attribute.attribute'])->find($id);
        // return dd($product->product_attribute);
        return view('sellers.products.edit', compact(
            'category',
            'brand',
            'attribute',
            'product'
        ));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'brand_id' => 'required|integer|exists:brands,id',

            'attributes' => 'required|array', // Ensure attributes are present
            'attributes.*.*' => 'required|string|max:255', // Ensure each attribute value is a non-empty string
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'brand_id.required' => 'Thương hiệu là bắt buộc.',
            'attributes.required' => 'Bạn phải chọn ít nhất một thuộc tính.',
            'attributes.array' => 'Các thuộc tính phải là mảng.',
            'attributes.*.*.required' => 'Giá trị thuộc tính không được để trống.',
            'attributes.*.*.string' => 'Giá trị thuộc tính phải là chuỗi.',
            'attributes.*.*.max' => 'Giá trị thuộc tính không được vượt quá 255 ký tự.',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Kiểm tra và xóa ảnh cũ nếu tồn tại
            if ($product && $product->image && file_exists(public_path('uploads/' . $product->image))) {
                unlink(public_path('uploads/' . $product->image));
            }

            // Lưu ảnh mới
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            // Cập nhật thông tin ảnh mới
            $product->image = $imageName;
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'subCategory_id' => $request->input('subCategory_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'brand_id' => $request->input('brand_id'),
            'status' => 'Chờ phê duyệt',
            'image' => isset($imageName) ? $imageName : $product->image // Chỉ cập nhật image nếu có ảnh mới
        ]);


        // Handle image uploads
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $imageId => $file) {
                $productImage = Product_image::find($imageId);
                if ($productImage && file_exists(public_path('uploads/' . $productImage->url))) {
                    unlink(public_path('uploads/' . $productImage->url));
                }

                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);

                // Update image record
                if ($productImage) {
                    $productImage->update([
                        'url' => $fileName
                    ]);
                }
            }
        }

        // Handle attributes
        if ($request->has('attributes')) {
            $attributes = $request->input('attributes');

            // Remove old attributes
            Product_attribute::where('product_id', $product->id)->delete();

            // Add new attributes
            foreach ($attributes as $attributeId => $values) {
                foreach ($values as $value) {
                    if (!empty($value)) { // Kiểm tra giá trị không rỗng
                        Product_attribute::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attributeId,
                            'value' => $value
                        ]);
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'No attributes found.');
        }


        // Redirect back with success message
        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
    }


    public function listTrashCan()
    {
        $sellerId = Session::get('sellerId');
        $products = Product::where('seller_id', operator: $sellerId)
            ->where('trash_can', 'false')->get();
        return view('sellers.products.listTrashCan', compact('products'));
    }

    // xóa mềm
    public function softDelete($id)
    {
        $product = Product::find($id);
        $product->trash_can = 0;
        $product->save();
        return redirect()->back()->with('success', 'Xóa thành công!');

    }

    // khôi phục
    public function restore($id)
    {
        $product = Product::find($id);
        $product->trash_can = 1;
        $product->save();
        return redirect()->back()->with('success', 'Khôi phục thành công!');
    }


    // xóa sản phẩm
    public function delete($id)
    {
        $product = Product::find($id);


        // Xóa tất cả hình ảnh liên quan đến sản phẩm
        $productImages = Product_image::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            // Xóa tệp hình ảnh nếu tồn tại
            if (file_exists(public_path('uploads/' . $productImage->url))) {
                unlink(public_path('uploads/' . $productImage->url));
            }
            // Xóa hình ảnh từ cơ sở dữ liệu
            $productImage->delete();
        }

        // Xóa tất cả các thuộc tính liên quan đến sản phẩm
        Product_attribute::where('product_id', $product->id)->delete();

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('seller.product.list')->with('success', 'Product deleted successfully!');
    }



}

