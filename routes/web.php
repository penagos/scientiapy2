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
    Route::get('ask', [QuestionController::class, 'ask'])->name('ask');

    Route::prefix('{id}')->group(function () {
        Route::get('/', [QuestionController::class, 'view'])->name('view');
        Route::get('edit', [QuestionController::class, 'edit'])->name('edit');
    });
});

Route::prefix('answers')->name('answers.')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::get('edit', [AnswerController::class, 'edit'])->name('edit');
    });
});

Route::prefix('tags')->name('tags.')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('index');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});
