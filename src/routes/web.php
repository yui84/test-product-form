<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//商品登録画面表示
Route::get('/products/register', [ProductController::class, 'create']);

//商品登録処理
Route::post('/products', [ProductController::class, 'store']);

//商品一覧表示
Route::get('/products', [ProductController::class, 'index']);

//商品検索処理
Route::get('/products/search', [ProductController::class, 'search']);

//商品詳細表示
Route::get('/products/{productId}', [ProductController::class, 'show']);

//商品詳細表示内の、更新処理
Route::patch('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

//商品詳細表示内の、削除処理
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

