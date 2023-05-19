<?php

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

// Route::get('/valo', function () {
//     return Http::get('https://api.henrikdev.xyz/valorant/v3/matches/eu/Banzaii/Rose?filter=competitive')['data'][0]['players']['all_players']['name' => 'Banzaii'];
// });

Route::get('valo/{server}/{playerName}/{playerTag}/{queue}', [MatchHistoryController::class, '__invoke']);
