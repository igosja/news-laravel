<?php

use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\SiteController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home')->middleware('auth');
        Route::resources([
            'language' => LanguageController::class
        ]);
    });
});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/', 'login')->name('login');
    Route::get('/', 'logout')->name('logout');
});
