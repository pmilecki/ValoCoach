<?php

namespace App\Tips;

use App\Data\PlayerStats;

class HsTip implements Tip
{
    public function conditionMet(PlayerStats $stats): bool
    {
        return $stats->hsPercent() < 20;
    }

    public function getMessage(): string
    {
        return 'Your head shot percentage is low. You should work on your crosshair placement to keep it on the head level';
    }
}
