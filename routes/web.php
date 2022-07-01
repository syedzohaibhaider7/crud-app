<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'welcomeView'])->name('welcome');
Route::post('/', [AuthController::class, 'welcomePost']);

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/user_dash', [AuthController::class, 'userDashView'])->middleware('auth.basic')->name('user_dash');
Route::post('/user_dash', [AuthController::class, 'userDashPost']);

Route::get('/admin_dash', [AuthController::class, 'adminDashView'])->middleware('auth.basic')->name('admin_dash');
Route::post('/admin_dash', [AuthController::class, 'adminDashPost']);

Route::get('/database', [AuthController::class, 'databaseView'])->middleware('guest:admin')->name('database');
Route::post('/database', [AuthController::class, 'databasePost']);