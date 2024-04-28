<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('login');
});

// Route::get('/products', function () {
//     $products = App\Models\Product::all(); // Retrieve all products from the database
//     return View::make('products', ['products' => $products]);
// });

Route::get('/products', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



