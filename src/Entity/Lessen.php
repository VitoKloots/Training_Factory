<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessenRepository")
 */
class Lessen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locatie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $max_personen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\training", inversedBy="lessens")
     */
    private $les;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocatie(): ?string
    {
        return $this->locatie;
    }

    public function setLocatie(string $locatie): self
    {
        $this->locatie = $locatie;

        return $this;
    }

    public function getMaxPersonen(): ?string
    {
        return $this->max_personen;
    }

    public function setMaxPersonen(?string $max_personen): self
    {
        $this->max_personen = $max_personen;

        return $this;
    }

    public function getLes(): ?training
    {
        return $this->les;
    }

    public function setLes(?training $les): self
    {
        $this->les = $les;

        return $this;
    }
}
