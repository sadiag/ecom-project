<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@Login');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// admin category

Route::get('admin/categories', 'Admin\CategoryController@index')->name('admin.category');
Route::post('admin/categories-store', 'Admin\CategoryController@StoreCat')->name('store.category');
Route::get('admin/categories/edit/{cat_id}', 'Admin\CategoryController@Edit');
Route::post('admin/categories-update', 'Admin\CategoryController@UpdateCat')->name('update.category');
Route::get('admin/categories/delete/{cat_id}', 'Admin\CategoryController@Delete');

// admin Brand

Route::get('admin/brand', 'Admin\BrandController@index')->name('admin.brand');
Route::post('admin/brand-store', 'Admin\BrandController@Store')->name('store.brand');
Route::get('admin/brand/edit/{brand_id}', 'Admin\BrandController@Edit');
Route::post('admin/brand-update', 'Admin\BrandController@Update')->name('update.brand');
Route::get('admin/brand/delete/{brand_id}', 'Admin\BrandController@Delete');

// ******product page ******

Route::get('admin/products/add', 'Admin\ProductController@addProduct')->name('add-products');
Route::post('admin/products/store', 'Admin\ProductController@storeProduct')->name('store.products');
Route::get('admin/products/manage', 'Admin\ProductController@manageProduct')->name('manage-products');
Route::get('admin/products/edit/{product_id}', 'Admin\ProductController@editProduct');
Route::post('admin/products/update', 'Admin\ProductController@updateProduct')->name('update.products');

Route::post('admin/products/image-update', 'Admin\ProductController@updateImage')->name('update-image');
Route::get('admin/products/delete/{product_id}', 'Admin\ProductController@delete');

// *********coupon route******

Route::get('admin/coupon', 'Admin\CouponController@index')->name('admin.coupon');
Route::post('admin/coupon-store', 'Admin\CouponController@Store')->name('store.coupon');
Route::get('admin/coupon/edit/{coupon_id}', 'Admin\CouponController@Edit');
Route::post('admin/coupon-update', 'Admin\CouponController@update')->name('update.coupon');
Route::get('admin/coupon/delete/{coupon_id}', 'Admin\CouponController@delete');
Route::get('admin/coupon/inactive/{coupon_id}', 'Admin\CouponController@inactive');
Route::get('admin/coupon/active/{coupon_id}', 'Admin\CouponController@active');

// ***********add to cart*****
Route::post('add/to-cart/{product_id}', 'CartController@addToCart');
Route::get('cart', 'CartController@cartPage');
Route::get('cart/destroy/{cart_id}', 'CartController@destroy');
Route::post('cart/quantity/update/{cart_id}', 'CartController@quantityUpdate');
Route::post('coupon/apply', 'CartController@apllyCoupon');
Route::get('coupon/destroy', 'CartController@couponDestroy');

// ******wishlist****

Route::get('add/to-wishlist/{product_id}', 'WishlistController@addToWishlist');
Route::get('wishlist', 'WishlistController@WishPage');
Route::get('wishlist/destroy/{wishlist_id}', 'WishlistController@destroy');

// ******product****
Route::get('product/details/{product_id}', 'FrontendController@productDetails');

// *****checkout******
Route::get('checkout', 'CheckoutController@index');
