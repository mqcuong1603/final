<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin.admin_dashboard');
});

Route::get('/sales', function () {
    return view('sales.salesInfo');
});

Route::get('/logout', function () {
    return view('logout');
});


//product

Route::get('/products', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



