<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\FollowerStatController;

// Route::middleware('auth')->group(function () {
    Route::get('/followers', [FollowerController::class, 'index']);
    Route::get('/followers/{id}', [FollowerController::class, 'show']);
    Route::post('/followers', [FollowerController::class, 'store']);
    Route::get('/followers/show/date-range', [FollowerController::class, 'getFollowersByDateRange']);
    Route::get('/followers/calculate/total-by-date-range', [FollowerController::class, 'getTotalFollowersByDateRange']);
    Route::get('/followers/calculate/count-by-group', [FollowerController::class, 'getFollowersCountByGroup']);

    Route::get('/interactions', [InteractionController::class, 'index']);
    Route::get('/interactions/{id}', [InteractionController::class, 'show']);
    Route::post('/interactions', [InteractionController::class, 'store']);
    Route::get('/interactions/show/date-range', [InteractionController::class, 'getInteractionsByDateRange']);
    Route::get('/interactions/calculate/count', [InteractionController::class, 'countInteractionsByDateRange']);
    Route::get('/interactions/calculate/rate', [InteractionController::class, 'getInteractionRateByDateRange']);


    Route::get('/follower-stats', [FollowerStatController::class, 'index']);
    Route::get('/follower-stats/{id}', [FollowerStatController::class, 'show']);
    Route::get('/follower-stats/show/date-range', [FollowerStatController::class, 'getStatsByDateRange']);

    Route::get('/combined-data', [FollowerStatController::class, 'getCombinedData']);
// });