<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PeopleController::class, 'getAll'])->name('salom');

Route::get('/form', function () {
    return view('form');
})->name('formPage');

Route::get('/people', [PeopleController::class, 'getAll'])->name('people.getAll');
Route::get('/people/{id}', [PeopleController::class, 'get'])->name('people.getId');
Route::post('/create', [PeopleController::class, 'create'])->name('people.create');
Route::put('/update/{id}', [PeopleController::class, 'update'])->name('people.edit');
Route::delete('/delete/{id}', [PeopleController::class, 'delete'])->name('people.delete');
