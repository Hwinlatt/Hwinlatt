<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditPageController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserOrderController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('shop',[ShopController::class,'index'])->name('shop');
Route::get('shop/category/{key}',[ShopController::class,'category']);
Route::post('shop/category/search',[ShopController::class,'search'])->name('userSearchCat');
Route::post('countcat',[CartController::class,'count']);
Route::get('user/detail/{id}',[ShopController::class,'detail']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/favourite',[FavouriteController::class,'index'])->name('favourite');
Route::get('FavItems',[FavouriteController::class,'getItems'])->name('fav_items');

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::post('addto_cart',[CartController::class,'insert'])->name('addToCart');
    Route::get('carts',[CartController::class,'index'])->name('carts');
    Route::post('remove-cart',[CartController::class,'destroy'])->name('rm-cart');
    Route::post('update-cart',[CartController::class,'update'])->name('up-cart');
    Route::get('checkout',[CheckoutController::class,'index'])->name('chkout');
    Route::post('order-comfirm',[OrderController::class,'index'])->name('order');
    Route::post('order-received',[OrderController::class,'received'])->name('user#order_received');
    Route::get('myorder',[UserOrderController::class,'index'])->name('myorder');
    Route::get('myorder/{oid}',[UserOrderController::class,'order_info']);
});



Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin#dashboard');

    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category',[CategoryController::class,'search'])->name('admin#category');
    Route::get('category/add',[CategoryController::class,'add'])->name('admin#add_category');
    Route::post('category/add',[CategoryController::class,'insert'])->name('admin#insert_category');
    Route::get('category/edit/{id}',[CategoryController::class,'edit']);
    Route::put('category/edit/{id}',[CategoryController::class,'update']);
    Route::post('category/delete',[CategoryController::class,'destroy'])->name('admin#del_category');

    Route::get('orders',[AdminOrderController::class,'index'])->name('admin#orders');
    Route::get('orders/{id}',[AdminOrderController::class,'order_items']);
    Route::put('orders/{id}',[AdminOrderController::class,'confirm']);
    Route::post('order/change',[AdminOrderController::class,'update'])->name('admin#order_update');
    Route::post('order/will_deli_date/',[AdminOrderController::class,'will_deli_date'])->name('admin#order_willDeliDate');
    Route::post('order/delivered',[AdminOrderController::class,'delivered'])->name('admin#delied');
    Route::post('order/rejected',[AdminOrderController::class,'reject'])->name('admin#order_rjt');

    Route::get('history/{type}/{id}',[HistoryController::class,'history']);

    Route::get('editPage',[EditPageController::class,'index'])->name('admin#edit_page');
    Route::get('editPage/edit_widget_page/{id}',[EditPageController::class,'edit']);
    Route::post('editPage/update_widget_page',[EditPageController::class,'update'])->name('admin#update_widget_page');
    Route::get('editPage/add_widget_page',[EditPageController::class,'add'])->name('admin#add_widget_page');
    Route::post('editPage/add_widget_page',[EditPageController::class,'insert'])->name('admin#insert_page');
    Route::post('editPage/remove_widget_page',[EditPageController::class,'destroy'])->name('admin#remove_widget_page');

    Route::get('users',[AdminUserController::class,'index'])->name('admin#users');
    Route::get('edit/user',[AdminUserController::class,'edit']);
    Route::post('update/user',[AdminUserController::class,'update'])->name('admin#update_user');
    Route::delete('delete/user',[AdminUserController::class,'destroy'])->name('admin#delete_user');


    Route::get('cat_types',[CategoryTypeController::class,'index'])->name('admin#cat_types');
    Route::post('cat_types/add',[CategoryTypeController::class,'insert'])->name('admin#add_cat_types');
    Route::get('cat_types/edit/{id}',[CategoryTypeController::class,'edit']) ;
    Route::post('cat_types/edit/{id}',[CategoryTypeController::class,'update']);
});
