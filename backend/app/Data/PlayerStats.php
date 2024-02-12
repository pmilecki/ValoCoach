<?php

namespace App\Data;

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
    public function acs(): int
    {
        $acs = $this->score / $this->number_of_rounds;
        return number_format($acs, 0);
    }

    public function hsPercent(): float
    {
        $percentage = (($this->headshots/($this->headshots + $this->bodyshots + $this->legshots))*100);
        return number_format($percentage, 1);
    }

    public function adr(): int
    {
        $adr = $this->damage_made / $this->number_of_rounds;
        return number_format($adr, 0);
    }

    public function ddDelta(): int
    {
        $ddd = ($this->damage_made - $this->damage_received) / $this->number_of_rounds;
        return number_format($ddd, 0);
    }

    public function kpr(): float
    {
        $kpr = $this->kills / $this->number_of_rounds;
        return number_format($kpr, 1);
    }

    public function legShots(): float
    {
        $legshots = (($this->legshots/($this->headshots + $this->bodyshots + $this->legshots))*100);
        return  number_format($legshots, 0);
    }
}
