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

Route::prefix('api/v2')->group(function (): void {
    Route::prefix('valorant')->group(function (): void {
        Route::get('match-history/{server}/{playerName}/{playerTag}/{queue}', MatchHistoryController::class);
        Route::get('match/{matchId}', MatchController::class);
    });
});

Route::get('api/teapot', function (){
    return response(['status' => '418', 'error' => true, 'error-msg' => "I'm a teapot"], 418);
});
