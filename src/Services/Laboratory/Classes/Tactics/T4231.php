<?php

namespace App\Services\Laboratory\Classes\Tactics;

use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;


class T4231 extends Tactic
{

    const FORMATION = [
        "GK" => 1,
        "DF" => [
            "first" => Positions::LB,
            "second" => Positions::CB,
            "third" => Positions::CB,
            "fourth" => Positions::RB,
        ],
        "MD" => [
            array(
                "first" => Positions::DM,
                "second" => [Positions::DM, Positions::CM]
            ),
            array(
                "first" => [Positions::RB || Positions::RM],
                "second" => [Positions::CM, Positions::AM],
                "fourth" => [Positions::LB || Positions::RM]
            )
        ],
        "FW" => [
            "first" => Positions::CW,
        ]
    ];
    public function getAbilityToBeIN()
    {
        $analysis = new Analysis($this->player);
    }
}
