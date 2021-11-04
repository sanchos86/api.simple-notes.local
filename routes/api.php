<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CategoryController, NoteController};

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

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'notes'], function () {
    Route::get('/', [NoteController::class, 'index']);
    Route::get('/{note}', [NoteController::class, 'show']);
    Route::post('/', [NoteController::class, 'store']);
    Route::put('/{note}', [NoteController::class, 'update']);
    Route::delete('/{note}', [NoteController::class, 'destroy']);
});
