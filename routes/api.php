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
Route::get('product/{id}/show',[ProductController::class,'show']);  
Route::get('product/{id}/edit',[ProductController::class,'edit']);
Route::put('product/{id}/edit',[ProductController::class,'update']);
Route::delete('product/{id}/delete',[ProductController::class,'destroy']);

Route::get('sales',[SalesController::class,'index']);
Route::post('sales',[SalesController::class,'store']);
Route::get('sales/{id}/show',[SalesController::class,'show']);
Route::put('sales/{id}/edit',[SalesController::class,'edit']);
Route::put('sales/{id}/edit',[SalesController::class,'update']);
Route::delete('sales/{id}/delete',[SalesController::class,'destroy']);





// Route::middleware('auth')->group(function () {
//     Route::get('product/index',[ProductController::class,'index'])->name('product.index');
//     Route::get('product/insert',[ProductController::class,'create'])->name('product.create');
//     Route::post('product/insert',[ProductController::class,'store'])->name('product.store');
//     Route::get('product/update/{product_id}',[ProductController::class,'edit'])->name('product.edit');
//     Route::post('product/update/{product_id}',[ProductController::class,'update'])->name('product.update');
//     Route::get('product/show/{product_id}',[ProductController::class,'show'])->name('product.show');
//     Route::get('product/destroy/{product_id}',[ProductController::class,'destroy'])->name('product.destroy');
// });