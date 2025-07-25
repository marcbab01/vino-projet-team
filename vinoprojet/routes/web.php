<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BottleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CellarController;



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

Route::get('/', function () {
    return view('layouts/app');
})->name('home');

Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
})->name('404.custom');

// route user
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');

// route auth
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');


// authentified route
Route::middleware('auth')->group(function () {
    // route auth
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

    // route user
    Route::get('/profil', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit-name/{user}', [UserController::class, 'editName'])->name('user.edit-name');
    Route::put('/user/edit-name/{user}', [UserController::class, 'updateName'])->name('user.update-name');
    Route::get('/user/edit-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/user/edit-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // route cellier
    Route::get('/cellar/create', [CellarController::class, 'create'])->name('cellars.create');
    Route::post('/cellar', [CellarController::class, 'store'])->name('cellars.store');
    Route::get('/cellars', [CellarController::class, 'index'])->name('cellars.index');
    Route::get('/cellars/create', [CellarController::class, 'create'])->name('cellars.create');
    Route::post('/cellars/create', [CellarController::class, 'store'])->name('cellars.store');
    Route::get('/cellars/{cellar}/edit', [CellarController::class, 'edit'])->name('cellars.edit');
    Route::put('/cellars/{cellar}', [CellarController::class, 'update'])->name('cellars.update');
    Route::delete('/cellars/{cellar}', [CellarController::class, 'destroy'])->name('cellars.destroy');

    Route::get('/catalog', [BottleController::class, 'index'])->name('index');
});