<?php

namespace App\Services;

use App\Entity\Player;
use Symfony\Flex\Unpack\Result;

class Laboratory
{
    /**
     * 
     * Function finished 
     */

    public function getPassingCompletedNote(float $value): int
    {

        if ($value) {
            if ($value > 1) $res = 10;
            if ($value > 0.8 and $value < 1)  $res = 9;
            if (0.5 < $value and $value < 0.8)  $res = 8;
            if (0.3 < $value and $value < 0.5)  $res = 7;
            if (0.2 < $value and $value < 0.3) $res = 6;
            if (0.1 < $value and $value < 0.2) $res = 5;
            else $res = 0;
        }
        return $res;
     
    }

    public function getAssistNote(float $value): int
    {

        if ($value) {
            if ($value > 2) $res = 10;
            if ($value > 1.5 and $value < 2)  $res = 9;
            if (1 < $value and $value < 1.5)  $res = 8;
            if (0.5 < $value and $value < 1)  $res = 7;
            if (0.3 < $value and $value < 0.5) $res = 6;
            if (0 < $value and $value < 0.3) $res = 5;
            else $res = 0;
        }
        return $res;
    }


    public function getPassQuality(Player $player): float
    {

        $keyPasses = $player->getKeyPasses();
        $assistsPerMinute = $player->getAssistsPerMin();
        $passesCompleted = $player->getPassesCompleted();
        $passesAttempted = $player->getPassesAttempted();
        $passCompletedPercent = $player->getPassCompPercent();
        $minutesPlayed = $player->getMinsPlayed();

        if ($minutesPlayed >= 160) {

            $passAttPerMin = $passesAttempted / $minutesPlayed;
            $passCompPerMin = $passesCompleted / $minutesPlayed;
            $keyPassesPerMin = $keyPasses / $minutesPlayed;


            $result = $passAttPerMin * 0.08 + $passCompPerMin * 0.32
                + $keyPassesPerMin * 0.2 +  $assistsPerMinute * 0.3
                + ($minutesPlayed / 1000);

            return $result;
        }
    }

    public function getShortPassQuality(Player $player): float
    {

        $minutesPlayed = $player->getMinsPlayed();
        $shortPassesCompleted = $player->getShortPassesCompleted();
        $shortPassesAttempted = $player->getShortpassesAttempted();
        $shortPassesCompletedPercent = $player->getShortPassesCompPercent();
        $shortPassesAttemptedPerMinute = $shortPassesAttempted / $minutesPlayed;
        $shortPassesCompletedPerMinute = $shortPassesCompleted / $minutesPlayed;


        if ($minutesPlayed >= 160) {

            $result = $shortPassesAttemptedPerMinute * 0.08 + $shortPassesCompletedPercent * 0.32
                + $shortPassesCompletedPerMinute * 0.2 +  $shortPassesCompletedPerMinute * 0.3
                + ($minutesPlayed / 1000);

            return $result;
        }
    }

    public function getLongPassQuality(Player $player): float
    {

        $keyPasses = $player->getKeyPasses();
        $assistsPerMinute = $player->getAssistsPerMin();
        $passesCompleted = $player->getPassesCompleted();
        $passesAttempted = $player->getPassesAttempted();
        $minutesPlayed = $player->getMinsPlayed();

        if ($minutesPlayed >= 160) {

            $passAttPerMin = $passesAttempted / $minutesPlayed;
            $passCompPerMin = $passesCompleted / $minutesPlayed;
            $keyPassesPerMin = $keyPasses / $minutesPlayed;


            $result = $passAttPerMin * 0.08 + $passCompPerMin * 0.32
                + $keyPassesPerMin * 0.2 +  $assistsPerMinute * 0.3
                + ($minutesPlayed / 1000);

            return $result;
        }
    }

    public function getMediumPassQuality(Player $player): float
    {

        $keyPasses = $player->getKeyPasses();
        //$assists = $player->getAssits();
        $assistsPerMinute = $player->getAssistsPerMin();
        $passesCompleted = $player->getPassesCompleted();
        $passesAttempted = $player->getPassesAttempted();
        $minutesPlayed = $player->getMinsPlayed();

        if ($minutesPlayed >= 160) {

            $passAttPerMin = $passesAttempted / $minutesPlayed;
            $passCompPerMin = $passesCompleted / $minutesPlayed;
            $keyPassesPerMin = $keyPasses / $minutesPlayed;


            $result = $passAttPerMin * 0.08 + $passCompPerMin * 0.32
                + $keyPassesPerMin * 0.2 +  $assistsPerMinute * 0.3
                + ($minutesPlayed / 1000);

            return $result;
        }
    }

    public function getShootQuality(Player $player): float
    {
        return 0.0;
    }

    public function getScoringQuality(Player $player): float
    {
        return 0.0;
    }

    public function getDefendingQuality(Player $player): float
    {
        return 0.0;
    }
}
