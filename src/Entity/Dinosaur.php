<?php

namespace App\Entity;

use App\Repository\DinosaurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DinosaurRepository::class)
 */
class Dinosaur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $typeSpecies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=Period::class, inversedBy="dinosaurs")
     */
    private $period;

    /**
     * @ORM\ManyToMany(targetEntity=Food::class, inversedBy="dinosaurs")
     */
    private $food;

    /**
     * @ORM\ManyToMany(targetEntity=Environment::class, inversedBy="dinosaurs")
     */
    private $environment;

    /**
     * @ORM\ManyToMany(targetEntity=Localization::class, inversedBy="dinosaurs")
     */
    private $localization;

    public function __construct()
    {
        $this->food = new ArrayCollection();
        $this->environment = new ArrayCollection();
        $this->localization = new ArrayCollection();
    }

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

    public function getTypeSpecies(): ?string
    {
        return $this->typeSpecies;
    }

    public function setTypeSpecies(string $typeSpecies): self
    {
        $this->typeSpecies = $typeSpecies;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return Collection|Food[]
     */
    public function getFood(): Collection
    {
        return $this->food;
    }

    public function addFood(Food $food): self
    {
        if (!$this->food->contains($food)) {
            $this->food[] = $food;
        }

        return $this;
    }

    public function removeFood(Food $food): self
    {
        $this->food->removeElement($food);

        return $this;
    }

    /**
     * @return Collection|Environment[]
     */
    public function getEnvironment(): Collection
    {
        return $this->environment;
    }

    public function addEnvironment(Environment $environment): self
    {
        if (!$this->environment->contains($environment)) {
            $this->environment[] = $environment;
        }

        return $this;
    }

    public function removeEnvironment(Environment $environment): self
    {
        $this->environment->removeElement($environment);

        return $this;
    }

    /**
     * @return Collection|Localization[]
     */
    public function getLocalization(): Collection
    {
        return $this->localization;
    }

    public function addLocalization(Localization $localization): self
    {
        if (!$this->localization->contains($localization)) {
            $this->localization[] = $localization;
        }

        return $this;
    }

    public function removeLocalization(Localization $localization): self
    {
        $this->localization->removeElement($localization);

        return $this;
    }
}
