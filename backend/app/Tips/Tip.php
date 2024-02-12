<?php

namespace App\Tips;

use App\Data\PlayerStats;

interface Tip
{
    public function conditionMet(PlayerStats $stats): bool;
    public function getMessage(): string;
}
