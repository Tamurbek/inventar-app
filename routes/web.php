<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class, 'getAll'])->name('salom');

Route::get('/form', function () {
    return view('form');
})->name('formPage');

// category
Route::get('/category', [CategoryController::class, 'getAll'])->name('category.getAll');
Route::get('/categories', [CategoryController::class, 'All'])->name('category.All');
Route::get('/category/{id}', [CategoryController::class, 'get'])->name('category.getId');
Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/addCategory', [CategoryController::class, 'addcategory'])->name('category.add');
Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.edit');
Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

// product
Route::get('/product', [ProductController::class, 'getAll'])->name('product.getAll');
Route::get('/products', [ProductController::class, 'All'])->name('product.All');
Route::get('/product/{id}', [ProductController::class, 'get'])->name('product.getId');
Route::post('/prod-create', [ProductController::class, 'create'])->name('product.create');
Route::post('/addProduct', [ProductController::class, 'addcategory'])->name('product.add');
Route::put('/update-product/{id}', [ProductController::class, 'update'])->name('product.edit');
Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('product.delete');
