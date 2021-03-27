<?php

namespace App\Services\Laboratory\Classes\Tactics;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;


class T361 extends Tactic {

    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::CB,
            "second" => Positions::CB,
            "third" => Positions::CB,
        ],
        "MD" => [
            "first" => [Positions::RB || Positions::RM],
            "second" => [Positions::CM, Positions::DM],
            "third" => [Positions::DM, Positions::CM],
            "fourth" =>[Positions::CM, Positions::DM],
            "fourth" =>[Positions::CM, Positions::AM],
            "fifth" =>[Positions::LB || Positions::RM]
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