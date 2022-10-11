<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

Route::middleware('guest')->group(
    function () {
        Route::get('/', [AuthController::class, 'welcomeView'])->name('welcome');
        Route::post('/', [AuthController::class, 'welcomePost']);

        Route::get('/login', [AuthController::class, 'loginView'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);

        Route::get('/register', [AuthController::class, 'registerView'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/register/duplicate', [AuthController::class, 'registerDuplicateCheck']);

        Route::get('/forgot_password', [AuthController::class, 'forgotPasswordView'])->name('forgot_password');
        Route::post('/forgot_password', [AuthController::class, 'forgotPasswordPost']);
    }
);

Route::middleware(['auth', 'authorize'])->group(
    function () {
        Route::prefix('user')->group(function () {
            Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('user_dash');
            Route::post('/dashboard', [UserController::class, 'dashboardPost']);
        });

        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboardView'])->name('admin_dash');
            Route::post('/dashboard', [AdminController::class, 'dashboardPost']);

            Route::get('/add', [AdminController::class, 'addView'])->name('add_admin');
            Route::post('/add', [AdminController::class, 'addPost']);
            Route::post('/add/duplicate', [AdminController::class, 'addDuplicateCheck']);

            Route::get('/database', [AdminController::class, 'databaseView'])->name('database');
            Route::post('/database', [AdminController::class, 'databasePost']);

            Route::get('/edit/{id}', [AdminController::class, 'editView'])->name('edit');
            Route::post('/edit/{id}', [AdminController::class, 'editPost']);
            Route::post('/edit/{id}/duplicate', [AdminController::class, 'editDuplicateCheck']);

            Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
        });
    }
);