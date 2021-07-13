<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupons'));

    }
    // *****coupon store*****
    public function Store(Request $request){

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount' => $request->discount,
            'created_at' => Carbon::now()

        ]);

        return Redirect()->back()->with('success', 'Coupon Added');
    }
    // ********coupon edit*******
    public function Edit($coupon_id){

        $coupon = Coupon::find($coupon_id);
        return view('admin.coupon.edit',compact('coupon'));
    }

    // **update function*****

    public function update(Request $request)
  {
    $coupon_id = $request->id;

    Coupon::findOrFail($coupon_id)->update([

        'coupon_name' => strtoupper($request->coupon_name),
        'update_at' => Carbon::now(),

    ]);

    return Redirect()->route('admin.coupon')->with('Catupdated', 'Coupon updated');
}

// ******delete******
public function delete($coupon_id){
    Coupon::findOrFail($coupon_id)->delete();

}
}