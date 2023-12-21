<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product',[ProductController::class,'index']);
Route::post('product',[ProductController::class,'store']);
// Route::get('product/update/{id}',[ProductController::class,'edit']);
// Route::post('product/update/{id}',[ProductController::class,'update']);
// Route::get('product/show/{id}',[ProductController::class,'show']);
// Route::get('product/destroy/{id}',[ProductController::class,'destroy']);

Route::get('sales',[SalesController::class,'index']);
Route::post('sales',[SalesController::class,'store']);





// Route::middleware('auth')->group(function () {
//     Route::get('product/index',[ProductController::class,'index'])->name('product.index');
//     Route::get('product/insert',[ProductController::class,'create'])->name('product.create');
//     Route::post('product/insert',[ProductController::class,'store'])->name('product.store');
//     Route::get('product/update/{product_id}',[ProductController::class,'edit'])->name('product.edit');
//     Route::post('product/update/{product_id}',[ProductController::class,'update'])->name('product.update');
//     Route::get('product/show/{product_id}',[ProductController::class,'show'])->name('product.show');
//     Route::get('product/destroy/{product_id}',[ProductController::class,'destroy'])->name('product.destroy');
// });