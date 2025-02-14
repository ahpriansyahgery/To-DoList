<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'proseslogin'])->name('login.proses');
Route::get('/register', [UserController::class, 'registration'])->name('register');
Route::post('/register', [UserController::class, 'prosesRegistration'])->name('register.proses');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('task', TaskController::class)->except(['show', 'create', 'edit']);
});
