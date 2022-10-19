<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['setup', 'auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
Auth::routes();

Route::controller(SettingController::class)->group(function () {
  Route::get('/setup_organization', 'setup_organization')->name('setup_organization');
  Route::post('/setup_organization', 'update_organization')->name('setup_organization');

  Route::get('/setup_administrator', 'setup_administrator')->name('setup_administrator');
});

Route::post('/setup_administrator', [RegisterController::class, 'setup_administrator'])->name('setup_administrator');
