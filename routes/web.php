<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/', [QuestionController::class, 'index'])->name('index');

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('index');
    Route::get('ask', [QuestionController::class, 'ask'])->middleware('auth')->name('ask');
    Route::get('search', [QuestionController::class, 'search'])->name('search');

    Route::prefix('{id}')->group(function () {
        Route::get('/', [QuestionController::class, 'view'])->name('view');
        Route::get('edit', [QuestionController::class, 'edit'])->middleware('auth')->name('edit');
    });
});

Route::prefix('answers')->name('answers.')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('edit', [AnswerController::class, 'edit'])->name('edit');
    });
});

Route::prefix('tags')->name('tags.')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('index');

    Route::prefix('{tag}')->group(function () {
        Route::get('/', [TagController::class, 'search'])->name('search');
    });
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('teams', [UserController::class, 'teams'])->name('teams');
    Route::get('favorites', [UserController::class, 'favorites'])->name('favorites');
    Route::get('settings', [UserController::class, 'settings'])->name('settings');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::prefix('{id}')->group(function () {
        Route::get('/', [UserController::class, 'view'])->name('view');
    });
});

// TODO
Route::get('login', [UserController::class, 'login'])->name('login');