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
            //$apiAdress = 'https://api.henrikdev.xyz/valorant/v3/matches/%s/%s/%s?filter=%s';
            $apiAdress = 'https://api.henrikdev.xyz/valorant/v1/lifetime/matches/%s/%s/%s?mode=%s&size=10';
            $apiResponseAdress = sprintf($apiAdress, $server, $playerName, $playerTag, $queue);
            $apiResponse = Http::get($apiResponseAdress);

            $json = $apiResponse->json();
            $data = collect($json['data']);

//            $numOfRounds = $data->map(fn(array $match) => count($match['rounds']));
            $numOfRounds = $data->map(fn(array $match) => ($match['teams']['red']) + ($match['teams']['blue']));

            $statsData = $data
                ->map(function (array $match) {
                    $playerData = collect($match['stats']);
                    //$playerData = collect($match['players']['all_players']);
                        //->first(fn(array $player) => Str::lower($player['name']) === Str::lower($playerName) && Str::lower($player['tag']) === Str::lower($playerTag));

                    return [
                        'matchId' => $match['meta']['id'],
                        'playerData' => collect($playerData)->only([
                            'tier', 'shots', 'damage', 'character', 'team', 'name', 'tag', 'puuid'
                        ]),
                        'score' => $match['teams'][Str::lower($playerData['team'])]
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
