<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
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
Route::delete('lists/{listId}/movies/{movieId}', [ListController::class, 'destroyMovie'])->name('lists.destroyMovie');
Route::delete('lists/{listId}/series/{seriesId}', [ListController::class, 'destroySeries'])->name('lists.destroySeries');

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class, 'createUser']);

Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class, 'parseLogin']);

Route::get('/profil',[UserController::class,'index'])->name('profil')->middleware('auth');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('success', 'You are logged out.');
})->name('logout');

