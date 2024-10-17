<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, 'landing'])->name('home');

Route::prefix('/library')->name('libraries.')->group(function(){
    Route::get('/add', [LibraryController::class, 'create'])->name('create');
    Route::post('/add', [LibraryController::class, 'store'])->name('store');
    Route::get('/', [LibraryController::class, 'index'])->name('index');
    Route::patch('/libraries/{id}/status', [LibraryController::class, 'status'])->name('status');
    Route::delete('/libraries/{id}', [LibraryController::class, 'destroy'])->name('delete');

    Route::get('/edit/{id}', [LibraryController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [LibraryController::class, 'update'])->name('update');
    Route::put('/edit/stock/{id}', [LibraryController::class, 'updateStock'])->name('update.stock');
});

Route::prefix('/users')->name('users.')->group(function(){
    Route::get('/add', [UserController::class, 'create'])->name('create');
    Route::post('/add', [UserController::class, 'store'])->name('store');
    Route::get('/', [UserController::class, 'index'])->name('index');
    // {id} path dinamis berisi data id, path dinamis untuk mencari spesifikasi data berdasarkan field tertentu
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [UserController::class, 'update'])->name('update');
    Route::put('/edit/password{id}', [UserController::class, 'updatePass'])->name('update.pass');
});
