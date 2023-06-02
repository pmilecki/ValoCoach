<?php

use App\Http\Controllers\MatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/v1')->group(function (): void {
    Route::prefix('valorant')->group(function (): void {
        Route::get('match-history/{server}/{playerName}/{playerTag}/{queue}', MatchHistoryController::class);
        Route::get('match/{matchId}', MatchController::class);
    });
});
