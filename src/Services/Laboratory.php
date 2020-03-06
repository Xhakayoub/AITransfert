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
    public function getPassQuality(Player $player): float
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

    public function getShortPassQuality(Player $player): float
    {

        $minutesPlayed = $player->getMinsPlayed();
        $shortPassesCompleted = $player->getShortPassesCompleted();
        $shortPassesAttempted = $player->getShortpassesAttempted();
        $shortPassesCompletedPercent = $player->getShortPassesCompPercent();
        $shortPassesAttemptedPerMinute = $shortPassesAttempted / $minutesPlayed ;
        $shortPassesCompletedPerMinute = $shortPassesCompleted / $minutesPlayed ;
        

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

    public function getDefendingQuality(Player $player): float {
        return 0.0;
    }


}
