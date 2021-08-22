<?php

use Illuminate\Support\Facades\Route;

use App\Models\Question;

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

Route::get('/', [\App\Http\Controllers\QuestionController::class, 'index'])->name('index');

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('/', [\App\Http\Controllers\QuestionController::class, 'index'])->name('index');
    Route::get('ask', [\App\Http\Controllers\QuestionController::class, 'ask'])->name('ask');

    Route::prefix('{id}')->group(function () {
        Route::get('/', [\App\Http\Controllers\QuestionController::class, 'view'])->name('view');
    });
});