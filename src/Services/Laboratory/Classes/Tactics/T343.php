<?php

namespace App\Services\Laboratory\Classes\Tactics;

use App\Entity\Player;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;
use App\Services\Laboratory\Classes\Tactics\Positions;
class T343 extends Tactic
{
    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::CB,
            "second" => Positions::CB,
            "third" => Positions::CB,
        ],
        "MD" => [
            "first" => [Positions::RB || Positions::RM],
            "second" => Positions::CM,
            "third" => Positions::DM,
            "fourth" =>[Positions::LB || Positions::RM]
        ],
        "FW" => [
            "first" => [Positions::RW || Positions::RM],
            "second" => Positions::CW,
            "third" => [Positions::LW || Positions::LM]
        ]
    ];

    public function getAbilityToBeIN()
    {
        $analysis = new Analysis($this->player);
    }
}
