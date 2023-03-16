<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/login',[MainController::class,'LoadLogin']);
Route::get('/dashboard',[MainController::class,'dashboard'])->name('dashboard');
Route::get('/view-author/{id}',[MainController::class,'view_author'])->name('view_author');
Route::get('/add-book',[MainController::class,'AddBook'])->name('add-book');
Route::get('/profile',[MainController::class,'profile'])->name('profile');
Route::get('/logout',[MainController::class,'logout'])->name('logout');
Route::post('login-user',[MainController::class,'LoginUser'])->name('LoginUser');
Route::post('create-book',[MainController::class,'CreateBooks'])->name('create-book');
Route::any('delete_author/{id}',[MainController::class,'delete_author'])->name('delete_author');
