<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductSkuController;
use App\Http\Controllers\HomeController;

use App\Http\Livewire\ProductCategory;
use App\Http\Livewire\ProductDetail;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::group(['prefix' => 'admin/'], function () {
    Voyager::routes();
    //Product sku
    Route::get('products/{id}/sku', [ProductSkuController::class, 'show'])
        ->name('product.productsku');
    Route::post('products/sku/create', [ProductSkuController::class, 'store'])
        ->name('product.productsku.store');
    Route::put('products/sku/get/{id}', [ProductSkuController::class, 'get_sku'])
        ->name('product.productsku.getsku');
    Route::post('products/sku/delete', [ProductSkuController::class, 'delete_sku'])
        ->name('product.productsku.deletesku');

});

Route::get('/c/{slug}', ProductCategory::class)->name('product.category');
Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/cart', Cart::class)->name('cart.index');
Route::get('/checkout', Checkout::class)->name('checkout');
