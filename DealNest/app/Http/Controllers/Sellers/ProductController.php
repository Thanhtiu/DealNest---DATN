<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\ProductVariant;
use App\Models\Review;


class ProductController extends Controller
{
    public function index()
    {
        return view('sellers.products.list');
    }

    public function store()
    {
        // Lấy danh sách thể loại
        $category = Category::where('parent_id', 0)->get();
        $country = Country::all();

        return view('sellers.products.create', compact('category', 'country'));
    }

    public function getSubCategories($id)
    {

        // Lấy danh sách thể loại con từ thể loại cha có id là $id
        $subCategories = Category::where('parent_id', $id)->get();
        // Trả về response dạng JSON cho Ajax
        return response()->json($subCategories);
    }
    public function create(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0', // Assuming MRP is optional
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'country_id' => 'required|integer|',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,webp|max:2048', // Image validation
            'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,webp|max:2048', // Validate uploaded images (if using multiple uploads)
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug đã tồn tại.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'mrp.numeric' => 'Giá bán lẻ phải là số.',
            'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'country_id.required' => 'Thương hiệu là bắt buộc.',
            'image.image' => 'Ảnh bìa phải là hình ảnh.',
            'img.*.image' => 'Hình ảnh phải là hình ảnh.',
        ]);
        // return dd($request->all());

        $sellerId = Session::get('sellerId');

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
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'mrp' => $request->mrp,
            'image' => $imageName,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'trash_can' => 1,
        ]);

        // Xử lý ảnh phụ
        if ($request->hasFile('img')) {
            $images = $request->file('img');
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                Product_image::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
            }
        }

        $attributes = $request->input('attributes'); // Lấy dữ liệu biến thể từ request

        foreach ($attributes as $attribute) {
            if (!empty($attribute['value'])) {
                foreach ($attribute['value'] as $key => $value) {
                    // Kiểm tra nếu giá trị không rỗng
                    if (!empty($value)) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'variant' => $attribute['variant'], // Tên thuộc tính (Kích thước hoặc Màu sắc)
                            'value' => $value, // Giá trị của thuộc tính (S, M, L, Đỏ, Đen, Tím, ...)
                            'price' => isset($attribute['price'][$key]) ? $attribute['price'][$key] : null, // Giá (null nếu không có)
                        ]);
                    }
                }
            }
        }


        return redirect()->route('seller.product.list')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function list()
    {
        $sellerId = Session::get('sellerId');

        $productAll = Product::where('seller_id', $sellerId)
            ->where('trash_can', '!=', 0)
            ->with(['parent', 'product_image'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $productSuccess = Product::where('seller_id', $sellerId)
            ->where('status', 'approved')
            ->where('trash_can', '!=', 0)
            ->with(['parent', 'product_image'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $productPending = Product::where('seller_id', $sellerId)
            ->where('status', 'pending')
            ->where('trash_can', '!=', 0)
            ->with(['parent', 'product_image'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $productFail = Product::where('seller_id', $sellerId)
            ->where('status', 'cancel')
            ->where('trash_can', '!=', 0)
            ->with(['parent', 'product_image'])
            ->orderBy('created_at', 'desc')
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
        $product = Product::with(['productVariants', 'category.parent'])->findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        $country = Country::all();
        return view('sellers.products.edit', compact('categories', 'product', 'country'));
    }

    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'country_id' => 'required|integer|',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,webp|max:2048',
            'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif,webp|max:2048',
        ], [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'slug.required' => 'Slug không được để trống.',
            'slug.unique' => 'Slug đã tồn tại.',
            'category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'mrp.numeric' => 'Giá bán lẻ phải là số.',
            'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'country_id.required' => 'Thương hiệu là bắt buộc.',
            'image.image' => 'Ảnh bìa phải là hình ảnh.',
            'img.*.image' => 'Hình ảnh phải là hình ảnh.',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($product && $product->image && file_exists(public_path('uploads/' . $product->image))) {
                unlink(public_path('uploads/' . $product->image));
            }

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $product->image = $imageName;
        } else {
            $imageName = $product->image;
        }

        // Cập nhật sản phẩm
        $product->update([
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'mrp' => $request->mrp,
            'image' => $imageName,
            'description' => $request->description,
            'quantity' => $request->quantity,
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

                if ($productImage) {
                    $productImage->update([
                        'image' => $fileName
                    ]);
                }
            }
        }


        // Cập nhật biến thể sản phẩm
        ProductVariant::where('product_id', $product->id)->delete();
        $attributes = $request->input('attributes');
        foreach ($attributes as $attribute) {
            if (!empty($attribute['value'])) {
                foreach ($attribute['value'] as $key => $value) {
                    if (!empty($value)) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'variant' => $attribute['variant'],
                            'value' => $value,
                            'price' => isset($attribute['price'][$key]) ? $attribute['price'][$key] : null,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
    }


    public function listTrashCan()
    {
        $sellerId = Session::get('sellerId');
        $products = Product::where('seller_id', operator: $sellerId)
            ->where('trash_can', 'false')->with('parent')->orderBy('created_at', 'desc')->get();
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
            $productImage->delete();
        }

        $product->delete();
        return redirect()->route('seller.product.list')->with('success', 'Product deleted successfully!');
    }

    public function review($id)
    {
        $reviews = Review::where('product_id', $id)
            ->with(['user', 'images'])
            ->orderBy('created_at', 'desc')
            ->get();

        $startCounts = Review::where('product_id', $id)
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $stars = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];



        foreach ($startCounts as $rating => $count) {
            $stars[$rating] = $count;
        }

        $reviewCounts = Review::where('product_id', $id)->count();

        $averageRating = Review::where('product_id', $id)->avg('rating');

        

        return view('sellers.products.review', compact('reviews', 'reviewCounts','startCounts', 'stars','averageRating'));
    }
    public function reviewDestroy($id)
    {
        $review = Review::find($id);

        if ($review) {
            $review->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Đánh giá không tồn tại.'], 404);
    }
}
