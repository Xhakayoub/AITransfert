<?php

namespace App\Services\Laboratory\Classes\Styles;

use App\Entity\Player;

class Tactic
{
    /** @var Player */
    protected $player;

    /** @var array */
    protected $positionsCompatible;

    /** @var Style[] */
    protected $stylesCompatible;

    public function __construct($player)
    {
        $this->positionsCompatible = ['MFDF', 'FW', 'GK', 'DF', 'MF', 'MFFW', 'FWMF', 'DFMF'];
        $this->player = $player;
    }

    /** @return array */
    public function getPositionsCompatible()
    {
        return $this->positionsCompatible;
    }

    /** @return Player */
    public function getPlayer()
    {
        return $this->player;
    }
}
