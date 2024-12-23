<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;


// login
Route::get('/signin', function () {
    return view('signin');
})->name('login');

Route::post('/login', [AuthController::class,'signin'])->name('signin.submit');

// register
Route::get('/signup', function () {
    return view('signup');
})->name('register');

Route::post('/register', [AuthController::class,'signup'])->name('signup.submit');


Route::middleware('auth')->group(function () {
    Route::get('/qr-code', function () {
        $result = Builder::create()
            ->data('Hello World')
            ->build();
    
        $path = Storage::disk('public')->path('qrcode.png');
        file_put_contents($path, $result->getString());
    
        return response()->download($path);
    });
    
    Route::get('/qr-code-view', function () {
        $result = Builder::create()
            ->data('Hello World')
            ->build();
    
        // QR kodni baza64 formatida olish
        $base64 = base64_encode($result->getString());

        // $generator = new BarcodeGeneratorPNG();
        // $barcodeData = '123456789012'; // EAN13 uchun 12 ta raqam bo‘lishi kerak

        // // PNG formatida shtrix kodni yaratish
        // $barcode = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);

    
        return view('qr-code', ['qrcode' => $base64]);
    })->name('view-qr-code');
    // logOut
    Route::get('/logOut', [AuthController::class,'logout'])->name('logout');


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
    Route::get('/product/{categories_id}', [ProductController::class, 'getAll'])->name('product.getAll');
    Route::get('/products', [ProductController::class, 'All'])->name('product.All');
    Route::get('/product/{id}', [ProductController::class, 'get'])->name('product.getId');
    Route::post('/prod-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/addProduct', [ProductController::class, 'addcategory'])->name('product.add');
    Route::put('/update-product/{id}', [ProductController::class, 'update'])->name('product.edit');
    Route::delete('/delete-product/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

