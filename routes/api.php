<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::get('/tags/search/{query}', [TagController::class, 'search'])->name('api.tags.search');
Route::get('/questions/search/{query}', [QuestionController::class, 'search'])->name('api.questions.search');
Route::get('/users/search/{query}', [UserController::class, 'search'])->name('api.users.search');