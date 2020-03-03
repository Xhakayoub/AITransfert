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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $team;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $league;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goals;

    /**
     * @ORM\Column(type="integer")
     */
    private $passes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $crosses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passesCompletes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $assists;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $covers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yellowCard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $redCard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tackles;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfMatchs;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPlayer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(?string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getLeague(): ?string
    {
        return $this->league;
    }

    public function setLeague(?string $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getGoals(): ?int
    {
        return $this->goals;
    }

    public function setGoals(?int $goals): self
    {
        $this->goals = $goals;

        return $this;
    }

    public function getPasses(): ?int
    {
        return $this->passes;
    }

    public function setPasses(int $passes): self
    {
        $this->passes = $passes;

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

    public function getPassesCompletes(): ?int
    {
        return $this->passesCompletes;
    }

    public function setPassesCompletes(?int $passesCompletes): self
    {
        $this->passesCompletes = $passesCompletes;

        return $this;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(?int $assists): self
    {
        $this->assists = $assists;

        return $this;
    }

    public function getCovers(): ?int
    {
        return $this->covers;
    }

    public function setCovers(?int $covers): self
    {
        $this->covers = $covers;

        return $this;
    }

    public function getYellowCard(): ?int
    {
        return $this->yellowCard;
    }

    public function setYellowCard(?int $yellowCard): self
    {
        $this->yellowCard = $yellowCard;

        return $this;
    }

    public function getRedCard(): ?int
    {
        return $this->redCard;
    }

    public function setRedCard(?int $redCard): self
    {
        $this->redCard = $redCard;

        return $this;
    }

    public function getTackles(): ?int
    {
        return $this->tackles;
    }

    public function setTackles(?int $tackles): self
    {
        $this->tackles = $tackles;

        return $this;
    }

 
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getNumberOfMatchs(): ?int
    {
        return $this->numberOfMatchs;
    }

    public function setNumberOfMatchs(?int $numberOfMatchs): self
    {
        $this->numberOfMatchs = $numberOfMatchs;

        return $this;
    }

    public function getIdPlayer(): ?int
    {
        return $this->idPlayer;
    }

    public function setIdPlayer(int $idPlayer): self
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }
}
