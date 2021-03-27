<?php

namespace App\Services\Laboratory\Classes\Tactics;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;


class T433 extends Tactic {

    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::LB,
            "second" => Positions::CB,
            "third" => Positions::CB,
            "fourth" => Positions::RB,
        ],
        "MD" => [
            "first" => [Positions::DM || Positions::CM],
            "second" => [Positions::CM || Positions::AM],
            "third" => [Positions::CM || Positions::AM]
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

?>