<?php

namespace App\Services;

use App\Entity\Player;
use App\Entity\Team;
use App\Services\Level1;


class Level2
{
    /**
     * passe quality 
     */
    public function getPassQuality(Player $player): array {

        $keyPasses = Level1::getKeyPassRating($player); //$player->getKeyPasses();
        $assistsPerMinute = Level1::getAssistRating($player); //$player->getAssistsPerMin();
        $passesCompletion = Level1::getPassCompletedPercentRating($player); //$player->getPassesCompleted();
        $passesCompleted = Level1::getPassCompletedRating($player);
        $passesAttempted = Level1::getPassAttemptedRating($player); //$player->getPassesAttempted();
        $TB = Level1::getThroughBallRating($player);
        $passIntoPenArea = Level1::getPassIntoPenaltyAreaRating($player);
        $passIntoFinalThird = Level1::getPassIntoFinalThirdRating($player);
        $minutesPlayed = $player->getMinsPlayed();

        if ($minutesPlayed >= 160) {

            // $passAttPerMin = $passesAttempted / $minutesPlayed;
            // $passCompPerMin = $passesCompleted / $minutesPlayed;
            // $keyPassesPerMin = $keyPasses / $minutesPlayed;


            $rate = $passesAttempted * 0.05 + 
                    (($passesCompletion  +  $passesCompleted) / 2) * 0.4 + 
                    $keyPasses * 0.11 +  $assistsPerMinute * 0.11 + $TB * 0.11 + $passIntoFinalThird * 0.11 + 
                    $passIntoPenArea * 0.11;

            $message = "" ;

            $result = array("rate" => $rate, "message" => $message);

            return $result;
        }
    }


    public function getNegativeAggressiveness(Player $player): array {
     
    
     $fouls = Level1::getFoulsPerMinuteRating($player);
     $yellowCards = Level1::getYellowCardPer90MinutesRating($player);
     $redCards = Level1::getRedCardPer90MinutesRating($player);
     $secondYellowCard = Level1::getSecondYellowCardPer90MinutesRating($player);
     $tackles = Level1::getTacklesVsDribblesAttemptedPer90MinutesRating($player);
     $penaltiesConceded = Level1::getPenaltyKickConcededRating($player);

     $rate = $fouls * 0.2 +
             $yellowCards * 0.1 +
             $penaltiesConceded * 0.15 +
             $redCards * 0.25 +
             $secondYellowCard * 0.2 + 
             $tackles * 0.1 ;

     $message = "";

     $result = array("rate" => $rate, "message" => $message);  

     return $result;

    }


    public function getPositiveAggressiveness(Player $player): array {
     
    
        $tacklesWon = Level1::getTacklesWonPerMinuteRating($player);
        $tackles = Level1::getTacklesVsDribblesAttemptedPer90MinutesRating($player);
        $tackleCompletion = Level1::getTacklesPercentRating($player);
        $secondYellowCard = Level1::getSecondYellowCardPer90MinutesRating($player);
        $redCards = Level1::getRedCardPer90MinutesRating($player);
        
   
        $rate = ($tacklesWon * 0.4 + $tackleCompletion * 0.6) * 0.35 +
                $redCards * 0.25 +
                $secondYellowCard * 0.2 +
                $tackles * 0.2 ;
   
        $message = "";
   
        $result = array("rate" => $rate, "message" => $message);  
        
        return $result;
       
    }
  
    
    
    public function getDefensiveQuality(Player $player): array {
       
        
        $tacklesWon = Level1::getTacklesWonPerMinuteRating($player);
        $tackleCompletion = Level1::getTacklesPercentRating($player);
        $interceptions = Level1::getInterceptionsPerMinuteRating($player);
        $goalsAllowed = Level1::getGoalsAllowedWhileOnPitchRating($player);
        $message = "";
        
        $rate = $tacklesWon * 0.2 + 
                $tackleCompletion * 0.3 +
                $interceptions * 0.3 +
                $goalsAllowed * 0.2 ;

        $result = array("rate" => $rate, "message" => $message);  
        
        return $result;
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

    /**
     * passe quality to redo
     */
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

    /**
     * passe quality to redo
     */
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
