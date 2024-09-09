<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;


/*Route::get('/articles', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::get('/articles', [ArticleController::class, 'index']);