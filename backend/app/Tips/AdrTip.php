<?php

namespace App\Tips;

use App\Data\PlayerStats;

class AdrTip implements Tip
{
    public function conditionMet(PlayerStats $stats): bool
    {
        return $stats->adr() < 150;
    }

    public function getMessage(): string
    {
        return 'Your damage is lower than one full kill';
    }
}
