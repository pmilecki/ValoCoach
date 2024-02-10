<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Throwable;
use function sprintf;

class MatchHistoryController extends Controller
{
    public function __invoke(string $server, string $playerName, string $playerTag, string $queue)
    {
        try {
            $apiAdress = 'https://api.henrikdev.xyz/valorant/v1/lifetime/matches/%s/%s/%s?mode=%s&size=10';
            $apiResponseAdress = sprintf($apiAdress, $server, $playerName, $playerTag, $queue);
            $apiResponse = Http::get($apiResponseAdress);

            $json = $apiResponse->json();
            $data = collect($json['data']);

            $numOfRounds = $data->map(fn(array $match) => ($match['teams']['red']) + ($match['teams']['blue']));

            $statsData = $data
                ->map(function (array $match) {
                    $tiers = ['Unrated', 'Unknown 1', 'Unknown 2', 'Iron 1', 'Iron 2', 'Iron 3', 'Bronze 1', 'Bronze 2', 'Bronze 3', 'Silver 1', 'Silver 2', 'Silver 3', 'Gold 1', 'Gold 2', 'Gold 3', 'Platinum 1', 'Platinum 2', 'Platinum 3', 'Diamond 1', 'Diamond 2', 'Diamond 3', 'Ascendant 1', 'Ascendant 2', 'Ascendant 3', 'Immortal 1', 'Immortal 2', 'Immortal 3', 'Radiant'];
                    $playerData = collect($match['stats']);
                    return [
                        'matchId' => $match['meta']['id'],
                        'playerData' => collect($playerData)->only([
                            'shots', 'damage', 'character', 'team', 'puuid'
                        ]),
                        'stats' => collect($playerData)->only([
                            'score', 'kills', 'deaths', 'assists'
                        ]),
                        'playerRoundsWon' => $match['teams'][Str::lower($playerData['team'])],
                        'playerRoundsLost' => ($match['teams']['red']) + ($match['teams']['blue']) - $match['teams'][Str::lower($playerData['team'])],
                        'tier' => $tiers[$playerData['tier']]
                    ];
                });

            $damagePerRound = $numOfRounds->zip($statsData)
                ->map(function ($zippedData) {
                    return $zippedData[1]['playerData']['damage']['made'] / $zippedData[0];
                });

            $response = [
                'numOfRounds' => $numOfRounds,
                'statsData' => $statsData,
                'damagePerRound' => $damagePerRound,
                'playerInfo' => $playerName.'#'.$playerTag
            ];

            return response()->json($response);
        }
        catch (Throwable $exception){
            return response(['status' => '404', 'error' => true, 'error-msg' => 'Not found'], 404);
        }
    }
}
