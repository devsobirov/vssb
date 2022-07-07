<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;

$localizationGroupData = [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
];

// Public (Web) routes
Route::group($localizationGroupData, function() {
    Route::view('/', 'welcome');
});

Auth::routes();

// Admin (Control-panel) routes
Route::prefix('c-panel')->middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(CategoryController::class)->prefix('categories')
        ->group(function () {
        Route::get('/', 'index')->name('categories.index');
        Route::get('form/{id?}', 'form')->name('categories.form');
        Route::post('save/{id?}', 'save')->name('categories.save');
    });
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::view('summernote', 'vendor.summernote.example' )->name('summernote');
});

// Technical Routes
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
