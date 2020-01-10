<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 */
class Training
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
    private $naam;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $duur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $kosten;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lessen", mappedBy="les")
     */
    private $lessens;

    public function __construct()
    {
        $this->lessens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuur(): ?int
    {
        return $this->duur;
    }

    public function setDuur(int $duur): self
    {
        $this->duur = $duur;

        return $this;
    }

    public function getKosten(): ?float
    {
        return $this->kosten;
    }

    public function setKosten(?float $kosten): self
    {
        $this->kosten = $kosten;

        return $this;
    }

    /**
     * @return Collection|Lessen[]
     */
    public function getLessens(): Collection
    {
        return $this->lessens;
    }

    public function addLessen(Lessen $lessen): self
    {
        if (!$this->lessens->contains($lessen)) {
            $this->lessens[] = $lessen;
            $lessen->setLes($this);
        }

        return $this;
    }

    public function removeLessen(Lessen $lessen): self
    {
        if ($this->lessens->contains($lessen)) {
            $this->lessens->removeElement($lessen);
            // set the owning side to null (unless already changed)
            if ($lessen->getLes() === $this) {
                $lessen->setLes(null);
            }
        }

        return $this;
    }
}
