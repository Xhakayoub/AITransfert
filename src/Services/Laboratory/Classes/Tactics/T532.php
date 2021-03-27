<?php

namespace App\Services\Laboratory\Classes\Tactics;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;


class T532 extends Tactic {

    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::LB,
            "second" => Positions::CB,
            "third" => Positions::CB,
            "fourth" => Positions::CB,
            "fifht" => Positions::RB,
        ],
        "MD" => [
            "second" => [Positions::DM || Positions::CM],
            "third" => [Positions::CM || Positions::AM],
            "fourth" => [Positions::CM || Positions::AM],
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