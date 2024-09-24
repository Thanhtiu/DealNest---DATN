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
use App\Models\Variants;
use App\Models\Variant_price;


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
        return view('sellers.products.create', compact('category', 'brand'));
    }

    public function getSubCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subCategories);
    }

    public function create(Request $request)
    {
        try {
            return dd($request->all()); 
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
                'img' => 'required|array|min:5|max:10', // Validate số lượng ảnh
                'img.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Validate ảnh
                'attributes' => 'required|array', // Validate biến thể chính
                'attributes.*.name' => 'required|string|max:255', // Tên biến thể chính
                'attributes.*.values' => 'required|array', // Các biến thể con
                'attributes.*.values.*.value' => 'required|string|max:255', // Tên biến thể con
                'attributes.*.values.*.price' => 'nullable|numeric|min:0', // Giá của từng biến thể con
            ]);

            // Xử lý ảnh chính của sản phẩm
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
            }

            // Tạo sản phẩm
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

            // Xử lý biến thể (thêm biến thể chính và con)
            foreach ($request->attributes as $attribute) {
                // Lưu biến thể chính
                $variant = Variants::create([
                    'product_id' => $productId, // Thay đổi với ID sản phẩm thực tế
                    'type' => $attribute['name'], // Tên biến thể chính
                    'value' => null // Chưa có giá trị cụ thể
                ]);
        
                // Kiểm tra nếu có giá trị con
                if (isset($attribute['values'])) {
                    foreach ($attribute['values'] as $value) {
                        // Nếu giá không phải là null, lưu vào bảng variant_price
                        if (!is_null($value['price'])) {
                            Variant_price::create([
                                'variant_id' => $variant->id,
                                'price' => $value['price'],
                            ]);
                        }
                    }
                }
            }

            // Xử lý ảnh phụ
            if ($request->hasFile('img')) {
                $images = $request->file('img');
                foreach ($images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $imageName);

                    Product_image::create([
                        'product_id' => $product->id,
                        'url' => $imageName,
                    ]);
                }
            }

            return redirect()->route('seller.product.list')->with('success', 'Thêm sản phẩm thành công.');

        } catch (\Exception $e) {
            \Log::error('Error creating product: ' . $e->getMessage());
            dd($e->getMessage());
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
        $product = Product::with(['product_image', 'product_attribute.attribute'])->find($id);
        // return dd($product->product_attribute);
        return view('sellers.products.edit', compact(
            'category',
            'brand',
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

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('seller.product.list')->with('success', 'Product deleted successfully!');
    }



}

