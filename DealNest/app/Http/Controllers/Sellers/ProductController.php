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

        $product = Product::create([
            'seller_id' => 1,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subCategory_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'brand_id' => $request->brand_id,
            'status' => 0,
        ]);

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


        if ($request->has('attributes')) {

            $attributes = $request->input('attributes');


            foreach ($attributes as $attributeId => $values) {
                echo "Attribute ID: " . $attributeId . "<br>";

                // các giá trị của thuộc tính
                foreach ($values as $value) {
                    echo "Attribute Value: " . $value . "<br>";

                    Product_attribute::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'value' => $value
                    ]);
                }
            }
        } else {
            echo 'No attributes found';
        }
    return redirect()->route('seller.product.list');
        
    }

    public function list()
    {
        $productAll = Product::with(['subCategory', 'product_image'])->get();
        $productSuccess = Product::where('status', 1)->with('product_image')->get();
        $productPending = Product::where('status', 0)->with('product_image')->get();
        $productFail = Product::where('status', 2)->with('product_image')->get();

        $countProductAll = $productAll->count();
        $countProductSuccess = $productSuccess->count();
        $countProductPending = $productPending->count();
        $countProductFail = $productFail->count();

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
    // Find the product
    $product = Product::find($id);
    
    // Handle image updates
    if ($request->hasFile('img')) {
        foreach ($request->file('img') as $imageId => $file) {
            // Find the existing image
            $productImage = Product_image::find($imageId);

            // If image exists, delete the old file
            if ($productImage && file_exists(public_path('uploads/' . $productImage->url))) {
                unlink(public_path('uploads/' . $productImage->url));
            }

            // Upload new image
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

    // Handle attribute updates
    if ($request->has('attributes')) {
        $attributes = $request->input('attributes');

        // First, delete all old attributes for this product
        Product_attribute::where('product_id', $product->id)->delete();

        // Now insert the updated attributes
        foreach ($attributes as $attributeId => $values) {
            foreach ($values as $value) {
                // Create new product attribute
                Product_attribute::create([
                    'product_id' => $product->id,
                    'attribute_id' => $attributeId,
                    'value' => $value
                ]);
            }
        }
    } else {
        return redirect()->back()->with('error', 'No attributes found.');
    }

    // Redirect back with success message
    return redirect()->back()->with('success', 'Product updated successfully!');
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

