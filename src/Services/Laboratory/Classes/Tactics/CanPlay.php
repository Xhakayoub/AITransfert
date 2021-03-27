<?php

namespace App\Services\Laboratory\Classes\Tactics;

use App\Entity\Player;
use App\Services\Laboratory\Classes\Styles\Tactic;

class CanPlay
{

    /** @var Player */
    protected $player;

    public function __construct(Player $player, Tactic $tactic)
    {
        $this->player = $player;
        $this->Tactic = $tactic;
    }

    public function completeAnalys()
    {
        $playerPostions = $this->player->getPosition();
        // call of child class of tactic to analys positions abitily for the player 
        $tactics  = array();
        foreach (get_declared_classes() as $class) {
            if ($class instanceof Tactic) $tactics[] = $class;
        }

        foreach ($tactics as $tactic) {
            $formation = $tactic::FORMATION;
        }
    }

    public function comparePlayerPositionWithFormation($position, $formation)
    {
        switch ($position) {
            case 'GK':
                return true;
                break;
            case 'DF':
                return in_array($this->getTacticPosition(), $formation['DF']);
                break;
            case 'MD':
                return in_array($this->getTacticPosition(), $formation['MD']);
                break;
            case 'FW':
                return in_array($this->getTacticPosition(), $formation['FW']);
                break;
        }
    }

    public function getTacticPosition()
    {
    }
}
