<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Mail;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::namespace('Frontend')->prefix('/')->group(function()
{

    Route::get('/', 'PageController@index');
    Route::get('/registerPage', 'PageController@registerPage');
    Route::get('/contact', 'PageController@contactPage');
    Route::get('/xem-san-pham-{abc}', 'PageController@showPd');
    Route::get('/loginPage', 'PageController@loginPage');


    Route::get('/shop/{id?}', 'ProductController@shopPage');
    Route::get('/product/{product}', 'ProductController@productPage')->name('Page.productPage');
    Route::get('/search', 'ProductController@search')->name('Page.search');

    Route::post('/comment/{product}', 'ProductController@comment')->name('Account.comment')->middleware('auth');
    Route::get('/comment', 'ProductController@loadcomment')->name('Account.loadcomment');
    Route::get('/comment/{comment}/delete', 'ProductController@deleteCMT')->name('Product.deleteCMT')->middleware('auth');

    Route::get('/account', 'AccountController@account')->name('Account.account')->middleware('auth');
    Route::put('/account/{account}', 'AccountController@updateAccount')->name('Account.updateAccount')->middleware('auth');

    Route::get('/account/order/{order}', 'AccountController@accountOrderDetail')->name('Account.accountOrderDetail')->middleware('auth');

    Route::post('/account/changePassword', 'AccountController@changePassword')->name('Account.changePassword')->middleware('auth'); 

});





Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage')->group(function()
{
    Route::resource('/users', 'UserController');

    Route::resource('/categories', 'CategoryController',['except'=>['show']]);

    Route::resource('/products', 'ProductController');

    Route::resource('/order', 'OrderController');

    Route::get('products/images/{pd}','ProductController@destroyImages')->name('Product.destroyImages');

    Route::get('home','AdminController@admin')->name('admin');
});


Route::post('products/upload/{product}', 'Admin\ProductController@upload')->middleware('can:manage')->name('admin.products.upload');


// Cart
Route::get('/add-to-cart/{product}','Admin\CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart','Admin\CartController@index')->name('cart.index');
Route::get('/cart/update/{rowId}','Admin\CartController@update')->name('cart.update');
Route::get('/cart/destroy/{itemId}','Admin\CartController@destroy')->name('cart.destroy');
Route::get('/cart/checkout','Admin\CartController@checkout')->name('cart.checkout');
// Cart

Route::post('orders','Admin\OrderController@store')->middleware('auth')->name('orders.store');
