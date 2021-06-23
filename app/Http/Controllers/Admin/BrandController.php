<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // index page

    public function index()
    {
        $brands = Brand::latest()->get();
       return view('admin.brand.index',compact('brands'));
    }


    // *********brand store****

    
    public function Store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name'
        ]);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()

        ]);

        return Redirect()->back()->with('success','Brand Added');
            
    }
    // edit brand

    public function Edit($brand_id){

        $brand = Brand::find($brand_id);
        return view('admin.brand.edit',compact('brand'));
    }
    // update brand

    
  public function Update(Request $request)
  {
      $request->validate([
          'brand_name' => 'required'
      ]);

      $brand_id = $request->id;


      Brand::find($brand_id)->update([

          'brand_name' => $request->brand_name,
          'updated_at' => Carbon::now()

      ]);

      return Redirect()->route('admin.brand')->with('success','Brand updated');
        
      
  }
  // delete brand

   public function Delete($brand_id){
    Brand::find($brand_id)->delete();
    return Redirect()->back()->with('delete', 'Brand deleted success');

}

}
