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
     * @ORM\Column(type="integer")
     */
    private $matchsPlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchStarts;

    /**
     * @ORM\Column(type="integer")
     */
    private $minsPlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $goals;

    /**
     * @ORM\Column(type="integer")
     */
    private $assits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pkMade;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pkAttempted;

    /**
     * @ORM\Column(type="integer")
     */
    private $yellowCard;

    /**
     * @ORM\Column(type="integer")
     */
    private $redCard;

    /**
     * @ORM\Column(type="float")
     */
    private $goalsPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $assistsPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $glsAssPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $goalsWithoutPkPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $glsAssWithoutPkPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $goalsExp;

    /**
     * @ORM\Column(type="float")
     */
    private $nonPenGoalsExp;

    /**
     * @ORM\Column(type="float")
     */
    private $assistsExp;

    /**
     * @ORM\Column(type="float")
     */
    private $goalsPerMinExp;

    /**
     * @ORM\Column(type="float")
     */
    private $assistsPerMinExp;

    /**
     * @ORM\Column(type="float")
     */
    private $glsAssistsPerMinExp;

    /**
     * @ORM\Column(type="float")
     */
    private $nonPenGoalsExpPerMin;

    /**
     * @ORM\Column(type="float")
     */
    private $nonPenGoalsAssistsExpPerMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $shoots;

    /**
     * @ORM\Column(type="integer")
     */
    private $shootsOnTarget;

    /**
     * @ORM\Column(type="integer")
     */
    private $shootsFromFrKc;

    /**
     * @ORM\Column(type="float")
     */
    private $shootsOnTargetPc;

    /**
     * @ORM\Column(type="float")
     */
    private $shootsPerMatch;

    /**
     * @ORM\Column(type="float")
     */
    private $shootsOnTargetPerMatch;

    /**
     * @ORM\Column(type="float")
     */
    private $goalsPerShoot;

    /**
     * @ORM\Column(type="float")
     */
    private $goalPerShootOnTarget;

    /**
     * @ORM\Column(type="integer")
     */
    private $keyPasses;

    /**
     * @ORM\Column(type="integer")
     */
    private $passesCompleted;

    /**
     * @ORM\Column(type="integer")
     */
    private $passesAttempted;

    /**
     * @ORM\Column(type="float")
     */
    private $passCompPercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $shortPassesCompleted;

    /**
     * @ORM\Column(type="integer")
     */
    private $shortpassesAttempted;

    /**
     * @ORM\Column(type="float")
     */
    private $shortPassesCompPercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $mediumPassesCompleted;

    /**
     * @ORM\Column(type="integer")
     */
    private $mediumPassesAttempted;

    /**
     * @ORM\Column(type="float")
     */
    private $mediumPassesCompPercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $longPassCompleted;

    /**
     * @ORM\Column(type="integer")
     */
    private $longPassesAttempted;

    /**
     * @ORM\Column(type="float")
     */
    private $longPassesCompPercent;

    /**
     * @ORM\Column(type="integer")
     */
    private $passCompletedFinalThird;

    /**
     * @ORM\Column(type="integer")
     */
    private $passCompletedPenaltyArea;

    /**
     * @ORM\Column(type="integer")
     */
    private $crossIntoPenaltyArea;

    /**
     * @ORM\Column(type="integer")
     */
    private $minutesPlayed;

    /**
     * @ORM\Column(type="float")
     */
    private $minutesPercentPlayed;

    /**
     * @ORM\Column(type="float")
     */
    private $nintyMinPlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $minPerMatchStarted;

    /**
     * @ORM\Column(type="float")
     */
    private $pointsPerMatch;

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

    public function getAssits(): ?int
    {
        return $this->assits;
    }

    public function setAssits(int $assits): self
    {
        $this->assits = $assits;

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
}
