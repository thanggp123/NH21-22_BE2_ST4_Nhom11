<?php

use App\Http\Controllers\DetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\PaymentsController;

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

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [MyController::class, 'admin']);
    Route::resource('/product', ProductsController::class);
    Route::resource('/manufacturer', ManufacturersController::class);

});
Route::get('/search', [MyController::class, 'search']); 
Route::get('/carts/{action?}/{product_id?}', [MyController::class, 'carts'])->name('carts');
Route::get('/products/{product_id}/{manu_id}', [MyController::class, 'products'])->name('products');
Route::get('/{name?}', [MyController::class, 'index'])->name('index');
