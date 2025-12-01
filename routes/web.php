<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelMenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('user.redirect')->group(function () {
    Route::get('/', fn() => view('pages.login'));
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login.process', [LoginController::class, 'loginprocess'])->name('login.process');
});


Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'menu.access'])->group(function () {
    Route::resource('/level', LevelController::class);
    Route::resource('/user', UserController::class);

    Route::resource('/customer', CustomerController::class);
    Route::resource('/service', ServiceController::class);

    Route::resource('/menu', MenuController::class);
    Route::resource('/permission', LevelMenuController::class);

    Route::resource('/transaction', TransactionController::class);

    Route::put('/status/update', [OrderController::class, 'updateStatus'])->name('status.update');
    Route::resource('/order', OrderController::class);

    Route::resource('/detail', DetailController::class);
    Route::resource('/pickup', PickupController::class);
    Route::resource('/report', ReportController::class);

    Route::get('/struk/{id}', [DetailController::class, 'printstruk'])->name('struk');
});
