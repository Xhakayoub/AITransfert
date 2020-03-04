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
}
