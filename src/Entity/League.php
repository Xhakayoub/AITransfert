<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeagueRepository")
 */
class League
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nation;

    /**
     * @ORM\Column(type="integer")
     */
    private $Level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="League")
     */
    private $Teams;

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->Nation;
    }

    public function setNation(string $Nation): self
    {
        $this->Nation = $Nation;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->Level;
    }

    public function setLevel(int $Level): self
    {
        $this->Level = $Level;

        return $this;
    }

    public function getTeams(): ?Team
    {
        return $this->Teams;
    }

    public function setTeams(?Team $Teams): self
    {
        $this->Teams = $Teams;

        return $this;
    }
}
