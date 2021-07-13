<?php

namespace App\Http\Controllers;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist($product_id){
if (Auth::check()) {     
    Wishlist::insert([
    'user_id'=> Auth::id(),
    'product_id' => $product_id,
  ]);
  return Redirect()->back()->with('cart', 'Product Added on Wishlist');
}else{ 
    return Redirect()->route('login')->with('loginError', 'login account');
 }
}
// *********wish page*****
public function wishPage(){
  $wishlists = Wishlist::where('user_id',Auth::id())->latest()->get();
  return view('pages.wishlist',compact('wishlists'));
}
// ********destroy*****
public function destroy($wishlist_id)
    {
      Wishlist::where('id',$wishlist_id)->where('user_id',Auth::id())->delete();
      return Redirect()->back()->with('cart_delete', 'Wishlist Product deleted');
    } 
}