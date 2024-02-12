<?php

namespace App\Tips;

use App\Data\PlayerStats;

class DddTip implements Tip
{
    public function conditionMet(PlayerStats $stats): bool
    {
        return $stats->ddDelta() < 0;
    }

    public function getMessage(): string
    {
        return 'Your damage difference delta is lower than 0, which mean you are dealing less damage than receiving. You should work on taking better duels';
    }
}
