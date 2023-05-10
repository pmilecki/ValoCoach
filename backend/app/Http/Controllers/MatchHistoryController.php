<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MatchHistoryController extends Controller
{
    public function __invoke()
    {
        $apiResponse = Http::get('https://api.henrikdev.xyz/valorant/v3/matches/eu/Banzaii/Rose?filter=competitive');

        $json = $apiResponse->json();
      	$data = collect($json['data']);

      	$numOfRounds = $data->map(fn (array $match) => count($match['rounds']));

        $playerData = $data
            ->map(function (array $item) {
                return collect($item['players']['all_players'])->first(fn (array $player) => $player['name'] === 'Banzaii' && $player['tag'] === 'ROSE');
            })
            ->map(fn (array $player) => collect($player)->only(['stats', 'damage_made', 'assets']));

      	$damagePerRound = $numOfRounds->zip($playerData)
          ->map(function ($zippedData) {
            return $zippedData[1]['damage_made'] / $zippedData[0];
          });

      	$response = [
          'numOfRounds' => $numOfRounds,
          'playerData'  => $playerData,
          'damagePerRound' => $damagePerRound
        ];

        //dd($response);

        return response()->json($response);
    }
}
