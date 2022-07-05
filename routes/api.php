<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('')->group(function () {
    Route::controller(LanguageController::class)->group(function () {
        Route::get('/language', 'index')->name('api_language');
        Route::get('/language/{language}', 'show')->name('api_language_view');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('api_category');
        Route::get('/category/{category}', 'show')->name('api_category_view');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('/post', 'index')->name('api_post');
        Route::get('/post/{post}', 'show')->name('api_post_view');
    });
});
