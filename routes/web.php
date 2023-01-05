<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ManagementController;

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

Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
// Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
// Route::post('/register',  [RegisterController::class,'register']);

Route::group(['middleware' => ['auth'], 'prefix' => '/admin', 'as' => 'admin.'], function (){
Route::get('/',[ManagementController::class, 'index'])->name('index');
});

Route::group(['middleware' => ['auth'], 'prefix' => '/admin/orderManagement', 'as' => 'admin.orderManagement.'], function () {
    Route::get('/',[ManagementController::class, 'index'])->name('index');
    Route::get('/changeStatus', [ManagementController::class, 'changeStatus'])->name('changeStatus1');
    Route::post('/changeStatus', [ManagementController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/show/{id}', [ManagementController::class, 'show'])->name('show');
    Route::get('/delete/{id}', [ManagementController::class, 'destroy'])->name('delete');
});

Route::group(['middleware' => ['auth'], 'prefix' => '/admin/orderHistory', 'as' => 'admin.orderHistory.'], function () {    
    Route::get('/history',[ManagementController::class, 'history'])->name('history');
    Route::post('/history/fetch_data', [ManagementController::class, 'fetch_data'])->name('history.fetch_data');
    Route::get('/show/{id}', [ManagementController::class, 'his_show'])->name('show');
    Route::get('/delete/{id}', [ManagementController::class, 'his_destroy'])->name('delete');
});


//Category
Route::group(['middleware' => ['auth'], 'prefix' => '/admin/category', 'as' => 'admin.category.'], function () {
    Route::get('/',[CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
});

//Product
Route::group(['middleware' => ['auth'], 'prefix' => '/admin/product', 'as' => 'admin.product.'], function () {
    Route::get('/',[ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
});

//CustomerOrder
Route::get('/',[OrderController::class, 'index'])->name('index');
Route::get('cart', [OrderController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [OrderController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [OrderController::class, 'remove'])->name('remove.from.cart');
Route::get('order', [OrderController::class, 'ordercreate'])->name('ordercreate');
Route::post('store', [OrderController::class, 'orderstore'])->name('orderstore');
Route::get('receipt/{id}', [OrderController::class, 'receipt'])->name('receipt');



