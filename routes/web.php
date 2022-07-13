<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DocumentController;

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

    Route::resource('posts', PostController::class)
        ->except(['show'])->names('posts');

    Route::controller(PageController::class)->prefix('pages')
        ->group(function () {
        Route::get('/', 'index')->name('pages.index');
        Route::get('form/{id?}', 'form')->name('pages.form');
        Route::post('save/{id?}', 'save')->name('pages.save');
    });

    Route::controller(PersonController::class)->prefix('person')
        ->group(function () {
        Route::get('/', 'index')->name('person.index');
        Route::get('form/{id?}', 'form')->name('person.form');
        Route::post('save/{id?}', 'save')->name('person.save');
        Route::delete('delete/{person}', 'delete')->name('person.delete');
    });

    Route::controller(AppointmentController::class)->prefix('appointments')
        ->group(function () {
        Route::get('{person}/{id?}', 'list')->name('appointments.list');
        Route::post('save/{id?}', 'save')->name('appointments.save');
        Route::delete('delete/{appointment}', 'delete')->name('appointments.delete');
    });

    Route::controller(DocumentController::class)->prefix('documents')
        ->group(function () {
        Route::get('list/{category}', 'list')->name('documents.list');
        Route::get('download/{document}', 'download')->name('documents.download');
        Route::post('save/{id?}', 'save')->name('documents.save');
        Route::delete('delete/{document}', 'delete')->name('documents.delete');
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
