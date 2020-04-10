<?php

namespace App\Services;

use App\Entity\Player;
use App\Entity\Team;

class Laboratory
{


    /**
     * Les fonctions de base
     */



    /**
     * return the rate of the assist to redo
     */
    public function getAssistNote(Player $player): int
    {
        if ($player) {
            $value = $player->getAssistsPerMin();
            if ($value >= 1) $res = 10;
            if ($value <= 1 and $value > 0.7)  $res = 9;
            if (0.7 >= $value and $value > 0.5)  $res = 8;
            if (0.5 >= $value and $value > 0.3)  $res = 7;
            if (0.3 >= $value and $value > 0.2) $res = 6;
            if (0.2 >= $value and $value > 0.1) $res = 5;
            if (0.1 >= $value and $value > 0) $res = 4;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the shoot
     */
    public function getShootRating(Player $player): int
    {
        if ($player) {
            $value = $player->getShootsPerMatch();
            if ($value >= 6) $res = 10;
            if ($value >= 4 and $value < 6)  $res = 9;
            if (3 <= $value and $value < 4)  $res = 8;
            if (2 <= $value and $value < 2.5)  $res = 7;
            if (1.5 <= $value and $value < 2) $res = 6;
            if (0.5 <= $value and $value < 1.5) $res = 5;
            if (0 < $value and $value < 0.5) $res = 4;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the age
     */
    public function getAgeRating(Player $player): int
    {
        if ($player) {
            $value = $player->getAge();
            if ($value <= 18) $res = 10;
            if ($value <= 20 and $value > 18)  $res = 9.5;
            if (24 >= $value and $value > 20)  $res = 8.5;
            if (27 >= $value and $value > 24)  $res = 7.5;
            if (29 >= $value and $value > 27) $res = 7;
            if (31 >= $value and $value > 29) $res = 6;
            if (33 >= $value and $value > 31) $res = 5;
            else $res = 4;
        }
        return $res;
    }

    /**
     * return the rate of the shoot on target
     */
    public function getShootOnTargetRating(Player $player): int
    {
        if ($player) {
            $value = $player->getShootsOnTargetPerMatch();
            if ($value >= 3.8) $res = 10;
            if ($value >= 2.5 and $value < 3.8)  $res = 9;
            if (2 <= $value and $value < 2.5)  $res = 8;
            if (1.7 <= $value and $value < 2)  $res = 7;
            if (1.5 <= $value and $value < 1.7) $res = 6;
            if (1 <= $value and $value < 1.5) $res = 5;
            if (0 < $value and $value < 1) $res = 5;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the goal per shoot
     */
    public function getGoalPerShootRating(Player $player): int
    {
        if ($player) {
            $value = $player->getGoalsPerShoot();
            if ($value >= 0.5) $res = 10;
            if ($value >= 0.28 and $value < 0.5)  $res = 9;
            if (0.2 <= $value and $value < 0.28)  $res = 8;
            if (0.15 <= $value and $value < 0.2)  $res = 7;
            if (0.1 <= $value and $value < 0.15) $res = 5;
            if (0.04 <= $value and $value < 0.1) $res = 4;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the role in the squad
     */
    public function getRoleInSquadRating(Player $player, Team $team): int
    {

        $played = $player->getMatchsPlayed();
        $started = $player->getMatchStarts();
        $MacthsOfTeam = $team->getMatchPlayed();

        $playedNote = $played / $MacthsOfTeam;
        $startedNote = $started / $MacthsOfTeam;
        $finalNote = (($playedNote * 3) + ($startedNote * 7)) / 10;

        return $finalNote;
    }

    /**
     * return the rate of the role in the squad
     */
    public function getGoalPerTenMinuteRating(Player $player): int
    {

        if ($player) {
            $goals = $player->getGoals();
            $minutes = $player->getMinutesPlayed();
            $value = ($goals / $minutes) * 10;
            if ($value >= 0.1) $res = 10;
            if ($value < 0.1 and $value >= 0.08)  $res = 9;
            if ($value < 0.08 and $value >= 0.07)  $res = 8;
            if ($value < 0.07 and $value >= 0.06)  $res = 7;
            if ($value < 0.06 and $value >= 0.05)  $res = 6;
            if ($value < 0.05 and $value >= 0.04)  $res = 5;
            if ($value < 0.04 and $value >= 0.02)  $res = 4;
            if ($value < 0.02 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the role in the squad
     */
    public function getCrossesPerMinuteRating(Player $player): int
    {

        if ($player) {
            $crosses = $player->getCrosses();
            $minutes = $player->getMinutesPlayed();
            $value = ($crosses / $minutes);
            if ($value >= 0.1) $res = 10;
            if ($value < 0.1 and $value >= 0.08)  $res = 9;
            if ($value < 0.08 and $value >= 0.07)  $res = 8;
            if ($value < 0.07 and $value >= 0.06)  $res = 7;
            if ($value < 0.06 and $value >= 0.05)  $res = 6;
            if ($value < 0.05 and $value >= 0.04)  $res = 5;
            if ($value < 0.04 and $value >= 0.02)  $res = 4;
            if ($value < 0.02 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the shoot
     */
    public function getFoulsPerMinuteRating(Player $player): int
    {
        if ($player) {
            $fouls = $player->getFoulsCommited();
            $minutes = $player->getMinutesPlayed();
            $value = ($fouls / $minutes) * 10;
            if ($value >= 0.3) $res = 10;
            if ($value < 0.3 and $value >= 0.2)  $res = 9;
            if ($value < 0.2 and $value >= 0.16)  $res = 8;
            if ($value < 0.16 and $value >= 0.12)  $res = 7;
            if ($value < 0.12 and $value >= 0.1)  $res = 6;
            if ($value < 0.1 and $value >= 0.08)  $res = 5;
            if ($value < 0.08 and $value >= 0.06)  $res = 4;
            if ($value < 0.06 and $value >= 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the shoot
     */
    public function getTacklesWonPerMinuteRating(Player $player): int
    {
        if ($player) {
            $tackles = $player->getTacklesWon();
            $minutes = $player->getMinutesPlayed();
            $value = ($tackles / $minutes) * 10;
            if ($value >= 0.32) $res = 10;
            if ($value < 0.32 and $value >= 0.28)  $res = 9;
            if ($value < 0.28 and $value >= 0.23)  $res = 8;
            if ($value < 0.23 and $value >= 0.20)  $res = 7;
            if ($value < 0.20 and $value >= 0.17)  $res = 6;
            if ($value < 0.17 and $value >= 0.12)  $res = 5;
            if ($value < 0.12 and $value >= 0.06)  $res = 4;
            if ($value < 0.06 and $value >= 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the shoot
     */
    public function getInterceptionsPerMinuteRating(Player $player): int
    {
        if ($player) {
            $interceptions = $player->getInterceptions();
            $minutes = $player->getMinutesPlayed();
            $value = ($interceptions / $minutes) * 10;
            if ($value >= 0.32) $res = 10;
            if ($value < 0.32 and $value >= 0.28)  $res = 9;
            if ($value < 0.28 and $value >= 0.23)  $res = 8;
            if ($value < 0.23 and $value >= 0.20)  $res = 7;
            if ($value < 0.20 and $value >= 0.17)  $res = 6;
            if ($value < 0.17 and $value >= 0.12)  $res = 5;
            if ($value < 0.12 and $value >= 0.06)  $res = 4;
            if ($value < 0.06 and $value >= 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getYellowCardPer90MinutesRating(Player $player): int
    {
        if ($player) {
            $yellowCards = $player->getYellowCard();
            $minutes = $player->getMinutesPlayed();
            $value = ($yellowCards / $minutes) * 90;
            if ($value >= 0.7) $res = 0;
            if ($value < 0.7 and $value >= 0.6)  $res = 3;
            if ($value < 0.6 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value >= 0.4)  $res = 5;
            if ($value < 0.4 and $value >= 0.3)  $res = 6;
            if ($value < 0.3 and $value >= 0.2)  $res = 7;
            if ($value < 0.2 and $value >= 0.1)  $res = 8;
            if ($value < 0.1 and $value > 0)  $res = 9;
            else $res = 10;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getRedCardPer90MinutesRating(Player $player): int
    {
        if ($player) {
            $redCards = $player->getRedCard();
            $minutes = $player->getMinutesPlayed();
            $value = ($redCards / $minutes) * 90;
            if ($value >= 0.2) $res = 0;
            if ($value < 0.2 and $value >= 0.15)  $res = 3;
            if ($value < 0.15 and $value >= 0.12)  $res = 4;
            if ($value < 0.12 and $value >= 0.10)  $res = 5;
            if ($value < 0.10 and $value >= 0.08)  $res = 6;
            if ($value < 0.08 and $value >= 0.06)  $res = 7;
            if ($value < 0.06 and $value >= 0.03)  $res = 8;
            if ($value < 0.03 and $value > 0)  $res = 9;
            else $res = 10;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getTacklesVsDribblesAttemptedPer90MinutesRating(Player $player): int
    {
        if ($player) {
            $dribblesTackled = $player->getDribbleTackled();
            $minutes = $player->getMinutesPlayed();
            $value = ($dribblesTackled / $minutes) * 90;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 4)  $res = 9;
            if ($value < 4 and $value >= 3.5)  $res = 8;
            if ($value < 3.5 and $value >= 3)  $res = 7;
            if ($value < 3 and $value >= 2.5)  $res = 6;
            if ($value < 2.5 and $value >= 1.5)  $res = 5;
            if ($value < 1.5 and $value >= 1)  $res = 4;
            if ($value < 1 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getTacklesPercentRating(Player $player): int
    {
        if ($player) {
            $dribblesTackled = $player->getDribbleTackledPercent();
            $value = ($dribblesTackled / 10);
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 4)  $res = 9;
            if ($value < 4 and $value >= 3)  $res = 8;
            if ($value < 3 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1.5)  $res = 6;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getDribblePastRating(Player $player): int
    {
        if ($player) {
            $redCards = $player->getRedCard();
            $minutes = $player->getMinutesPlayed();
            $value = ($redCards / $minutes) * 90;
            if ($value >= 5) $res = 0;
            if ($value < 5 and $value >= 4)  $res = 3;
            if ($value < 4 and $value >= 3.5)  $res = 4;
            if ($value < 3.5 and $value >= 3)  $res = 5;
            if ($value < 3 and $value >= 2.5)  $res = 6;
            if ($value < 2.5 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1)  $res = 8;
            if ($value < 1 and $value > 0)  $res = 9;
            else $res = 10;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getDribbleCompletedPer90MintuesRating(Player $player): int
    {
        if ($player) {
            $dribbles = $player->getDribbleCompleted();
            $minutes = $player->getMinutesPlayed();
            $value = ($dribbles / $minutes) * 90;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 4)  $res = 9;
            if ($value < 4 and $value >= 3)  $res = 8;
            if ($value < 3 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1.5)  $res = 6;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getDribbleCompletedPerCentRating(Player $player): float
    {
        if ($player) {
            $dribbles = $player->getDribblePercent();
            $value = $dribbles / 10;
        }
        return $value;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getOffsideRating(Player $player): int
    {
        if ($player) {
            $offsides = $player->getOffsides();
            $minutes = $player->getMinutesPlayed();
            $value = ($offsides / $minutes) * 90;
            if ($value >= 3) $res = 0;
            if ($value < 3 and $value >= 2)  $res = 3;
            if ($value < 2 and $value >= 1.5)  $res = 4;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.7)  $res = 6;
            if ($value < 0.7 and $value >= 0.4)  $res = 7;
            if ($value < 0.4 and $value >= 0.2)  $res = 8;
            if ($value < 0.2 and $value > 0)  $res = 9;
            else $res = 10;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getAssistRating(Player $player): int
    {
        if ($player) {
            $assists = $player->getAssits();
            $minutes = $player->getMinutesPlayed();
            $value = ($assists / $minutes) * 90;
            if ($value >= 1) $res = 10;
            if ($value < 1 and $value >= 0.8)  $res = 9;
            if ($value < 0.8 and $value >= 0.7)  $res = 8;
            if ($value < 0.7 and $value >= 0.5)  $res = 7;
            if ($value < 0.5 and $value >= 0.3)  $res = 6;
            if ($value < 0.3 and $value >= 0.2)  $res = 5;
            if ($value < 0.2 and $value >= 0.1)  $res = 4;
            if ($value < 0.1 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the yellow cards
     */
    public function getKeyPassRating(Player $player): int
    {
        if ($player) {
            $keyPasses = $player->getKeyPasses();
            $minutes = $player->getMinutesPlayed();
            $value = ($keyPasses / $minutes) * 90;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 4)  $res = 9;
            if ($value < 4 and $value >= 2.5)  $res = 8;
            if ($value < 2.5 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1.5)  $res = 6;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the passe completed
     */
    public function getPassCompletedPercentRating(Player $player): int
    {
        if ($player) {
            $value = $player->getPassCompPercent() / 100;
            if ($value >= 1) $res = 10;
            if ($value >= 0.8 and $value < 1)  $res = 9;
            if (0.5 <= $value and $value < 0.8)  $res = 8;
            if (0.3 <= $value and $value < 0.5)  $res = 7;
            if (0.2 <= $value and $value < 0.3) $res = 6;
            if (0.1 <= $value and $value < 0.2) $res = 5;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getPassCompletedRating(Player $player): int
    {
        if ($player) {
            $passesCompleted = $player->getPassesCompleted();
            $minutes = $player->getMinutesPlayed();
            $value = ($passesCompleted / $minutes);
            if ($value >= 1) $res = 10;
            if ($value < 1 and $value >= 0.8)  $res = 9;
            if ($value < 0.8 and $value >= 0.7)  $res = 8;
            if ($value < 0.7 and $value >= 0.5)  $res = 7;
            if ($value < 0.5 and $value >= 0.3)  $res = 6;
            if ($value < 0.3 and $value >= 0.2)  $res = 5;
            if ($value < 0.2 and $value >= 0.1)  $res = 4;
            if ($value < 0.1 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getShortPassCompletedRating(Player $player): int
    {
        if ($player) {
            $shortPassesCompleted = $player->getShortPassesCompleted();
            $minutes = $player->getMinutesPlayed();
            $value = ($shortPassesCompleted / $minutes) * 90;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 3)  $res = 9;
            if ($value < 3 and $value >= 2.5)  $res = 8;
            if ($value < 2.5 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1.5)  $res = 6;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getShortPassCompletionPerCentRating(Player $player): float
    {
        if ($player) {
            $dribbles = $player->getShortPassesCompPercent();
            $value = $dribbles / 10;
        }
        return $value;
    }
 
    /**
     * return the rate of the yellow cards
     */
    public function getLongPassCompletedRating(Player $player): int
    {
        if ($player) {
            $longPassesCompleted = $player->getLongPassesCompPercent();
            $minutes = $player->getMinutesPlayed();
            $value = ($longPassesCompleted / $minutes) *10;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 3)  $res = 9;
            if ($value < 3 and $value >= 2.5)  $res = 8;
            if ($value < 2.5 and $value >= 2)  $res = 7;
            if ($value < 2 and $value >= 1.5)  $res = 6;
            if ($value < 1.5 and $value >= 1)  $res = 5;
            if ($value < 1 and $value >= 0.5)  $res = 4;
            if ($value < 0.5 and $value > 0)  $res = 3;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the yellow cards
     */
    public function getLongPassCompletionPerCentRating(Player $player): float
    {
        if ($player) {
            $dribbles = $player->getLongPassesCompPercent();
            $value = $dribbles / 10;
        }
        return $value;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getMediumPassCompletedRating(Player $player): int
    {
        if ($player) {
            $mediumPassesCompleted = $player->getLongPassesCompPercent();
            $minutes = $player->getMinutesPlayed();
            $value = ($mediumPassesCompleted / $minutes) *10;
            if ($value >= 7) $res = 10;
            if ($value < 7 and $value >= 5)  $res = 9;
            if ($value < 5 and $value >= 4)  $res = 8;
            if ($value < 4 and $value >= 3)  $res = 7;
            if ($value < 3 and $value >= 2.5)  $res = 6;
            if ($value < 2.5 and $value >= 2)  $res = 5;
            if ($value < 2 and $value >= 1.5)  $res = 4;
            if ($value < 1.5 and $value > 0.5)  $res = 3;
            else $res = 0;
        }
        return $res;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getMediumPassCompletionPerCentRating(Player $player): float
    {
        if ($player) {
            $dribbles = $player->getLongPassesCompPercent();
            $value = $dribbles / 10;
        }
        return $value;
    }


    /**
     * return the rate of the yellow cards
     */
    public function getThroughBallRating(Player $player): int
    {
        if ($player) {
            $mediumPassesCompleted = $player->getThroughBalls();
            $minutes = $player->getMinutesPlayed();
            $value = ($mediumPassesCompleted / $minutes) *90;
            if ($value >= 10) $res = 10;
            if ($value < 1.2 and $value >= 1)  $res = 9;
            if ($value < 1 and $value >= 0.8)  $res = 8;
            if ($value < 0.8 and $value >= 0.7)  $res = 7;
            if ($value < 0.7 and $value >= 0.6)  $res = 6;
            if ($value < 0.6 and $value >= 0.5)  $res = 5;
            if ($value < 0.5 and $value >= 0.4)  $res = 4;
            if ($value < 0.4 and $value > 0.3)  $res = 3;
            if ($value < 0.3 and $value > 0.2)  $res = 2;
            if ($value < 0.2 and $value > 0)  $res = 1;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the yellow cards
     */
    public function getPassIntoFinalThirdRating(Player $player): int
    {
        if ($player) {
            $mediumPassesCompleted = $player->getPassCompletedFinalThird();
            $minutes = $player->getMinutesPlayed();
            $value = ($mediumPassesCompleted / $minutes) *90;
            if ($value >= 10) $res = 10;
            if ($value < 10 and $value >= 9)  $res = 9;
            if ($value < 9 and $value >= 8)  $res = 8;
            if ($value < 8 and $value >= 7)  $res = 7;
            if ($value < 7 and $value >= 6)  $res = 6;
            if ($value < 6 and $value >= 5)  $res = 5;
            if ($value < 5 and $value >= 4)  $res = 4;
            if ($value < 4 and $value > 3)  $res = 3;
            if ($value < 3 and $value > 2)  $res = 2;
            if ($value < 2 and $value > 0)  $res = 1;
            else $res = 0;
        }
        return $res;
    }


     /**
     * return the rate of the yellow cards
     */
    public function getPassIntoPenaltyAreaRating(Player $player): int
    {
        if ($player) {
            $mediumPassesCompleted = $player->getPassCompletedPenaltyArea();
            $minutes = $player->getMinutesPlayed();
            $value = ($mediumPassesCompleted / $minutes) *90;
            if ($value >= 5) $res = 10;
            if ($value < 5 and $value >= 4.5)  $res = 9;
            if ($value < 4.5 and $value >= 4)  $res = 8;
            if ($value < 4 and $value >= 3.5)  $res = 7;
            if ($value < 3.5 and $value >= 3)  $res = 6;
            if ($value < 3 and $value >= 2.5)  $res = 5;
            if ($value < 2.5 and $value >= 2)  $res = 4;
            if ($value < 2 and $value > 1.5)  $res = 3;
            if ($value < 1.5 and $value > 1)  $res = 2;
            if ($value < 1 and $value > 0)  $res = 1;
            else $res = 0;
        }
        return $res;
    }

    /**
     * return the rate of the yellow cards
     */
    public function getCrossIntoPenaltyAreaRating(Player $player): int
    {
        if ($player) {
            $mediumPassesCompleted = $player->getCrossIntoPenaltyArea();
            $minutes = $player->getMinutesPlayed();
            $value = ($mediumPassesCompleted / $minutes) *90;
            if ($value >= 1) $res = 10;
            if ($value < 1 and $value >= 0.9)  $res = 9;
            if ($value < 0.9 and $value >= 0.8)  $res = 8;
            if ($value < 0.8 and $value >= 0.7)  $res = 7;
            if ($value < 0.7 and $value >= 0.6)  $res = 6;
            if ($value < 0.6 and $value >= 0.5)  $res = 5;
            if ($value < 0.5 and $value >= 0.4)  $res = 4;
            if ($value < 0.4 and $value > 0.3)  $res = 3;
            if ($value < 0.3 and $value > 0.2)  $res = 2;
            if ($value < 0.2 and $value > 0)  $res = 1;
            else $res = 0;
        }
        return $res;
    }


  


    











    



    /**
     * passe quality to redo
     */
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


    /**
     * passe quality to redo
     */
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
