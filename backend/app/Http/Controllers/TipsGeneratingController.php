<?php

namespace App\Http\Controllers;

use App\Data\PlayerStats;
use App\Tips\Services\TipsGenerator;
use Illuminate\Support\Facades\Http;

class TipsGeneratingController extends Controller
{
    public function __invoke(string $matchId, string $puuId)
    {
        $apiAdress = 'https://api.henrikdev.xyz/valorant/v2/match/%s';
        $apiResponseAdress = sprintf($apiAdress, $matchId);
        $apiResponse = Http::get($apiResponseAdress);

        $json = $apiResponse->json();
        $data = collect($json['data']);

        $numOfRounds = count($data['rounds']);
        $statsData = collect($data['players']['all_players'])->where('puuid', $puuId)->first();

        $response = [
            'agent' => $statsData['character'],
            'score' => $statsData['stats']['score'],
            'kills' => $statsData['stats']['kills'],
            'deaths' => $statsData['stats']['deaths'],
            'assists' => $statsData['stats']['assists'],
            'bodyshots' => $statsData['stats']['bodyshots'],
            'headshots' => $statsData['stats']['headshots'],
            'legshots' => $statsData['stats']['legshots'],
            'damage_made' => $statsData['damage_made'],
            'damage_received' => $statsData['damage_received'],
            'number_of_rounds' => $numOfRounds,
            'c_cast' => $statsData['ability_casts']['c_cast'],
            'q_cast' => $statsData['ability_casts']['q_cast'],
            'e_cast' => $statsData['ability_casts']['e_cast'],
            'x_cast' => $statsData['ability_casts']['x_cast']
        ];

        $player = new PlayerStats(($response['agent']), $response['score'], $response['kills'], $response['deaths'], $response['assists']
            , $response['bodyshots'], $response['headshots'], $response['legshots'], $response['damage_made'], $response['damage_received']
            , $response['number_of_rounds'], $response['c_cast'], $response['q_cast'], $response['e_cast'], $response['x_cast']);

        $tips = new TipsGenerator();

        return response()->json($tips->generateTips($player));
    }
}
