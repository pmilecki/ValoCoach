<?php

namespace App\Models;

class PlayerStats
{
    public function __construct(
        public string $agent,
        public int $score,
        public int $kills,
        public int $deaths,
        public int $assists,
        public int $bodyshots,
        public int $headshots,
        public int $legshots,
        public int $damage_made,
        public int $damage_received,
        public int $number_of_rounds,
        public int $c_cast,
        public int $q_cast,
        public int $e_cast,
        public int $x_cast)
    {

    }
    public function acs()
    {
        $acs = $this->score / $this->number_of_rounds;
        return number_format($acs, 0);
    }

    public function hsPrecent(): string
    {
        $percentage = (($this->headshots/($this->headshots + $this->bodyshots + $this->legshots))*100);
        return number_format($percentage, 1, '.').'%';
    }
}
