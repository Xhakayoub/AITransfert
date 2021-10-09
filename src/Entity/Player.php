<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idPlayer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $squad;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $born;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchsPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchStarts;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minsPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goals;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assists;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pkMade;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pkAttempted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yellowCard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $redCard;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalsPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assistsPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $glsAssPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalsWithoutPkPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $glsAssWithoutPkPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalsExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nonPenGoalsExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assistsExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalsPerMinExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $assistsPerMinExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $glsAssistsPerMinExp;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nonPenGoalsExpPerMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nonPenGoalsAssistsExpPerMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shoots;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootsOnTarget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shootsFromFrKc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootsOnTargetPc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootsPerMatch;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shootsOnTargetPerMatch;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalsPerShoot;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $goalPerShootOnTarget;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $keyPasses;

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
    private $passCompPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortPassesCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortpassesAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $shortPassesCompPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mediumPassesCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mediumPassesAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mediumPassesCompPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longPassCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longPassesAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longPassesCompPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passCompletedFinalThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passCompletedPenaltyArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $crossIntoPenaltyArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutesPlayed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $minutesPercentPlayed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nintyMinPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPerMatchStarted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pointsPerMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $foulsCommited;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $foulsDrawn;

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
    private $penaltyKicksWon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penaltyKicksConceded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ownGoal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dribbleCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dribbleAttempted;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dribblePercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPlayerDriblled;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nutmegs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dribbleTackled;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dribbleTackledPercent;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timesDribbledPast;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $throughBalls;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $secondYellowCard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalsScoredWhileOnPitch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalsAllowedWhileOnPitch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $livePass;

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
    private $passAttemptedFromFK;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressures;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressureSucceded;

    /**
     * @ORM\Column(type="float", nullable=true)
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
    private $shootOntTargetBlocked;

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

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $receivingBallAttempted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $receivingBallCompleted;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $receivingBallCompletion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $misControlls;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dispossessed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalsWithoutPK;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penaltyKicksMissed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cornerKicksGlsAgainst;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $averageDistShootFromGoal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passTotalDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passTotalPrgDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progressivePasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $inswingingCKs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $outswingingCKs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $straightCKs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $headPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partsOtherPasses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tacklesInDefThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tacklesInMidThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tacklesInAttThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressInDefThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressInMidThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pressInAttThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $carriesCloseToGoal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $carriesInto18YardBox;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $progressivePassRecieved;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $liveBallTouched;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $touchesInDefThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $touchesInMidThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $touchesInAttThird;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minutesPerMatchPlayed;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PercentageOfMinutesPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $completeMatchsPlayed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchsAsSubstitute;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mintuesPerSubstitute;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchsAsUnusedSubstitute;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalScoredByTeamWhileOnPitch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalAllowedByTeamWhileOnPitch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goalScoredMinusAllowedWhileOnPitchPer90;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPlayer(): ?int
    {
        return $this->idPlayer;
    }

    public function setIdPlayer(?int $idPlayer): self
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getNation(): ?string
    {
        return $this->nation;
    }

    public function setNation(?string $nation): self
    {
        $this->nation = $nation;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getSquad(): ?string
    {
        return $this->squad;
    }

    public function setSquad(string $squad): self
    {
        $this->squad = $squad;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBorn(): ?int
    {
        return $this->born;
    }

    public function setBorn(?int $born): self
    {
        $this->born = $born;

        return $this;
    }

    public function getMatchsPlayed(): ?int
    {
        return $this->matchsPlayed;
    }

    public function setMatchsPlayed(int $matchsPlayed): self
    {
        $this->matchsPlayed = $matchsPlayed;

        return $this;
    }

    public function getMatchStarts(): ?int
    {
        return $this->matchStarts;
    }

    public function setMatchStarts(int $matchStarts): self
    {
        $this->matchStarts = $matchStarts;

        return $this;
    }

    public function getMinsPlayed(): ?int
    {
        return $this->minsPlayed;
    }

    public function setMinsPlayed(int $minsPlayed): self
    {
        $this->minsPlayed = $minsPlayed;

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

    public function getPkMade(): ?int
    {
        return $this->pkMade;
    }

    public function setPkMade(?int $pkMade): self
    {
        $this->pkMade = $pkMade;

        return $this;
    }

    public function getPkAttempted(): ?int
    {
        return $this->pkAttempted;
    }

    public function setPkAttempted(?int $pkAttempted): self
    {
        $this->pkAttempted = $pkAttempted;

        return $this;
    }

    public function getYellowCard(): ?int
    {
        return $this->yellowCard;
    }

    public function setYellowCard(int $yellowCard): self
    {
        $this->yellowCard = $yellowCard;

        return $this;
    }

    public function getRedCard(): ?int
    {
        return $this->redCard;
    }

    public function setRedCard(int $redCard): self
    {
        $this->redCard = $redCard;

        return $this;
    }

    public function getGoalsPerMin(): ?float
    {
        return $this->goalsPerMin;
    }

    public function setGoalsPerMin(float $goalsPerMin): self
    {
        $this->goalsPerMin = $goalsPerMin;

        return $this;
    }

    public function getAssistsPerMin(): ?float
    {
        return $this->assistsPerMin;
    }

    public function setAssistsPerMin(float $assistsPerMin): self
    {
        $this->assistsPerMin = $assistsPerMin;

        return $this;
    }

    public function getGlsAssPerMin(): ?float
    {
        return $this->glsAssPerMin;
    }

    public function setGlsAssPerMin(float $glsAssPerMin): self
    {
        $this->glsAssPerMin = $glsAssPerMin;

        return $this;
    }

    public function getGoalsWithoutPkPerMin(): ?float
    {
        return $this->goalsWithoutPkPerMin;
    }

    public function setGoalsWithoutPkPerMin(float $goalsWithoutPkPerMin): self
    {
        $this->goalsWithoutPkPerMin = $goalsWithoutPkPerMin;

        return $this;
    }

    public function getGlsAssWithoutPkPerMin(): ?float
    {
        return $this->glsAssWithoutPkPerMin;
    }

    public function setGlsAssWithoutPkPerMin(float $glsAssWithoutPkPerMin): self
    {
        $this->glsAssWithoutPkPerMin = $glsAssWithoutPkPerMin;

        return $this;
    }

    public function getGoalsExp(): ?float
    {
        return $this->goalsExp;
    }

    public function setGoalsExp(float $goalsExp): self
    {
        $this->goalsExp = $goalsExp;

        return $this;
    }

    public function getNonPenGoalsExp(): ?float
    {
        return $this->nonPenGoalsExp;
    }

    public function setNonPenGoalsExp(float $nonPenGoalsExp): self
    {
        $this->nonPenGoalsExp = $nonPenGoalsExp;

        return $this;
    }

    public function getAssistsExp(): ?float
    {
        return $this->assistsExp;
    }

    public function setAssistsExp(float $assistsExp): self
    {
        $this->assistsExp = $assistsExp;

        return $this;
    }

    public function getGoalsPerMinExp(): ?float
    {
        return $this->goalsPerMinExp;
    }

    public function setGoalsPerMinExp(float $goalsPerMinExp): self
    {
        $this->goalsPerMinExp = $goalsPerMinExp;

        return $this;
    }

    public function getAssistsPerMinExp(): ?float
    {
        return $this->assistsPerMinExp;
    }

    public function setAssistsPerMinExp(float $assistsPerMinExp): self
    {
        $this->assistsPerMinExp = $assistsPerMinExp;

        return $this;
    }

    public function getGlsAssistsPerMinExp(): ?float
    {
        return $this->glsAssistsPerMinExp;
    }

    public function setGlsAssistsPerMinExp(float $glsAssistsPerMinExp): self
    {
        $this->glsAssistsPerMinExp = $glsAssistsPerMinExp;

        return $this;
    }

    public function getNonPenGoalsExpPerMin(): ?float
    {
        return $this->nonPenGoalsExpPerMin;
    }

    public function setNonPenGoalsExpPerMin(float $nonPenGoalsExpPerMin): self
    {
        $this->nonPenGoalsExpPerMin = $nonPenGoalsExpPerMin;

        return $this;
    }

    public function getNonPenGoalsAssistsExpPerMin(): ?float
    {
        return $this->nonPenGoalsAssistsExpPerMin;
    }

    public function setNonPenGoalsAssistsExpPerMin(float $nonPenGoalsAssistsExpPerMin): self
    {
        $this->nonPenGoalsAssistsExpPerMin = $nonPenGoalsAssistsExpPerMin;

        return $this;
    }

    public function getShoots(): ?int
    {
        return $this->shoots;
    }

    public function setShoots(int $shoots): self
    {
        $this->shoots = $shoots;

        return $this;
    }

    public function getShootsOnTarget(): ?int
    {
        return $this->shootsOnTarget;
    }

    public function setShootsOnTarget(int $shootsOnTarget): self
    {
        $this->shootsOnTarget = $shootsOnTarget;

        return $this;
    }

    public function getShootsFromFrKc(): ?int
    {
        return $this->shootsFromFrKc;
    }

    public function setShootsFromFrKc(int $shootsFromFrKc): self
    {
        $this->shootsFromFrKc = $shootsFromFrKc;

        return $this;
    }

    public function getShootsOnTargetPc(): ?float
    {
        return $this->shootsOnTargetPc;
    }

    public function setShootsOnTargetPc(float $shootsOnTargetPc): self
    {
        $this->shootsOnTargetPc = $shootsOnTargetPc;

        return $this;
    }

    public function getShootsPerMatch(): ?float
    {
        return $this->shootsPerMatch;
    }

    public function setShootsPerMatch(float $shootsPerMatch): self
    {
        $this->shootsPerMatch = $shootsPerMatch;

        return $this;
    }

    public function getShootsOnTargetPerMatch(): ?float
    {
        return $this->shootsOnTargetPerMatch;
    }

    public function setShootsOnTargetPerMatch(float $shootsOnTargetPerMatch): self
    {
        $this->shootsOnTargetPerMatch = $shootsOnTargetPerMatch;

        return $this;
    }

    public function getGoalsPerShoot(): ?float
    {
        return $this->goalsPerShoot;
    }

    public function setGoalsPerShoot(float $goalsPerShoot): self
    {
        $this->goalsPerShoot = $goalsPerShoot;

        return $this;
    }

    public function getGoalPerShootOnTarget(): ?float
    {
        return $this->goalPerShootOnTarget;
    }

    public function setGoalPerShootOnTarget(float $goalPerShootOnTarget): self
    {
        $this->goalPerShootOnTarget = $goalPerShootOnTarget;

        return $this;
    }

    public function getKeyPasses(): ?int
    {
        return $this->keyPasses;
    }

    public function setKeyPasses(int $keyPasses): self
    {
        $this->keyPasses = $keyPasses;

        return $this;
    }

    public function getPassesCompleted(): ?int
    {
        return $this->passesCompleted;
    }

    public function setPassesCompleted(int $passesCompleted): self
    {
        $this->passesCompleted = $passesCompleted;

        return $this;
    }

    public function getPassesAttempted(): ?int
    {
        return $this->passesAttempted;
    }

    public function setPassesAttempted(int $passesAttempted): self
    {
        $this->passesAttempted = $passesAttempted;

        return $this;
    }

    public function getPassCompPercent(): ?float
    {
        return $this->passCompPercent;
    }

    public function setPassCompPercent(float $passCompPercent): self
    {
        $this->passCompPercent = $passCompPercent;

        return $this;
    }

    public function getShortPassesCompleted(): ?int
    {
        return $this->shortPassesCompleted;
    }

    public function setShortPassesCompleted(int $shortPassesCompleted): self
    {
        $this->shortPassesCompleted = $shortPassesCompleted;

        return $this;
    }

    public function getShortpassesAttempted(): ?int
    {
        return $this->shortpassesAttempted;
    }

    public function setShortpassesAttempted(int $shortpassesAttempted): self
    {
        $this->shortpassesAttempted = $shortpassesAttempted;

        return $this;
    }

    public function getShortPassesCompPercent(): ?float
    {
        return $this->shortPassesCompPercent;
    }

    public function setShortPassesCompPercent(float $shortPassesCompPercent): self
    {
        $this->shortPassesCompPercent = $shortPassesCompPercent;

        return $this;
    }

    public function getMediumPassesCompleted(): ?int
    {
        return $this->mediumPassesCompleted;
    }

    public function setMediumPassesCompleted(int $mediumPassesCompleted): self
    {
        $this->mediumPassesCompleted = $mediumPassesCompleted;

        return $this;
    }

    public function getMediumPassesAttempted(): ?int
    {
        return $this->mediumPassesAttempted;
    }

    public function setMediumPassesAttempted(int $mediumPassesAttempted): self
    {
        $this->mediumPassesAttempted = $mediumPassesAttempted;

        return $this;
    }

    public function getMediumPassesCompPercent(): ?float
    {
        return $this->mediumPassesCompPercent;
    }

    public function setMediumPassesCompPercent(float $mediumPassesCompPercent): self
    {
        $this->mediumPassesCompPercent = $mediumPassesCompPercent;

        return $this;
    }

    public function getLongPassCompleted(): ?int
    {
        return $this->longPassCompleted;
    }

    public function setLongPassCompleted(int $longPassCompleted): self
    {
        $this->longPassCompleted = $longPassCompleted;

        return $this;
    }

    public function getLongPassesAttempted(): ?int
    {
        return $this->longPassesAttempted;
    }

    public function setLongPassesAttempted(int $longPassesAttempted): self
    {
        $this->longPassesAttempted = $longPassesAttempted;

        return $this;
    }

    public function getLongPassesCompPercent(): ?float
    {
        return $this->longPassesCompPercent;
    }

    public function setLongPassesCompPercent(float $longPassesCompPercent): self
    {
        $this->longPassesCompPercent = $longPassesCompPercent;

        return $this;
    }

    public function getPassCompletedFinalThird(): ?int
    {
        return $this->passCompletedFinalThird;
    }

    public function setPassCompletedFinalThird(int $passCompletedFinalThird): self
    {
        $this->passCompletedFinalThird = $passCompletedFinalThird;

        return $this;
    }

    public function getPassCompletedPenaltyArea(): ?int
    {
        return $this->passCompletedPenaltyArea;
    }

    public function setPassCompletedPenaltyArea(int $passCompletedPenaltyArea): self
    {
        $this->passCompletedPenaltyArea = $passCompletedPenaltyArea;

        return $this;
    }

    public function getCrossIntoPenaltyArea(): ?int
    {
        return $this->crossIntoPenaltyArea;
    }

    public function setCrossIntoPenaltyArea(int $crossIntoPenaltyArea): self
    {
        $this->crossIntoPenaltyArea = $crossIntoPenaltyArea;

        return $this;
    }

    public function getMinutesPlayed(): ?int
    {
        return $this->minutesPlayed;
    }

    public function setMinutesPlayed(int $minutesPlayed): self
    {
        $this->minutesPlayed = $minutesPlayed;

        return $this;
    }

    public function getMinutesPercentPlayed(): ?float
    {
        return $this->minutesPercentPlayed;
    }

    public function setMinutesPercentPlayed(float $minutesPercentPlayed): self
    {
        $this->minutesPercentPlayed = $minutesPercentPlayed;

        return $this;
    }

    public function getNintyMinPlayed(): ?float
    {
        return $this->nintyMinPlayed;
    }

    public function setNintyMinPlayed(float $nintyMinPlayed): self
    {
        $this->nintyMinPlayed = $nintyMinPlayed;

        return $this;
    }

    public function getMinPerMatchStarted(): ?int
    {
        return $this->minPerMatchStarted;
    }

    public function setMinPerMatchStarted(int $minPerMatchStarted): self
    {
        $this->minPerMatchStarted = $minPerMatchStarted;

        return $this;
    }

    public function getPointsPerMatch(): ?float
    {
        return $this->pointsPerMatch;
    }

    public function setPointsPerMatch(float $pointsPerMatch): self
    {
        $this->pointsPerMatch = $pointsPerMatch;

        return $this;
    }

    public function getFoulsCommited(): ?int
    {
        return $this->foulsCommited;
    }

    public function setFoulsCommited(?int $foulsCommited): self
    {
        $this->foulsCommited = $foulsCommited;

        return $this;
    }

    public function getFoulsDrawn(): ?int
    {
        return $this->foulsDrawn;
    }

    public function setFoulsDrawn(?int $foulsDrawn): self
    {
        $this->foulsDrawn = $foulsDrawn;

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

    public function getPenaltyKicksWon(): ?int
    {
        return $this->penaltyKicksWon;
    }

    public function setPenaltyKicksWon(?int $penaltyKicksWon): self
    {
        $this->penaltyKicksWon = $penaltyKicksWon;

        return $this;
    }

    public function getPenaltyKicksConceded(): ?int
    {
        return $this->penaltyKicksConceded;
    }

    public function setPenaltyKicksConceded(?int $penaltyKicksConceded): self
    {
        $this->penaltyKicksConceded = $penaltyKicksConceded;

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

    public function getDribbleCompleted(): ?int
    {
        return $this->dribbleCompleted;
    }

    public function setDribbleCompleted(?int $dribbleCompleted): self
    {
        $this->dribbleCompleted = $dribbleCompleted;

        return $this;
    }

    public function getDribbleAttempted(): ?int
    {
        return $this->dribbleAttempted;
    }

    public function setDribbleAttempted(?int $dribbleAttempted): self
    {
        $this->dribbleAttempted = $dribbleAttempted;

        return $this;
    }

    public function getDribblePercent(): ?float
    {
        return $this->dribblePercent;
    }

    public function setDribblePercent(?float $dribblePercent): self
    {
        $this->dribblePercent = $dribblePercent;

        return $this;
    }

    public function getNumberOfPlayerDriblled(): ?int
    {
        return $this->numberOfPlayerDriblled;
    }

    public function setNumberOfPlayerDriblled(?int $numberOfPlayerDriblled): self
    {
        $this->numberOfPlayerDriblled = $numberOfPlayerDriblled;

        return $this;
    }

    public function getNutmegs(): ?int
    {
        return $this->nutmegs;
    }

    public function setNutmegs(?int $nutmegs): self
    {
        $this->nutmegs = $nutmegs;

        return $this;
    }

    public function getDribbleTackled(): ?int
    {
        return $this->dribbleTackled;
    }

    public function setDribbleTackled(?int $dribbleTackled): self
    {
        $this->dribbleTackled = $dribbleTackled;

        return $this;
    }

    public function getDribbleTackledPercent(): ?float
    {
        return $this->dribbleTackledPercent;
    }

    public function setDribbleTackledPercent(?float $dribbleTackledPercent): self
    {
        $this->dribbleTackledPercent = $dribbleTackledPercent;

        return $this;
    }

    public function getTimesDribbledPast(): ?int
    {
        return $this->timesDribbledPast;
    }

    public function setTimesDribbledPast(?int $timesDribbledPast): self
    {
        $this->timesDribbledPast = $timesDribbledPast;

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

    public function getSecondYellowCard(): ?int
    {
        return $this->secondYellowCard;
    }

    public function setSecondYellowCard(?int $secondYellowCard): self
    {
        $this->secondYellowCard = $secondYellowCard;

        return $this;
    }

    public function getGoalsScoredWhileOnPitch(): ?int
    {
        return $this->goalsScoredWhileOnPitch;
    }

    public function setGoalsScoredWhileOnPitch(?int $goalsScoredWhileOnPitch): self
    {
        $this->goalsScoredWhileOnPitch = $goalsScoredWhileOnPitch;

        return $this;
    }

    public function getGoalsAllowedWhileOnPitch(): ?int
    {
        return $this->goalsAllowedWhileOnPitch;
    }

    public function setGoalsAllowedWhileOnPitch(?int $goalsAllowedWhileOnPitch): self
    {
        $this->goalsAllowedWhileOnPitch = $goalsAllowedWhileOnPitch;

        return $this;
    }

    public function getLivePass(): ?int
    {
        return $this->livePass;
    }

    public function setLivePass(?int $livePass): self
    {
        $this->livePass = $livePass;

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

    public function getPassAttemptedFromFK(): ?int
    {
        return $this->passAttemptedFromFK;
    }

    public function setPassAttemptedFromFK(?int $passAttemptedFromFK): self
    {
        $this->passAttemptedFromFK = $passAttemptedFromFK;

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

    public function getPressureCompletion(): ?float
    {
        return $this->pressureCompletion;
    }

    public function setPressureCompletion(?float $pressureCompletion): self
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

    public function getShootOntTargetBlocked(): ?int
    {
        return $this->shootOntTargetBlocked;
    }

    public function setShootOntTargetBlocked(?int $shootOntTargetBlocked): self
    {
        $this->shootOntTargetBlocked = $shootOntTargetBlocked;

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

    public function getReceivingBallAttempted(): ?int
    {
        return $this->receivingBallAttempted;
    }

    public function setReceivingBallAttempted(?int $receivingBallAttempted): self
    {
        $this->receivingBallAttempted = $receivingBallAttempted;

        return $this;
    }

    public function getReceivingBallCompleted(): ?int
    {
        return $this->receivingBallCompleted;
    }

    public function setReceivingBallCompleted(?int $receivingBallCompleted): self
    {
        $this->receivingBallCompleted = $receivingBallCompleted;

        return $this;
    }

    public function getReceivingBallCompletion(): ?int
    {
        return $this->receivingBallCompletion;
    }

    public function setReceivingBallCompletion(?int $receivingBallCompletion): self
    {
        $this->receivingBallCompletion = $receivingBallCompletion;

        return $this;
    }

    public function getMisControlls(): ?int
    {
        return $this->misControlls;
    }

    public function setMisControlls(?int $misControlls): self
    {
        $this->misControlls = $misControlls;

        return $this;
    }

    public function getDispossessed(): ?int
    {
        return $this->dispossessed;
    }

    public function setDispossessed(?int $dispossessed): self
    {
        $this->dispossessed = $dispossessed;

        return $this;
    }

    public function getGoalsWithoutPK(): ?int
    {
        return $this->goalsWithoutPK;
    }

    public function setGoalsWithoutPK(?int $goalsWithoutPK): self
    {
        $this->goalsWithoutPK = $goalsWithoutPK;

        return $this;
    }

    public function getPenaltyKicksMissed(): ?int
    {
        return $this->penaltyKicksMissed;
    }

    public function setPenaltyKicksMissed(?int $penaltyKicksMissed): self
    {
        $this->penaltyKicksMissed = $penaltyKicksMissed;

        return $this;
    }

    public function getCornerKicksGlsAgainst(): ?int
    {
        return $this->cornerKicksGlsAgainst;
    }

    public function setCornerKicksGlsAgainst(?int $cornerKicksGlsAgainst): self
    {
        $this->cornerKicksGlsAgainst = $cornerKicksGlsAgainst;

        return $this;
    }

    public function getAverageDistShootFromGoal(): ?float
    {
        return $this->averageDistShootFromGoal;
    }

    public function setAverageDistShootFromGoal(?float $averageDistShootFromGoal): self
    {
        $this->averageDistShootFromGoal = $averageDistShootFromGoal;

        return $this;
    }

    public function getPassTotalDistance(): ?int
    {
        return $this->passTotalDistance;
    }

    public function setPassTotalDistance(?int $passTotalDistance): self
    {
        $this->passTotalDistance = $passTotalDistance;

        return $this;
    }

    public function getPassTotalPrgDistance(): ?int
    {
        return $this->passTotalPrgDistance;
    }

    public function setPassTotalPrgDistance(?int $passTotalPrgDistance): self
    {
        $this->passTotalPrgDistance = $passTotalPrgDistance;

        return $this;
    }

    public function getProgressivePasses(): ?int
    {
        return $this->progressivePasses;
    }

    public function setProgressivePasses(?int $progressivePasses): self
    {
        $this->progressivePasses = $progressivePasses;

        return $this;
    }

    public function getInswingingCKs(): ?int
    {
        return $this->inswingingCKs;
    }

    public function setInswingingCKs(?int $inswingingCKs): self
    {
        $this->inswingingCKs = $inswingingCKs;

        return $this;
    }

    public function getOutswingingCKs(): ?int
    {
        return $this->outswingingCKs;
    }

    public function setOutswingingCKs(?int $outswingingCKs): self
    {
        $this->outswingingCKs = $outswingingCKs;

        return $this;
    }

    public function getStraightCKs(): ?int
    {
        return $this->straightCKs;
    }

    public function setStraightCKs(?int $straightCKs): self
    {
        $this->straightCKs = $straightCKs;

        return $this;
    }

    public function getHeadPasses(): ?int
    {
        return $this->headPasses;
    }

    public function setHeadPasses(?int $headPasses): self
    {
        $this->headPasses = $headPasses;

        return $this;
    }

    public function getPartsOtherPasses(): ?int
    {
        return $this->partsOtherPasses;
    }

    public function setPartsOtherPasses(?int $partsOtherPasses): self
    {
        $this->partsOtherPasses = $partsOtherPasses;

        return $this;
    }

    public function getTacklesInDefThird(): ?int
    {
        return $this->tacklesInDefThird;
    }

    public function setTacklesInDefThird(?int $tacklesInDefThird): self
    {
        $this->tacklesInDefThird = $tacklesInDefThird;

        return $this;
    }

    public function getTacklesInMidThird(): ?int
    {
        return $this->tacklesInMidThird;
    }

    public function setTacklesInMidThird(?int $tacklesInMidThird): self
    {
        $this->tacklesInMidThird = $tacklesInMidThird;

        return $this;
    }

    public function getTacklesInAttThird(): ?int
    {
        return $this->tacklesInAttThird;
    }

    public function setTacklesInAttThird(?int $tacklesInAttThird): self
    {
        $this->tacklesInAttThird = $tacklesInAttThird;

        return $this;
    }

    public function getPressInDefThird(): ?int
    {
        return $this->pressInDefThird;
    }

    public function setPressInDefThird(?int $pressInDefThird): self
    {
        $this->pressInDefThird = $pressInDefThird;

        return $this;
    }

    public function getPressInMidThird(): ?int
    {
        return $this->pressInMidThird;
    }

    public function setPressInMidThird(?int $pressInMidThird): self
    {
        $this->pressInMidThird = $pressInMidThird;

        return $this;
    }

    public function getPressInAttThird(): ?int
    {
        return $this->pressInAttThird;
    }

    public function setPressInAttThird(?int $pressInAttThird): self
    {
        $this->pressInAttThird = $pressInAttThird;

        return $this;
    }

    public function getCarriesCloseToGoal(): ?int
    {
        return $this->carriesCloseToGoal;
    }

    public function setCarriesCloseToGoal(?int $carriesCloseToGoal): self
    {
        $this->carriesCloseToGoal = $carriesCloseToGoal;

        return $this;
    }

    public function getCarriesInto18YardBox(): ?int
    {
        return $this->carriesInto18YardBox;
    }

    public function setCarriesInto18YardBox(?int $carriesInto18YardBox): self
    {
        $this->carriesInto18YardBox = $carriesInto18YardBox;

        return $this;
    }

    public function getProgressivePassRecieved(): ?int
    {
        return $this->progressivePassRecieved;
    }

    public function setProgressivePassRecieved(?int $progressivePassRecieved): self
    {
        $this->progressivePassRecieved = $progressivePassRecieved;

        return $this;
    }

    public function getLiveBallTouched(): ?int
    {
        return $this->liveBallTouched;
    }

    public function setLiveBallTouched(?int $liveBallTouched): self
    {
        $this->liveBallTouched = $liveBallTouched;

        return $this;
    }

    public function getTouchesInDefThird(): ?int
    {
        return $this->touchesInDefThird;
    }

    public function setTouchesInDefThird(?int $touchesInDefThird): self
    {
        $this->touchesInDefThird = $touchesInDefThird;

        return $this;
    }

    public function getTouchesInMidThird(): ?int
    {
        return $this->touchesInMidThird;
    }

    public function setTouchesInMidThird(?int $touchesInMidThird): self
    {
        $this->touchesInMidThird = $touchesInMidThird;

        return $this;
    }

    public function getTouchesInAttThird(): ?int
    {
        return $this->touchesInAttThird;
    }

    public function setTouchesInAttThird(?int $touchesInAttThird): self
    {
        $this->touchesInAttThird = $touchesInAttThird;

        return $this;
    }

    public function getMinutesPerMatchPlayed(): ?int
    {
        return $this->minutesPerMatchPlayed;
    }

    public function setMinutesPerMatchPlayed(?int $minutesPerMatchPlayed): self
    {
        $this->minutesPerMatchPlayed = $minutesPerMatchPlayed;

        return $this;
    }

    public function getPercentageOfMinutesPlayed(): ?float
    {
        return $this->PercentageOfMinutesPlayed;
    }

    public function setPercentageOfMinutesPlayed(?float $PercentageOfMinutesPlayed): self
    {
        $this->PercentageOfMinutesPlayed = $PercentageOfMinutesPlayed;

        return $this;
    }

    public function getCompleteMatchsPlayed(): ?int
    {
        return $this->completeMatchsPlayed;
    }

    public function setCompleteMatchsPlayed(?int $completeMatchsPlayed): self
    {
        $this->completeMatchsPlayed = $completeMatchsPlayed;

        return $this;
    }

    public function getMatchsAsSubstitute(): ?int
    {
        return $this->matchsAsSubstitute;
    }

    public function setMatchsAsSubstitute(?int $matchsAsSubstitute): self
    {
        $this->matchsAsSubstitute = $matchsAsSubstitute;

        return $this;
    }

    public function getMintuesPerSubstitute(): ?int
    {
        return $this->mintuesPerSubstitute;
    }

    public function setMintuesPerSubstitute(?int $mintuesPerSubstitute): self
    {
        $this->mintuesPerSubstitute = $mintuesPerSubstitute;

        return $this;
    }

    public function getMatchsAsUnusedSubstitute(): ?int
    {
        return $this->matchsAsUnusedSubstitute;
    }

    public function setMatchsAsUnusedSubstitute(?int $matchsAsUnusedSubstitute): self
    {
        $this->matchsAsUnusedSubstitute = $matchsAsUnusedSubstitute;

        return $this;
    }

    public function getGoalScoredByTeamWhileOnPitch(): ?int
    {
        return $this->goalScoredByTeamWhileOnPitch;
    }

    public function setGoalScoredByTeamWhileOnPitch(?int $goalScoredByTeamWhileOnPitch): self
    {
        $this->goalScoredByTeamWhileOnPitch = $goalScoredByTeamWhileOnPitch;

        return $this;
    }

    public function getGoalAllowedByTeamWhileOnPitch(): ?int
    {
        return $this->goalAllowedByTeamWhileOnPitch;
    }

    public function setGoalAllowedByTeamWhileOnPitch(?int $goalAllowedByTeamWhileOnPitch): self
    {
        $this->goalAllowedByTeamWhileOnPitch = $goalAllowedByTeamWhileOnPitch;

        return $this;
    }

    public function getGoalScoredMinusAllowedWhileOnPitchPer90(): ?int
    {
        return $this->goalScoredMinusAllowedWhileOnPitchPer90;
    }

    public function setGoalScoredMinusAllowedWhileOnPitchPer90(?int $goalScoredMinusAllowedWhileOnPitchPer90): self
    {
        $this->goalScoredMinusAllowedWhileOnPitchPer90 = $goalScoredMinusAllowedWhileOnPitchPer90;

        return $this;
    }
}
