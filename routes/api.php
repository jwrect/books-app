<?php

use App\Http\Api\v1\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('books')->group(function () {
        Route::prefix('best-sellers')->group(function () {
            Route::get('/', [BookController::class, 'getBestSellers']);
            Route::get('/{date}/{list}', [BookController::class, 'getBestSellersByDate']);
            Route::get('/history', [BookController::class, 'getBestSellersHistory']);
            Route::get('/names', [BookController::class, 'getBestSellersNames']);
        });
        Route::get('/full-overview', [BookController::class, 'getBooksFullOverview']);
        Route::get('/top-five', [BookController::class, 'getTopFiveBooks']);
        Route::get('/reviews', [BookController::class, 'getBookReviews']);
    });
});
