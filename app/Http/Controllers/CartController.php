<?php

namespace App\Http\Controllers;
use App\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request,$product_id)
    {
        $check = Cart::Where('product_id',$product_id)->Where('user_ip',request()->ip())->first();
      if($check)
      {
       
        Cart::Where('product_id',$product_id)->Where('user_ip',request()->ip())->increment('product_qty');
        
        return Redirect()->back()->with('cart', 'Product Added on Cart');
      }
      else
      {
        Cart::insert([
            'product_id' => $product_id,
            'product_qty' => 1,
            'price' => $request->price,
            'user_ip' => request()->ip(),
        ]);
        return Redirect()->back()->with('cart', 'Product Added on Cart');

      }

    }
}
