<?php

use App\Events\NewComment;
use App\Events\NewShare;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TrailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewerController;
use App\Models\Comment;
use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['setup', 'auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  Route::controller(ShareController::class)->group(function () {
    Route::get('/newshare', 'index')->name('newshare');
    Route::post('/make_newshare', 'store')->name('make_newshare');
    Route::get('/_/_/{slug}', 'show')->name('viewshare');
  });

  Route::post('/send_comment', [CommentController::class, 'store'])->name('send_comment');
  Route::get('/get_comment/{comment_id}', [CommentController::class, 'get'])->name('get_comment');
  Route::get('/trails', [TrailController::class, 'index'])->name('trail');

  Route::middleware(['admin'])->group(function () {
    Route::get('/all_files', [ShareController::class, 'all'])->name('all_files');

    Route::controller(InviteController::class)->group(function () {
      Route::get('/users', 'index')->name('staffs');
      Route::post('/send_invite', 'store')->name('send_invite');
      Route::post('/delete_invite', 'destroy')->name('delete_invite');
    });

    Route::controller(UserController::class)->group(function () {
      Route::post('/edit_user', 'edit')->name('edit_user');
      Route::post('/restore_user', 'restore')->name('restore_user');
      Route::post('/pause_user', 'pause')->name('pause_user');
      Route::post('/delete_user', 'destroy')->name('delete_user');
    });
  });

  Route::controller(ViewerController::class)->group(function () {
    Route::post('/grant_access', 'store')->name('give_access');
    Route::post('/remove_access', 'destroy')->name('remove_access');
  });
});
Auth::routes(['register' => false]);

Route::controller(SettingController::class)->group(function () {
  Route::get('/setup_organization', 'setup_organization')->name('setup_organization');
  Route::post('/setup_organization', 'update_organization')->name('setup_organization');

  Route::get('/setup_administrator', 'setup_administrator')->name('setup_administrator');
});

Route::get('/__invite/{invite_id}', [InviteController::class, 'accept'])->name('invite')->middleware('signed');
Route::post('/setup_administrator', [RegisterController::class, 'setup_administrator'])->name('setup_administrator');
Route::post('/register_invite', [RegisterController::class, 'register'])->name('register_invite');



/////////////////// BECAREFUL HERE ////////////////////////
/////////////// FORCE REREUN MIGRATION ///////////////////
Route::get('migrar/7014293952', function () {
  dd(Artisan::call('migrate:refresh --force'));
});
////////////////// DELETES ALL DATA ////////////////////
////////////////// BECAREFUL HERE /////////////////////
