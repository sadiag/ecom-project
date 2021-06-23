<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use Image;
use Carbon\Carbon;



class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // ******add product***

    public function addProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.add',compact('categories','brands'));
    }

    // ****store product*********
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'category_id' => 'required|max:255',
            'brand_id' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'image_one' => 'required|mimes:jpg,jpeg,png,gif',
            'image_two' => 'required|mimes:jpg,jpeg,png,gif',
            'image_three' => 'required|mimes:jpg,jpeg,png,gif',
        ],[
            'category_id.required' => 'select category name',
            'brand_id.required' => 'select brand name',
            
        ]);

        $imag_one =  $request->file('image_one');
        $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
        Image::make($imag_one)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url1 = 'frontend/img/product/upload/'.$name_gen;

        $imag_two =  $request->file('image_two');
        $name_gen = hexdec(uniqid()).'.'.$imag_two->getClientOriginalExtension();
        Image::make($imag_two)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url2 = 'frontend/img/product/upload/'.$name_gen;

        $imag_three =  $request->file('image_three');
        $name_gen = hexdec(uniqid()).'.'.$imag_three->getClientOriginalExtension();
        Image::make($imag_three)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url3 = 'frontend/img/product/upload/'.$name_gen;

        product::insert([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code' => $request->product_code,
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $img_url1,
            'image_two' => $img_url2,
            'image_three' => $img_url3,
            'created_at' => Carbon::now(),

        ]);

        return Redirect()->back()->with('success', 'Product Added');

}
// ***********manage product******
public function manageProduct(){

    $products = Product::latest()->get();
    return view('admin.product.manage',compact('products'));
}
// *********edit product*****

public function editProduct($product_id){

    $product = Product::findOrFail($product_id);
    $categories = Category::latest()->get();
    $brands = Brand::latest()->get();
    return view('admin.product.edit',compact('product','categories','brands'));

}
}