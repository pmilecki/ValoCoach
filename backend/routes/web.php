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

Route::get('valo/{server}/{playerName}/{playerTag}/{queue}', [MatchHistoryController::class, '__invoke']);

Route::get('/valoMatch/{matchId}', [MatchController::class, '__invoke']);
