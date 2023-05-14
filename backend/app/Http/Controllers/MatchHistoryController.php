<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class MatchHistoryController extends Controller
{
    public function __invoke()
    {
        $apiResponse = Http::get('https://api.henrikdev.xyz/valorant/v3/matches/eu/Banzaii/Rose?filter=competitive');

        $json = $apiResponse->json();
      	$data = collect($json['data']);

      	$numOfRounds = $data->map(fn (array $match) => count($match['rounds']));

        $statsData = $data
            ->map(function (array $match) {
                $playerData = collect($match['players']['all_players'])
                    ->first(fn (array $player) => $player['name'] === 'Banzaii' && $player['tag'] === 'ROSE');

                return [
                    'matchId' => $match['metadata']['matchid'],
                    'playerData' => collect($playerData)->only([
                        'currenttier_patched', 'stats', 'damage_made', 'assets', 'team', 'name'
                    ]),
                    'score' => $match['teams'][Str::lower($playerData['team'])]
                ];
            });

      	$damagePerRound = $numOfRounds->zip($statsData)
          ->map(function ($zippedData) {
            return $zippedData[1]['playerData']['damage_made'] / $zippedData[0];
          });

      	$response = [
          'numOfRounds' => $numOfRounds,
          'statsData'  => $statsData,
          'damagePerRound' => $damagePerRound
        ];

        //dd($response);

        return response()->json($response);
    }
}
