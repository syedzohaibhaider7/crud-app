<?php

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

Route::get('/', [AuthController::class, 'welcomeView'])->middleware('loggedin')->name('welcome');
Route::post('/', [AuthController::class, 'welcomePost']);

Route::get('/login', [AuthController::class, 'loginView'])->middleware('loggedin')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerView'])->middleware('loggedin')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/user_dash', [AuthController::class, 'userDashView'])->middleware(['auth', 'user'])->name('user_dash');
Route::post('/user_dash', [AuthController::class, 'userDashPost']);

Route::get('/admin_dash', [AuthController::class, 'adminDashView'])->middleware(['auth', 'admin'])->name('admin_dash');
Route::post('/admin_dash', [AuthController::class, 'adminDashPost']);

Route::get('/add_admin', [AuthController::class, 'addAdminView'])->middleware(['auth', 'admin'])->name('add_admin');
Route::post('/add_admin', [AuthController::class, 'addAdminPost']);

Route::get('/database', [AuthController::class, 'databaseView'])->middleware(['auth', 'admin'])->name('database');
Route::post('/database', [AuthController::class, 'databasePost']);

Route::get('/forgot_password', [AuthController::class, 'forgotPasswordView'])->middleware('loggedin')->name('forgot_password');
Route::post('/forgot_password', [AuthController::class, 'forgotPasswordPost']);