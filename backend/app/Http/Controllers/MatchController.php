<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function sprintf;

class MatchController extends Controller
{
    public function __invoke(string $matchId)
    {
        // https://api.henrikdev.xyz/valorant/v2/match/20743b36-01f1-439a-aed0-e7082702da6a

        $apiAdress = 'https://api.henrikdev.xyz/valorant/v2/match/%s';
        $apiResponseAdress = sprintf($apiAdress, $matchId);
        $apiResponse = Http::get($apiResponseAdress);

        $json = $apiResponse->json();
        $data = $json['data'];

        $numOfRounds = count($data['rounds']);
        $scoreRed = collect($data['teams']['red']);
        $scoreBlue = collect($data['teams']['blue']);

        $response = [
            'matchInfo' => [
                'red' => collect($data['players']['red'])->map(fn (array $player) => $this->mapPlayerData($player))->sortByDesc('stats.score')->values()->toArray(),
                'blue' => collect($data['players']['blue'])->map(fn (array $player) => $this->mapPlayerData($player))->sortByDesc('stats.score')->values()->toArray(),
            ],
            'numOfRounds' => $numOfRounds,
            'scoreRed' => $scoreRed,
            'scoreBlue' => $scoreBlue
        ];

        return($response);
    }

    private function mapPlayerData(array $player): array
    {
        return collect($player)->only(['name', 'tag', 'puuid', 'assets', 'stats', 'damage_made', 'damage_received'])->toArray();
    }
}


