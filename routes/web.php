<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductSkuController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin/'], function () {
    Voyager::routes();
    Route::get('products/{id}/sku', [ProductSkuController::class, 'show'])->name('product.productsku');
    Route::post('products/sku/create', [ProductSkuController::class, 'store'])->name('product.productsku.store');
    Route::put('products/sku/get/{id}', [ProductSkuController::class, 'get_sku'])->name('product.productsku.getsku');
});
