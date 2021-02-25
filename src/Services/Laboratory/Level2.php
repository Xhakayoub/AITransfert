<?php

namespace App\Services\Laboratory;

use App\Entity\Player;
use App\Entity\Team;
use App\Services\Laboratory\Level1;


class Level2
{
    /**
     * passe quality 
     */
    public function getPassQuality(Player $player): array
    {

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

            $message = "";
            switch ($rate) {
                case 10:
                    $message = "Player with an huge impact, can be a big leader for any club";
                    break;
                case 9:
                    $message = "";
                    break;
                case 8:
                    $message = "";
                    break;
                case 7:
                    $message = "";
                    break;
                case 6:
                    $message = "";
                    break;
                case 5:
                    $message = "";
                    break;
                case 4:
                    $message = "";
                    break;
                default;    
            } 
            
            $result = array("rate" => $rate, "message" => $message);

            return $result;
        }
    }


    public function getNegativeAggressiveness(Player $player): array
    {


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
            $tackles * 0.1;

        $message = "";
        switch ($rate) {
            case 10:
                $message = "Player with an huge impact, can be a big leader for any club";
                break;
            case 9:
                $message = "";
                break;
            case 8:
                $message = "";
                break;
            case 7:
                $message = "";
                break;
            case 6:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
            case 4:
                $message = "";
                break;
            default;    
        }

        $result = array("rate" => $rate, "message" => $message);

        return $result;
    }


    public function getPositiveAggressiveness(Player $player): array
    {


        $tacklesWon = Level1::getTacklesWonPerMinuteRating($player);
        $tackles = Level1::getTacklesVsDribblesAttemptedPer90MinutesRating($player);
        $tackleCompletion = Level1::getTacklesPercentRating($player);
        $secondYellowCard = Level1::getSecondYellowCardPer90MinutesRating($player);
        $redCards = Level1::getRedCardPer90MinutesRating($player);


        $rate = ($tacklesWon * 0.4 + $tackleCompletion * 0.6) * 0.35 +
            $redCards * 0.25 +
            $secondYellowCard * 0.2 +
            $tackles * 0.2;

        $message = "";
        switch ($rate) {
            case 10:
                $message = "Player with an huge impact, can be a big leader for any club";
                break;
            case 9:
                $message = "";
                break;
            case 8:
                $message = "";
                break;
            case 7:
                $message = "";
                break;
            case 6:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
            case 4:
                $message = "";
                break;
            default;    
        }
        $result = array("rate" => $rate, "message" => $message);

        return $result;
    }



    public function getDefensiveQuality(Player $player): array
    {


        $tacklesWon = Level1::getTacklesWonPerMinuteRating($player);
        $tackleCompletion = Level1::getTacklesPercentRating($player);
        $interceptions = Level1::getInterceptionsPerMinuteRating($player);
        $goalsAllowed = Level1::getGoalsAllowedWhileOnPitchRating($player);
        $message = "";

        $rate = $tacklesWon * 0.2 +
            $tackleCompletion * 0.3 +
            $interceptions * 0.3 +
            $goalsAllowed * 0.2;

            switch ($rate) {
                case 10:
                    $message = "Player with an huge impact, can be a big leader for any club";
                    break;
                case 9:
                    $message = "";
                    break;
                case 8:
                    $message = "";
                    break;
                case 7:
                    $message = "";
                    break;
                case 6:
                    $message = "";
                    break;
                case 5:
                    $message = "";
                    break;
                case 4:
                    $message = "";
                    break;
                default;    
            }

        $result = array("rate" => $rate, "message" => $message);

        return $result;
    }


    public function getPositiveImpact(Player $player): array
    {

        $scoring = Level1::getGoalPerTenMinuteRating($player);
        $assisting = Level1::getAssistRating($player);
        $tackling = Level1::getTacklesWonPerMinuteRating($player);
        $defending = Level1::getInterceptionsPerMinuteRating($player);


        $message = "";
        $position = $player->getPosition();
        if($position == 'DF'){ $scoringCoef = 0.1; $assistingCoef = 0.1; $tackilngCoef = 0.4; $defendingCoef = 0.4;}
        elseif ($position =='MF'){ $scoringCoef = 0.22; $assistingCoef = 0.23; $tackilngCoef = 0.23; $defendingCoef = 0.22;}
        elseif ($position == 'FW'){ $scoringCoef = 0.4; $assistingCoef = 0.4; $tackilngCoef = 0.1; $defendingCoef = 0.1;}
        $rate = $scoring * $scoringCoef +
            $assisting * $assistingCoef +
            $tackling  * $tackilngCoef +
            $defending * $defendingCoef;

        switch ($rate) {
            case 10:
                $message = "Player with an huge impact, can be a big leader for any club";
                break;
            case 9:
                $message = "";
                break;
            case 8:
                $message = "";
                break;
            case 7:
                $message = "";
                break;
            case 6:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
            case 4:
                $message = "";
                break;
            default;    
        }

        $result = array("rate" => $rate, "message" => $message);
        return $result;
    }

    public function getNegativeImpact(Player $player): array
    {

        $agressivness = $this->getNegativeAggressiveness($player);
        $goalsAllowed = Level1::getGoalsAllowedWhileOnPitchRating($player);
        $ownGoals = Level1::getOwnGoalsRating($player);
        $offsides = Level1::getOffsideRating($player);
        $shootOut = (Level1::getShootRating($player) - Level1::getShootOnTargetRating($player)) * 1.666666666666667;


        $message = "";
        $position = $player->getPosition();
        if($position == 'DF'){ $agressivnessCoef = 0.3; $goalsAllowedCoef = 0.2; $offsidesCoef = 0.05; $ownGoalsCoef = 0.3; $shootOutCoeff = 0.05;}
        elseif ($position =='MF'){ $agressivnessCoef = 0.2; $goalsAllowedCoef = 0.15; $offsidesCoef = 0.2; $ownGoalsCoef = 0.2; $shootOutCoeff = 0.2;}
        elseif ($position == 'FW'){ $agressivnessCoef = 0.1; $goalsAllowedCoef = 0.1; $offsidesCoef = 0.3; $ownGoalsCoef = 0.1; $shootOutCoeff = 0.4;}
        $rate = $agressivness * $agressivnessCoef +
            $goalsAllowed * $goalsAllowedCoef +
            $ownGoals  * $ownGoalsCoef +
            $shootOut  * $shootOutCoeff +
            $offsides * $offsidesCoef;

        switch ($rate) {
            case 10:
                $message = "To avoid, player with a big negative impact";
                break;
            case 9:
                $message = "";
                break;
            case 8:
                $message = "";
                break;
            case 7:
                $message = "";
                break;
            case 6:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
            case 4:
                $message = "";
                break;
            default;    
        }

        $result = array("rate" => $rate, "message" => $message);
        return $result;
    }




    public function getShortPassQuality(Player $player): array
    {

        $shortPassesCompleted = Level1::getShortPassCompletedRating($player);
        $shortPassesAttempted = Level1::getShortPassAttemptedRating($player);
        $shortPassesCompletion = Level1::getShortPassCompletionPerCentRating($player);
        $mediumPassesCompleted = Level1::getMediumPassCompletedRating($player);
        $mediumPassesAttempted = Level1::getMediumPassAttemptedRating($player);
        $mediumPassesCompletion = Level1::getMediumPassCompletionPerCentRating($player);

       $shortRate = ($shortPassesAttempted * 0.2 +
               $shortPassesCompleted * 0.35 +
               $shortPassesCompletion * 0.45 ) ;

       $mediumRate = ($mediumPassesAttempted * 0.2 +
               $mediumPassesCompleted * 0.35 +
               $mediumPassesCompletion * 0.45 )  ;

        $rate = $shortRate * 0.3 + $mediumRate * 0.7 ;

        switch ($rate) {
            case 10:
                $message = "With a massive pass Quality, considrered as a possesion player ";
                break;
            case 9:
                $message = "";
                break;
            case 8:
                $message = "";
                break;
            case 7:
                $message = "";
                break;
            case 6:
                $message = "";
                break;
            case 5:
                $message = "";
                break;
            case 4:
                $message = "";
                break;
            default;    
        }

        $result = array("rate" => $rate, "message" => $message);
        return $result;
        
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
