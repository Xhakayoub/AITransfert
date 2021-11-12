<?php

namespace App\Services\Laboratory;

use App\Entity\Stats;
use App\Entity\Team;
use App\Services\Laboratory\Level1;
use App\Services\Laboratory\Level2;
use App\Services\Laboratory\Classes\Styles\Agressif;
use App\Services\Laboratory\Classes\Styles\Defensif;
use App\Services\Laboratory\Classes\Styles\Possessioner;
use App\Services\Laboratory\Classes\Styles\CounterAttacker;

class Level3
{

    public function getAbilityToPlayInStyle($style, $player)
    {
        $res = 0;

        $className = "App\\Services\\Laboratory\\Classes\\Styles\\{$style}";
        $style = new $className($player);

        return $style;
    }

    public function getAbilityToPlayInTactic($tactic, $player)
    {
        $res = 0;

        $className = "App\\Services\\Laboratory\\Classes\\Styles\\{$tactic}";
        $tactic = new $className($player);

        return $tactic;
    }

    public function getPerformanceContinuity($player)
    {
        return true;
    }
}
