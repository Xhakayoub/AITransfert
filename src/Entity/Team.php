<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameTeam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $league;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchPlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $goals;

    /**
     * @ORM\Column(type="integer")
     */
    private $assists;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsAgainst;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalPerMatch;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsAgainstPerMatch;

    /**
     * @ORM\Column(type="integer")
     */
    private $saves;

    /**
     * @ORM\Column(type="integer")
     */
    private $shootOnTargetAgainst;

    /**
     * @ORM\Column(type="float")
     */
    private $savePercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $cleanSheets;

    /**
     * @ORM\Column(type="float")
     */
    private $cleanSheetPercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $penaltyKickAllowed;

    /**
     * @ORM\Column(type="integer")
     */
    private $penaltyKicksSaved;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $topTeamScoorer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $goalKeeper;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkPassLaunchedComp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkPassLaunchedAtt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gkPassLaunchedCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkPassAttempted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkPassThrows;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gkPassLaunchedPercent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $avgLengthOfPasses;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalKicksAtt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalKicksLaunchedPercent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalKicksAvgLength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkCrossesAttempted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gkCrossesStopped;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gkCrossesStpPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $opa;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $opaPerMatch;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootOnTarget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootFromFreeKick;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootOnTargetPercent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootPer90Minutes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootOnTargetPer90Minutes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalPerShoot;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalPerShootOnTarget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passesCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passesAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $passCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortPassCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortPassAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shortPassCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mediumPassCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mediumPassAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mediumPassCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longPassCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longPassAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longPassCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passAttemptedFromFK;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $throughBalls;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cornerKicks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ThrowInsTaken;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passIntoFinalThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passIntoPenaltyArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $crossIntoPenaltyArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutesPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $substitutions;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pointPerMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yellowCards;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $redCards;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $foulCommited;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $foulDrawn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $offsides;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $crosses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tacklesWon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $interceptions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penaltyKickWon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penaltyKickConceded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ownGoal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dribblesSucceded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dribblesAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dribblesCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $livePasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deadPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $switchPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $groundPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lowPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $highPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $leftFootPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rightFootPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $blockedPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $offsidesPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progressDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressures;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressureSucceded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressureCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ballBlocked;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootBlocked;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootOnTargetBlocked;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passBlocked;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $clearances;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $errors;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $arialDuelsWon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $arialDuelsLost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $arialDuelsCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ballControlls;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ballControllsMoveDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ballControllsMoveDistanceProgressive;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNameTeam(): ?string
    {
        return $this->nameTeam;
    }

    public function setNameTeam(string $nameTeam): self
    {
        $this->nameTeam = $nameTeam;

        return $this;
    }

    public function getLeague(): ?string
    {
        return $this->league;
    }

    public function setLeague(string $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getMatchPlayed(): ?int
    {
        return $this->matchPlayed;
    }

    public function setMatchPlayed(int $matchPlayed): self
    {
        $this->matchPlayed = $matchPlayed;

        return $this;
    }

    public function getGoals(): ?int
    {
        return $this->goals;
    }

    public function setGoals(int $goals): self
    {
        $this->goals = $goals;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): self
    {
        $this->assists = $assists;

        return $this;
    }

    public function getGoalsAgainst(): ?int
    {
        return $this->goalsAgainst;
    }

    public function setGoalsAgainst(int $goalsAgainst): self
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    public function getGoalPerMatch(): ?int
    {
        return $this->goalPerMatch;
    }

    public function setGoalPerMatch(int $goalPerMatch): self
    {
        $this->goalPerMatch = $goalPerMatch;

        return $this;
    }

    public function getGoalsAgainstPerMatch(): ?int
    {
        return $this->goalsAgainstPerMatch;
    }

    public function setGoalsAgainstPerMatch(int $goalsAgainstPerMatch): self
    {
        $this->goalsAgainstPerMatch = $goalsAgainstPerMatch;

        return $this;
    }

    public function getSaves(): ?int
    {
        return $this->saves;
    }

    public function setSaves(int $saves): self
    {
        $this->saves = $saves;

        return $this;
    }

    public function getShootOnTargetAgainst(): ?int
    {
        return $this->shootOnTargetAgainst;
    }

    public function setShootOnTargetAgainst(int $shootOnTargetAgainst): self
    {
        $this->shootOnTargetAgainst = $shootOnTargetAgainst;

        return $this;
    }

    public function getSavePercent(): ?float
    {
        return $this->savePercent;
    }

    public function setSavePercent(float $savePercent): self
    {
        $this->savePercent = $savePercent;

        return $this;
    }

    public function getCleanSheets(): ?int
    {
        return $this->cleanSheets;
    }

    public function setCleanSheets(int $cleanSheets): self
    {
        $this->cleanSheets = $cleanSheets;

        return $this;
    }

    public function getCleanSheetPercent(): ?float
    {
        return $this->cleanSheetPercent;
    }

    public function setCleanSheetPercent(float $cleanSheetPercent): self
    {
        $this->cleanSheetPercent = $cleanSheetPercent;

        return $this;
    }

    public function getPenaltyKickAllowed(): ?int
    {
        return $this->penaltyKickAllowed;
    }

    public function setPenaltyKickAllowed(int $penaltyKickAllowed): self
    {
        $this->penaltyKickAllowed = $penaltyKickAllowed;

        return $this;
    }

    public function getPenaltyKicksSaved(): ?int
    {
        return $this->penaltyKicksSaved;
    }

    public function setPenaltyKicksSaved(int $penaltyKicksSaved): self
    {
        $this->penaltyKicksSaved = $penaltyKicksSaved;

        return $this;
    }

    public function getTopTeamScoorer(): ?string
    {
        return $this->topTeamScoorer;
    }

    public function setTopTeamScoorer(?string $topTeamScoorer): self
    {
        $this->topTeamScoorer = $topTeamScoorer;

        return $this;
    }

    public function getGoalKeeper(): ?string
    {
        return $this->goalKeeper;
    }

    public function setGoalKeeper(string $goalKeeper): self
    {
        $this->goalKeeper = $goalKeeper;

        return $this;
    }

    public function getGkPassLaunchedComp(): ?int
    {
        return $this->gkPassLaunchedComp;
    }

    public function setGkPassLaunchedComp(?int $gkPassLaunchedComp): self
    {
        $this->gkPassLaunchedComp = $gkPassLaunchedComp;

        return $this;
    }

    public function getGkPassLaunchedAtt(): ?int
    {
        return $this->gkPassLaunchedAtt;
    }

    public function setGkPassLaunchedAtt(?int $gkPassLaunchedAtt): self
    {
        $this->gkPassLaunchedAtt = $gkPassLaunchedAtt;

        return $this;
    }

    public function getGkPassLaunchedCompletion(): ?float
    {
        return $this->gkPassLaunchedCompletion;
    }

    public function setGkPassLaunchedCompletion(?float $gkPassLaunchedCompletion): self
    {
        $this->gkPassLaunchedCompletion = $gkPassLaunchedCompletion;

        return $this;
    }

    public function getGkPassAttempted(): ?int
    {
        return $this->gkPassAttempted;
    }

    public function setGkPassAttempted(?int $gkPassAttempted): self
    {
        $this->gkPassAttempted = $gkPassAttempted;

        return $this;
    }

    public function getGkPassThrows(): ?int
    {
        return $this->gkPassThrows;
    }

    public function setGkPassThrows(?int $gkPassThrows): self
    {
        $this->gkPassThrows = $gkPassThrows;

        return $this;
    }

    public function getGkPassLaunchedPercent(): ?float
    {
        return $this->gkPassLaunchedPercent;
    }

    public function setGkPassLaunchedPercent(?float $gkPassLaunchedPercent): self
    {
        $this->gkPassLaunchedPercent = $gkPassLaunchedPercent;

        return $this;
    }

    public function getAvgLengthOfPasses(): ?float
    {
        return $this->avgLengthOfPasses;
    }

    public function setAvgLengthOfPasses(?float $avgLengthOfPasses): self
    {
        $this->avgLengthOfPasses = $avgLengthOfPasses;

        return $this;
    }

    public function getGoalKicksAtt(): ?int
    {
        return $this->goalKicksAtt;
    }

    public function setGoalKicksAtt(int $goalKicksAtt): self
    {
        $this->goalKicksAtt = $goalKicksAtt;

        return $this;
    }

    public function getGoalKicksLaunchedPercent(): ?float
    {
        return $this->goalKicksLaunchedPercent;
    }

    public function setGoalKicksLaunchedPercent(?float $goalKicksLaunchedPercent): self
    {
        $this->goalKicksLaunchedPercent = $goalKicksLaunchedPercent;

        return $this;
    }

    public function getGoalKicksAvgLength(): ?float
    {
        return $this->goalKicksAvgLength;
    }

    public function setGoalKicksAvgLength(?float $goalKicksAvgLength): self
    {
        $this->goalKicksAvgLength = $goalKicksAvgLength;

        return $this;
    }

    public function getGkCrossesAttempted(): ?int
    {
        return $this->gkCrossesAttempted;
    }

    public function setGkCrossesAttempted(?int $gkCrossesAttempted): self
    {
        $this->gkCrossesAttempted = $gkCrossesAttempted;

        return $this;
    }

    public function getGkCrossesStopped(): ?int
    {
        return $this->gkCrossesStopped;
    }

    public function setGkCrossesStopped(?int $gkCrossesStopped): self
    {
        $this->gkCrossesStopped = $gkCrossesStopped;

        return $this;
    }

    public function getGkCrossesStpPercent(): ?float
    {
        return $this->gkCrossesStpPercent;
    }

    public function setGkCrossesStpPercent(?float $gkCrossesStpPercent): self
    {
        $this->gkCrossesStpPercent = $gkCrossesStpPercent;

        return $this;
    }

    public function getOpa(): ?int
    {
        return $this->opa;
    }

    public function setOpa(?int $opa): self
    {
        $this->opa = $opa;

        return $this;
    }

    public function getOpaPerMatch(): ?float
    {
        return $this->opaPerMatch;
    }

    public function setOpaPerMatch(?float $opaPerMatch): self
    {
        $this->opaPerMatch = $opaPerMatch;

        return $this;
    }

    public function getAverageDistance(): ?float
    {
        return $this->averageDistance;
    }

    public function setAverageDistance(?float $averageDistance): self
    {
        $this->averageDistance = $averageDistance;

        return $this;
    }

    public function getShootOnTarget(): ?int
    {
        return $this->shootOnTarget;
    }

    public function setShootOnTarget(?int $shootOnTarget): self
    {
        $this->shootOnTarget = $shootOnTarget;

        return $this;
    }

    public function getShootFromFreeKick(): ?int
    {
        return $this->shootFromFreeKick;
    }

    public function setShootFromFreeKick(?int $shootFromFreeKick): self
    {
        $this->shootFromFreeKick = $shootFromFreeKick;

        return $this;
    }

    public function getShootOnTargetPercent(): ?float
    {
        return $this->shootOnTargetPercent;
    }

    public function setShootOnTargetPercent(?float $shootOnTargetPercent): self
    {
        $this->shootOnTargetPercent = $shootOnTargetPercent;

        return $this;
    }

    public function getShootPer90Minutes(): ?float
    {
        return $this->shootPer90Minutes;
    }

    public function setShootPer90Minutes(?float $shootPer90Minutes): self
    {
        $this->shootPer90Minutes = $shootPer90Minutes;

        return $this;
    }

    public function getShootOnTargetPer90Minutes(): ?float
    {
        return $this->shootOnTargetPer90Minutes;
    }

    public function setShootOnTargetPer90Minutes(?float $shootOnTargetPer90Minutes): self
    {
        $this->shootOnTargetPer90Minutes = $shootOnTargetPer90Minutes;

        return $this;
    }

    public function getGoalPerShoot(): ?float
    {
        return $this->goalPerShoot;
    }

    public function setGoalPerShoot(?float $goalPerShoot): self
    {
        $this->goalPerShoot = $goalPerShoot;

        return $this;
    }

    public function getGoalPerShootOnTarget(): ?float
    {
        return $this->goalPerShootOnTarget;
    }

    public function setGoalPerShootOnTarget(?float $goalPerShootOnTarget): self
    {
        $this->goalPerShootOnTarget = $goalPerShootOnTarget;

        return $this;
    }

    public function getPassesCompleted(): ?int
    {
        return $this->passesCompleted;
    }

    public function setPassesCompleted(?int $passesCompleted): self
    {
        $this->passesCompleted = $passesCompleted;

        return $this;
    }

    public function getPassesAttempted(): ?int
    {
        return $this->passesAttempted;
    }

    public function setPassesAttempted(?int $passesAttempted): self
    {
        $this->passesAttempted = $passesAttempted;

        return $this;
    }

    public function getPassCompletion(): ?float
    {
        return $this->passCompletion;
    }

    public function setPassCompletion(?float $passCompletion): self
    {
        $this->passCompletion = $passCompletion;

        return $this;
    }

    public function getShortPassCompleted(): ?int
    {
        return $this->shortPassCompleted;
    }

    public function setShortPassCompleted(?int $shortPassCompleted): self
    {
        $this->shortPassCompleted = $shortPassCompleted;

        return $this;
    }

    public function getShortPassAttempted(): ?int
    {
        return $this->shortPassAttempted;
    }

    public function setShortPassAttempted(?int $shortPassAttempted): self
    {
        $this->shortPassAttempted = $shortPassAttempted;

        return $this;
    }

    public function getShortPassCompletion(): ?float
    {
        return $this->shortPassCompletion;
    }

    public function setShortPassCompletion(?float $shortPassCompletion): self
    {
        $this->shortPassCompletion = $shortPassCompletion;

        return $this;
    }

    public function getMediumPassCompleted(): ?int
    {
        return $this->mediumPassCompleted;
    }

    public function setMediumPassCompleted(?int $mediumPassCompleted): self
    {
        $this->mediumPassCompleted = $mediumPassCompleted;

        return $this;
    }

    public function getMediumPassAttempted(): ?int
    {
        return $this->mediumPassAttempted;
    }

    public function setMediumPassAttempted(?int $mediumPassAttempted): self
    {
        $this->mediumPassAttempted = $mediumPassAttempted;

        return $this;
    }

    public function getMediumPassCompletion(): ?float
    {
        return $this->mediumPassCompletion;
    }

    public function setMediumPassCompletion(?float $mediumPassCompletion): self
    {
        $this->mediumPassCompletion = $mediumPassCompletion;

        return $this;
    }

    public function getLongPassCompleted(): ?int
    {
        return $this->longPassCompleted;
    }

    public function setLongPassCompleted(?int $longPassCompleted): self
    {
        $this->longPassCompleted = $longPassCompleted;

        return $this;
    }

    public function getLongPassAttempted(): ?int
    {
        return $this->longPassAttempted;
    }

    public function setLongPassAttempted(?int $longPassAttempted): self
    {
        $this->longPassAttempted = $longPassAttempted;

        return $this;
    }

    public function getLongPassCompletion(): ?float
    {
        return $this->longPassCompletion;
    }

    public function setLongPassCompletion(?float $longPassCompletion): self
    {
        $this->longPassCompletion = $longPassCompletion;

        return $this;
    }

    public function getPassAttemptedFromFK(): ?int
    {
        return $this->passAttemptedFromFK;
    }

    public function setPassAttemptedFromFK(?int $passAttemptedFromFK): self
    {
        $this->passAttemptedFromFK = $passAttemptedFromFK;

        return $this;
    }

    public function getThroughBalls(): ?int
    {
        return $this->throughBalls;
    }

    public function setThroughBalls(?int $throughBalls): self
    {
        $this->throughBalls = $throughBalls;

        return $this;
    }

    public function getCornerKicks(): ?int
    {
        return $this->cornerKicks;
    }

    public function setCornerKicks(?int $cornerKicks): self
    {
        $this->cornerKicks = $cornerKicks;

        return $this;
    }

    public function getThrowInsTaken(): ?int
    {
        return $this->ThrowInsTaken;
    }

    public function setThrowInsTaken(?int $ThrowInsTaken): self
    {
        $this->ThrowInsTaken = $ThrowInsTaken;

        return $this;
    }

    public function getPassIntoFinalThird(): ?int
    {
        return $this->passIntoFinalThird;
    }

    public function setPassIntoFinalThird(?int $passIntoFinalThird): self
    {
        $this->passIntoFinalThird = $passIntoFinalThird;

        return $this;
    }

    public function getPassIntoPenaltyArea(): ?int
    {
        return $this->passIntoPenaltyArea;
    }

    public function setPassIntoPenaltyArea(?int $passIntoPenaltyArea): self
    {
        $this->passIntoPenaltyArea = $passIntoPenaltyArea;

        return $this;
    }

    public function getCrossIntoPenaltyArea(): ?int
    {
        return $this->crossIntoPenaltyArea;
    }

    public function setCrossIntoPenaltyArea(?int $crossIntoPenaltyArea): self
    {
        $this->crossIntoPenaltyArea = $crossIntoPenaltyArea;

        return $this;
    }

    public function getMinutesPlayed(): ?int
    {
        return $this->minutesPlayed;
    }

    public function setMinutesPlayed(?int $minutesPlayed): self
    {
        $this->minutesPlayed = $minutesPlayed;

        return $this;
    }

    public function getSubstitutions(): ?int
    {
        return $this->substitutions;
    }

    public function setSubstitutions(?int $substitutions): self
    {
        $this->substitutions = $substitutions;

        return $this;
    }

    public function getPointPerMatch(): ?float
    {
        return $this->pointPerMatch;
    }

    public function setPointPerMatch(?float $pointPerMatch): self
    {
        $this->pointPerMatch = $pointPerMatch;

        return $this;
    }

    public function getYellowCards(): ?int
    {
        return $this->yellowCards;
    }

    public function setYellowCards(?int $yellowCards): self
    {
        $this->yellowCards = $yellowCards;

        return $this;
    }

    public function getRedCards(): ?int
    {
        return $this->redCards;
    }

    public function setRedCards(?int $redCards): self
    {
        $this->redCards = $redCards;

        return $this;
    }

    public function getFoulCommited(): ?int
    {
        return $this->foulCommited;
    }

    public function setFoulCommited(?int $foulCommited): self
    {
        $this->foulCommited = $foulCommited;

        return $this;
    }

    public function getFoulDrawn(): ?int
    {
        return $this->foulDrawn;
    }

    public function setFoulDrawn(?int $foulDrawn): self
    {
        $this->foulDrawn = $foulDrawn;

        return $this;
    }

    public function getOffsides(): ?int
    {
        return $this->offsides;
    }

    public function setOffsides(?int $offsides): self
    {
        $this->offsides = $offsides;

        return $this;
    }

    public function getCrosses(): ?int
    {
        return $this->crosses;
    }

    public function setCrosses(?int $crosses): self
    {
        $this->crosses = $crosses;

        return $this;
    }

    public function getTacklesWon(): ?int
    {
        return $this->tacklesWon;
    }

    public function setTacklesWon(?int $tacklesWon): self
    {
        $this->tacklesWon = $tacklesWon;

        return $this;
    }

    public function getInterceptions(): ?int
    {
        return $this->interceptions;
    }

    public function setInterceptions(?int $interceptions): self
    {
        $this->interceptions = $interceptions;

        return $this;
    }

    public function getPenaltyKickWon(): ?int
    {
        return $this->penaltyKickWon;
    }

    public function setPenaltyKickWon(?int $penaltyKickWon): self
    {
        $this->penaltyKickWon = $penaltyKickWon;

        return $this;
    }

    public function getPenaltyKickConceded(): ?int
    {
        return $this->penaltyKickConceded;
    }

    public function setPenaltyKickConceded(?int $penaltyKickConceded): self
    {
        $this->penaltyKickConceded = $penaltyKickConceded;

        return $this;
    }

    public function getOwnGoal(): ?int
    {
        return $this->ownGoal;
    }

    public function setOwnGoal(?int $ownGoal): self
    {
        $this->ownGoal = $ownGoal;

        return $this;
    }

    public function getDribblesSucceded(): ?int
    {
        return $this->dribblesSucceded;
    }

    public function setDribblesSucceded(?int $dribblesSucceded): self
    {
        $this->dribblesSucceded = $dribblesSucceded;

        return $this;
    }

    public function getDribblesAttempted(): ?int
    {
        return $this->dribblesAttempted;
    }

    public function setDribblesAttempted(?int $dribblesAttempted): self
    {
        $this->dribblesAttempted = $dribblesAttempted;

        return $this;
    }

    public function getDribblesCompletion(): ?float
    {
        return $this->dribblesCompletion;
    }

    public function setDribblesCompletion(?float $dribblesCompletion): self
    {
        $this->dribblesCompletion = $dribblesCompletion;

        return $this;
    }

    public function getLivePasses(): ?int
    {
        return $this->livePasses;
    }

    public function setLivePasses(?int $livePasses): self
    {
        $this->livePasses = $livePasses;

        return $this;
    }

    public function getDeadPasses(): ?int
    {
        return $this->deadPasses;
    }

    public function setDeadPasses(?int $deadPasses): self
    {
        $this->deadPasses = $deadPasses;

        return $this;
    }

    public function getPressPasses(): ?int
    {
        return $this->pressPasses;
    }

    public function setPressPasses(?int $pressPasses): self
    {
        $this->pressPasses = $pressPasses;

        return $this;
    }

    public function getSwitchPasses(): ?int
    {
        return $this->switchPasses;
    }

    public function setSwitchPasses(?int $switchPasses): self
    {
        $this->switchPasses = $switchPasses;

        return $this;
    }

    public function getGroundPasses(): ?int
    {
        return $this->groundPasses;
    }

    public function setGroundPasses(?int $groundPasses): self
    {
        $this->groundPasses = $groundPasses;

        return $this;
    }

    public function getLowPasses(): ?int
    {
        return $this->lowPasses;
    }

    public function setLowPasses(?int $lowPasses): self
    {
        $this->lowPasses = $lowPasses;

        return $this;
    }

    public function getHighPasses(): ?int
    {
        return $this->highPasses;
    }

    public function setHighPasses(?int $highPasses): self
    {
        $this->highPasses = $highPasses;

        return $this;
    }

    public function getLeftFootPasses(): ?int
    {
        return $this->leftFootPasses;
    }

    public function setLeftFootPasses(?int $leftFootPasses): self
    {
        $this->leftFootPasses = $leftFootPasses;

        return $this;
    }

    public function getRightFootPasses(): ?int
    {
        return $this->rightFootPasses;
    }

    public function setRightFootPasses(?int $rightFootPasses): self
    {
        $this->rightFootPasses = $rightFootPasses;

        return $this;
    }

    public function getBlockedPasses(): ?int
    {
        return $this->blockedPasses;
    }

    public function setBlockedPasses(?int $blockedPasses): self
    {
        $this->blockedPasses = $blockedPasses;

        return $this;
    }

    public function getOffsidesPasses(): ?int
    {
        return $this->offsidesPasses;
    }

    public function setOffsidesPasses(?int $offsidesPasses): self
    {
        $this->offsidesPasses = $offsidesPasses;

        return $this;
    }

    public function getTotalDistance(): ?int
    {
        return $this->totalDistance;
    }

    public function setTotalDistance(?int $totalDistance): self
    {
        $this->totalDistance = $totalDistance;

        return $this;
    }

    public function getProgressDistance(): ?int
    {
        return $this->progressDistance;
    }

    public function setProgressDistance(?int $progressDistance): self
    {
        $this->progressDistance = $progressDistance;

        return $this;
    }

    public function getPressures(): ?int
    {
        return $this->pressures;
    }

    public function setPressures(?int $pressures): self
    {
        $this->pressures = $pressures;

        return $this;
    }

    public function getPressureSucceded(): ?int
    {
        return $this->pressureSucceded;
    }

    public function setPressureSucceded(?int $pressureSucceded): self
    {
        $this->pressureSucceded = $pressureSucceded;

        return $this;
    }

    public function getPressureCompletion(): ?int
    {
        return $this->pressureCompletion;
    }

    public function setPressureCompletion(?int $pressureCompletion): self
    {
        $this->pressureCompletion = $pressureCompletion;

        return $this;
    }

    public function getBallBlocked(): ?int
    {
        return $this->ballBlocked;
    }

    public function setBallBlocked(?int $ballBlocked): self
    {
        $this->ballBlocked = $ballBlocked;

        return $this;
    }

    public function getShootBlocked(): ?int
    {
        return $this->shootBlocked;
    }

    public function setShootBlocked(?int $shootBlocked): self
    {
        $this->shootBlocked = $shootBlocked;

        return $this;
    }

    public function getShootOnTargetBlocked(): ?int
    {
        return $this->shootOnTargetBlocked;
    }

    public function setShootOnTargetBlocked(?int $shootOnTargetBlocked): self
    {
        $this->shootOnTargetBlocked = $shootOnTargetBlocked;

        return $this;
    }

    public function getPassBlocked(): ?int
    {
        return $this->passBlocked;
    }

    public function setPassBlocked(?int $passBlocked): self
    {
        $this->passBlocked = $passBlocked;

        return $this;
    }

    public function getClearances(): ?int
    {
        return $this->clearances;
    }

    public function setClearances(?int $clearances): self
    {
        $this->clearances = $clearances;

        return $this;
    }

    public function getErrors(): ?int
    {
        return $this->errors;
    }

    public function setErrors(?int $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function getArialDuelsWon(): ?int
    {
        return $this->arialDuelsWon;
    }

    public function setArialDuelsWon(?int $arialDuelsWon): self
    {
        $this->arialDuelsWon = $arialDuelsWon;

        return $this;
    }

    public function getArialDuelsLost(): ?int
    {
        return $this->arialDuelsLost;
    }

    public function setArialDuelsLost(?int $arialDuelsLost): self
    {
        $this->arialDuelsLost = $arialDuelsLost;

        return $this;
    }

    public function getArialDuelsCompletion(): ?int
    {
        return $this->arialDuelsCompletion;
    }

    public function setArialDuelsCompletion(?int $arialDuelsCompletion): self
    {
        $this->arialDuelsCompletion = $arialDuelsCompletion;

        return $this;
    }

    public function getBallControlls(): ?int
    {
        return $this->ballControlls;
    }

    public function setBallControlls(?int $ballControlls): self
    {
        $this->ballControlls = $ballControlls;

        return $this;
    }

    public function getBallControllsMoveDistance(): ?int
    {
        return $this->ballControllsMoveDistance;
    }

    public function setBallControllsMoveDistance(?int $ballControllsMoveDistance): self
    {
        $this->ballControllsMoveDistance = $ballControllsMoveDistance;

        return $this;
    }

    public function getBallControllsMoveDistanceProgressive(): ?int
    {
        return $this->ballControllsMoveDistanceProgressive;
    }

    public function setBallControllsMoveDistanceProgressive(?int $ballControllsMoveDistanceProgressive): self
    {
        $this->ballControllsMoveDistanceProgressive = $ballControllsMoveDistanceProgressive;

        return $this;
    }
}