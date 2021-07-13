<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {
        $check = Cart::Where('product_id', $product_id)->Where('user_ip', request()->ip())->first();
        if ($check) {

            Cart::Where('product_id', $product_id)->Where('user_ip', request()->ip())->increment('product_qty');

            return Redirect()->back()->with('cart', 'Product Added on Cart');
        } else {
            Cart::insert([
                'product_id' => $product_id,
                'product_qty' => 1,
                'price' => $request->price,
                'user_ip' => request()->ip(),
            ]);

            return Redirect()->back()->with('cart', 'Product Added on Cart');

        }
    }

    // *********cart page*****

    public function cartPage()
    {
        $carts = Cart::Where('user_ip', request()->ip())->latest()->get();
        $subtotal = Cart::all()->where('user_ip', request()->ip())->sum
            (function ($t) {
            return $t->price * $t->product_qty;
        });
        return view('pages.cart', compact('carts', 'subtotal'));

    }
    // ********cart destroy*********
    public function destroy($cart_id)
    {
        Cart::where('id', $cart_id)->where('user_ip', request()->ip())->delete();
        return Redirect()->back()->with('cart_delete', 'Cart Product deleted');
    }
    // *********** cart quantity update*****

    public function quantityUpdate(Request $request, $cart_id)
    {
        Cart::where('id', $cart_id)->where('user_ip', request()->ip())->update([
            'product_qty' => $request->product_qty,
        ]);
        return Redirect()->back()->with('cart_update', 'quantity updated');
    }
    // *****coupn apply*********
    public function apllyCoupon(Request $request)
    {
        $check = Coupon::Where('coupon_name', $request->coupon_name)->first();
        if ($check) {
            Session::put('coupon', [
                'coupon_name' => $check->coupon_name,
                'coupon_discount' => $check->discount,
            ]);
            return Redirect()->back()->with('cart_update', 'Succesfully coupon applied');
        } else {
            return Redirect()->back()->with('cart_delete', 'Invalid coupon');
        }
    }
// ******coupon destroy****
    public function couponDestroy()
    {
        if (Session::has('coupon')) {
            session()->forget('coupon');
            return Redirect()->back()->with('cart_delete', 'coupon removed success');
        }
    }
}
