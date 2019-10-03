<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/',[
    'uses' => 'NewShopController@index',
    'as'   =>'/'
]);

Route::get('/category-product/{id}',[
    'uses' => 'NewShopController@categoryProduct',
    'as'   =>'category-product'
]);

Route::get('/product-details/{id}/{name}',[
    'uses' => 'NewShopController@productDetails',
    'as'   =>'product-details'
]);



Route::post('/cart/add',[
    'uses' => 'CardController@addToCart',
    'as'   =>'add-to-card'
]);


Route::get('/card/show',[
    'uses' => 'CardController@showCart',
    'as'   =>'show-card'
]);

Route::get('/card/delete/{id}',[
    'uses' => 'CardController@deleteCardItem',
    'as'   =>'delete-card-item'
]);

Route::post('/card/update',[
    'uses' => 'CardController@updateCart',
    'as'   =>'update-cart'
]);

Route::get('/card/checkout',[
    'uses' => 'CheckoutController@index',
    'as'   =>'checkout'
]);

Route::post('/card/registration',[
    'uses' => 'CheckoutController@registration',
    'as'   =>'registration'
]);

Route::get('/checkout/shipping',[
    'uses' => 'CheckoutController@shippingForm',
    'as'   =>'checkout-shipping'
]);

Route::post('/checkout/save',[
    'uses' => 'CheckoutController@saveShippingInfo',
    'as'   =>'new-shipping'
]);

Route::get('/checkout/payment',[
    'uses' => 'CheckoutController@ShippingPaymentInfo',
    'as'   =>'shipping-payment'
]);

Route::post('/checkout/order',[
    'uses' => 'CheckoutController@newOrder',
    'as'   =>'new-order'
]);

Route::get('/complete/order',[
    'uses' => 'CheckoutController@completeOrder',
    'as'   =>'complete-order'
]);

Route::post('/customer-login',[
    'uses' => 'CheckoutController@customerLoginCheck',
    'as'   =>'customer-login'
]);

Route::post('/customer-logout',[
    'uses' => 'CheckoutController@customerLogoutInfo',
    'as'   =>'customer-logout'
]);


Route::get('/checkout/new-customer-login',[
    'uses' => 'CheckoutController@customerLoginInfo',
    'as'   =>'new-customer-login'
]);









Route::get('/category/add',[
    'uses' => 'CategoryController@addCategory',
    'as'   =>'add-category'
]);

Route::get('/category/manage',[
    'uses' => 'CategoryController@manageCategory',
    'as'   =>'manage-category'
]);

Route::post('/category/category',[
    'uses' => 'CategoryController@newCategory',
    'as'   =>'new-category'
]);

Route::get('/category/manage',[
    'uses' => 'CategoryController@manageCategory',
    'as'   =>'manage-category'
]);

Route::get('/category/unpublished/{id}',[
    'uses' => 'CategoryController@unpublishedCategory',
    'as'   =>'unpublished-category'
]);

Route::get('/category/published/{id}',[
    'uses' => 'CategoryController@publishedCategory',
    'as'   =>'published-category'
]);

Route::get('/category/edit/{id}',[
    'uses' => 'CategoryController@editCategory',
    'as'   =>'edit-category'
]);

Route::post('/category/update',[
    'uses' => 'CategoryController@updateCategory',
    'as'   =>'update-category'
]);

Route::get('/category/delete/{id}',[
    'uses' => 'CategoryController@deleteCategory',
    'as'   =>'delete-category'
]);

Route::get('/brand/add',[
    'uses' =>'BrandController@addBrand',
    'as'   =>'add-brand'
]);
Route::post('/brand/new-brand',[
    'uses' =>'BrandController@newBrand',
    'as'   =>'new-brand'
]);

Route::get('/brand/manage-brand',[
    'uses' =>'BrandController@manageBrand',
    'as'   =>'manage-brand'
]);
Route::get('/brand/unpublished/{id}',[
    'uses' =>'BrandController@unpublishedBrand',
    'as'   =>'unpublished-brand'
]);
Route::get('/brand/published/{id}',[
    'uses' =>'BrandController@publishedBrand',
    'as'   =>'published-brand'
]);

Route::get('/brand/edit/{id}',[
    'uses' =>'BrandController@editBrand',
    'as'   =>'edit-brand'
]);

Route::post('/brand/update',[
    'uses' =>'BrandController@updateBrand',
    'as'   =>'update-brand'
]);

Route::get('/brand/delete/{id}',[
    'uses' =>'BrandController@deleteBrand',
    'as'   =>'delete-brand'
]);

Route::get('/product/add-product',[
    'uses' =>'ProductController@index',
    'as'   =>'add-product'
]);

Route::post('/product/save',[
    'uses' =>'ProductController@saveProductInfo',
    'as'   =>'new-product'
]);

Route::get('/product/manage',[
    'uses' =>'ProductController@manageProductInfo',
    'as'   =>'manage-product'
]);

Route::get('/product/edit/{id}',[
    'uses' =>'ProductController@editProductInfo',
    'as'   =>'edit-product'
]);

Route::post('/product/update',[
    'uses' =>'ProductController@updateProductInfo',
    'as'   =>'update-product'
]);

Route::get('/order/manage',[
    'uses' =>'OrderController@orderManageInfo',
    'as'   =>'manage-order'
]);

Route::get('/order/view-order-detail/{id}',[
    'uses' =>'OrderController@viewOrderDetail',
    'as'   =>'view-order-detail'
]);


Route::get('/order/view-order-invoice/{id}',[
    'uses' =>'OrderController@viewOrderInvoice',
    'as'   =>'view-order-invoice'
]);

Route::get('/order/download-order-invoice/{id}',[
    'uses' =>'OrderController@downloadOrderInvoice',
    'as'   =>'download-order-invoice'
]);










