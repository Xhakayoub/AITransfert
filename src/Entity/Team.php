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
}
