<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function sprintf;

class MatchHistoryController extends Controller
{
    public function __invoke(string $server, string $playerName, string $playerTag, string $queue)
    {
        $apiAdress = 'https://api.henrikdev.xyz/valorant/v3/matches/%s/%s/%s?filter=%s';
        $apiResponseAdress = sprintf($apiAdress, $server, $playerName, $playerTag, $queue);
        $apiResponse = Http::get($apiResponseAdress);

        $json = $apiResponse->json();
        $data = collect($json['data']);

        $numOfRounds = $data->map(fn (array $match) => count($match['rounds']));

        $statsData = $data
            ->map(function (array $match) use ($playerName, $playerTag) {
                $playerData = collect($match['players']['all_players'])
                    ->first(fn (array $player) => Str::lower($player['name']) === Str::lower($playerName) && Str::lower($player['tag']) === Str::lower($playerTag));

                return [
                    'matchId' => $match['metadata']['matchid'],
                    'playerData' => collect($playerData)->only([
                        'currenttier_patched', 'stats', 'damage_made', 'assets', 'team', 'name', 'tag', 'puuid'
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

        return response()->json($response);
    }
}
