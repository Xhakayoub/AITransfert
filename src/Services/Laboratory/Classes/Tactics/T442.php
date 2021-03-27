<?php

namespace App\Services\Laboratory\Classes\Tactics;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;


class T442 extends Tactic {
   
    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::LB,
            "second" => Positions::CB,
            "third" => Positions::CB,
            "fourth" => Positions::RB,
        ],
        "MD" => [
            "first" => [Positions::RB || Positions::RM],
            "second" => Positions::CM,
            "third" => Positions::DM,
            "fourth" =>[Positions::LB || Positions::RM]
        ],
        "FW" => [
            "first" => [Positions::CW || Positions::AM],
            "second" => Positions::CW,
        ]
    ];

    public function getAbilityToBeIN()
    {
        $analysis = new Analysis($this->player);
    }
}

?>