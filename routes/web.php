<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

use App\Http\Controllers\ProductController as CustomerProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController as CustomerOrderController;


Route::get('/', [HomeController::class, 'index']);


// Default dashboard redirect
Route::get('/dashboard', function () {

    return redirect('/admin/dashboard');

})->middleware(['auth','verified'])
->name('dashboard');



// Customer Profile (Breeze)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class,'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class,'destroy'])
        ->name('profile.destroy');

});



require __DIR__.'/auth.php';



// =========================
// ADMIN ROUTES
// =========================


Route::get('/admin/dashboard',
[DashboardController::class,'index'])
->middleware('admin');



Route::resource('/admin/products',
AdminProductController::class)
->middleware('admin');



Route::resource('/admin/categories',
CategoryController::class)
->middleware('admin');



Route::get('/admin/categories/{category}/products',
[CategoryController::class,'products'])
->middleware('admin');



Route::resource('/admin/orders',
AdminOrderController::class)
->only([
    'index',
    'update'
])
->middleware('admin');



Route::get('/admin/orders/{order}',
[AdminOrderController::class,'show'])
->middleware('admin');



Route::get('/admin/inventory',
[InventoryController::class,'index'])
->middleware('admin');



// Admin Profile

Route::get('/admin/profile',
[AdminProfileController::class,'edit'])
->middleware('admin');


Route::put('/admin/profile',
[AdminProfileController::class,'update'])
->middleware('admin');


Route::put('/admin/profile/password',
[AdminProfileController::class,'password'])
->middleware('admin');





// =========================
// CUSTOMER ROUTES
// =========================


Route::get('/products',
[CustomerProductController::class,'index']);



Route::get('/products/{product}',
[CustomerProductController::class,'show']);



Route::middleware('auth')->group(function(){


    Route::post('/cart/add/{product}',
    [CartController::class,'add']);


    Route::get('/cart',
    [CartController::class,'index']);


    Route::put('/cart/update/{item}',
    [CartController::class,'update']);


    Route::delete('/cart/remove/{item}',
    [CartController::class,'remove']);



    Route::post('/checkout',
    [CustomerOrderController::class,'checkout']);


    Route::get('/order-success/{order}',
    [CustomerOrderController::class,'success']);


    Route::get('/orders',
    [CustomerOrderController::class,'index']);

});

Route::get('/checkout',
[CustomerOrderController::class,'showCheckout'])
->middleware('auth');


Route::post('/checkout',
[CustomerOrderController::class,'checkout'])
->middleware('auth');

Route::middleware('auth')->group(function(){

Route::get('/profile',[ProfileController::class,'edit'])
->name('profile.edit');

Route::patch('/profile',[ProfileController::class,'update'])
->name('profile.update');

Route::post('/password',[ProfileController::class,'password']);

});

Route::get('/make-admin', function(){
    $user=\App\Models\User::where('email','ekko@gmail.com')->first();

    if($user){
        $user->role='admin';
        $user->save();
        return 'Admin updated';
    }

    return 'User not found';
});