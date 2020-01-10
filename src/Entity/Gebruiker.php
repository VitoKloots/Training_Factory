<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GebruikerRepository")
 */
class Gebruiker
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
    private $loginnaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $voorzetsel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achternaam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $geboortedatum;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $geslacht;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailadres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginnaam(): ?string
    {
        return $this->loginnaam;
    }

    public function setLoginnaam(string $loginnaam): self
    {
        $this->loginnaam = $loginnaam;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getVoorzetsel(): ?string
    {
        return $this->voorzetsel;
    }

    public function setVoorzetsel(?string $voorzetsel): self
    {
        $this->voorzetsel = $voorzetsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getGeboortedatum(): ?string
    {
        return $this->geboortedatum;
    }

    public function setGeboortedatum(string $geboortedatum): self
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    public function getGeslacht(): ?string
    {
        return $this->geslacht;
    }

    public function setGeslacht(string $geslacht): self
    {
        $this->geslacht = $geslacht;

        return $this;
    }

    public function getEmailadres(): ?string
    {
        return $this->emailadres;
    }

    public function setEmailadres(string $emailadres): self
    {
        $this->emailadres = $emailadres;

        return $this;
    }
}
