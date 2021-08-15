<?php

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

// Lang
Route::get('/localization/{language}', \App\Http\Controllers\LocalizationController::class)->name('localization.switch');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function () {
    // Dashboard
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    // select2:Category
    Route::get('/categories/select', [\App\Http\Controllers\CategoryController::class, 'select'])->name('categories.select');

    //Categories 
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);

    // Select2:Tags
    Route::get('/tags/select', [\App\Http\Controllers\TagController::class, 'select'])->name('tags.select');
    //Tags 
    Route::resource('/tags', \App\Http\Controllers\TagController::class)->except(['show']);

    //Posts 
    Route::resource('/posts', \App\Http\Controllers\PostController::class);

    // Filmanager
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/index', [\App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    //Roles 
    Route::resource('/roles', \App\Http\Controllers\RoleController::class);
});
