<?php

namespace App\Services\Laboratory\Classes\Tactics;

use App\Entity\Player;
use App\Services\Laboratory\Analysis;
use App\Services\Laboratory\Classes\Styles\Tactic;

class Positions
{
    const GK = [
        "GK" => true,
    ];
    const CB = [
        "DF" => true,
        "lateral" => false,
        "MD" => "maybe",
        "RB" => "maybe",
        "LB" => "maybe",
    ];
    const RB = [
        "DF" => true,
        "lateral" => true,
        "MD" => "maybe"
    ];
    const LB = [
        "DF" => true,
        "lateral" => true,
        "MD" => "maybe"
    ];
    const DM = [
        "MD" => true,
        "lateral" => false,
        "DF" => "maybe"
    ];
    const CM = [
        "MD" => true,
        "lateral" => false,
        "DF" => "maybe"
    ];
    const LM = [
        "MD" => true,
        "lateral" => true,
    ];
    const RM = [
        "MD" => true,
        "lateral" => true,
    ];
    const AM = [
        "MD" => true,
        "lateral" => false,
    ];
    const LW = [
        "FW" => true,
        "MD" => "maybe",
        "lateral" => true,
    ];
    const RW = [
        "FW" => true,
        "MD" => "maybe",
        "lateral" => true,
    ];
    const CW = [
        "FW" => true,
        "MD" => false,
        "lateral" => false,
    ];



    const logic = [
        "DF" => [self::CB, self::LB, self::RB],
        "MD" => [self::DM, self::CM, self::LM, self::RM, self::AM], 
        "FW" => [self::CW, self::RW, self::LW]  
    ];
}
