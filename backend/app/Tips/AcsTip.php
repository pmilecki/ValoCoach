<?php

namespace App\Tips;

use App\Data\PlayerStats;

class AcsTip implements Tip
{
    public function conditionMet(PlayerStats $stats): bool
    {
        return $stats->acs() < 200;
    }

    public function getMessage(): string
    {
        return 'Your combat score is on the lower side. Combat score is sum of damage dealt, assisting with abilities and by making multi kills';
    }
}
