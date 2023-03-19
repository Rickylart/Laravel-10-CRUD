<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

//*****Normal Routes */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-product', [App\Http\Controllers\ProductsController::class, 'create'])->name('createProduct');
Route::post('/store-product', [App\Http\Controllers\ProductsController::class, 'store'])->name('storeProduct');
Route::get('/show-product/{id?}', [App\Http\Controllers\ProductsController::class, 'show'])->name('showProduct');
Route::get('/edit-product/{id?}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('editProduct');
Route::patch('/update-product', [App\Http\Controllers\ProductsController::class, 'update'])->name('updateProduct');
Route::delete('/delete-product', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('deleteProduct');

//******Livewire Routes */
Route::get('/livewire-home', function () {
    return view('livewire-home');
})->name('livewire_home');

