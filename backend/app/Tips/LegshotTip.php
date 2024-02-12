<?php

namespace App\Tips;

use App\Data\PlayerStats;

class LegshotTip implements Tip
{
    public function conditionMet(PlayerStats $stats): bool
    {
        return $stats->legShots() > 10;
    }

    public function getMessage(): string
    {
        return 'You have high percent of hitting legs of enemies. Keep your crosshair higher';
    }
}
