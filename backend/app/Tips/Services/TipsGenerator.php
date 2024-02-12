<?php

namespace App\Tips\Services;

use App\Data\PlayerStats;
use App\Tips\AcsTip;
use App\Tips\AdrTip;
use App\Tips\DddTip;
use App\Tips\HsTip;
use App\Tips\LegshotTip;
use App\Tips\Tip;

class TipsGenerator
{
    private array $duelists = ['Jett', 'Raze', 'Reyna', 'Yoru', 'Iso', 'Phoenix', 'Neon'];
    private array $controllers = ['Brimstone', 'Viper', 'Omen', 'Astra', 'Harbor'];
    private array $initiators = ['Sova', 'Breach', 'Skye', 'KAY/O', 'Fade', 'Gekko'];
    private array $sentinels = ['Killjoy', 'Cypher', 'Sage', 'Chamber', 'Deadlock'];

    /**
     * @var array<int, Tip>
     */
    private array $availableTips;

    public function __construct()
    {
        $this->availableTips = [
            new AcsTip(),
            new AdrTip(),
            new DddTip(),
            new HsTip(),
            new LegshotTip()
        ];
    }

    public function generateTips(PlayerStats $stats)
    {
        return collect($this->availableTips)
            ->filter(static fn (Tip $tip): bool => $tip->conditionMet($stats))
            ->map(static fn (Tip $tip): string => $tip->getMessage());
    }
}
