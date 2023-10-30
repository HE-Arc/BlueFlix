<?php

use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('lists', ListController::class);

Route::get('/register',[RegisterController::class,'index'])->name('register');

Route::post('/register', [RegisterController::class, 'createUser']);

Route::get('/login',[UserController::class,'index'])->name('login');
Route::post('/login', [UserController::class, 'parseLogin']);
