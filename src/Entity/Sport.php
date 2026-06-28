<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $color = null;

    /**
     * @var Collection<int, ExerciseType>
     */
    #[ORM\OneToMany(targetEntity: ExerciseType::class, mappedBy: 'sport')]
    private Collection $exerciseTypes;

    /**
     * @var Collection<int, MetricDefinition>
     */
    #[ORM\OneToMany(targetEntity: MetricDefinition::class, mappedBy: 'sport')]
    private Collection $metricDefinitions;

    public function __construct()
    {
        $this->exerciseTypes = new ArrayCollection();
        $this->metricDefinitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, ExerciseType>
     */
    public function getExerciseTypes(): Collection
    {
        return $this->exerciseTypes;
    }

    public function addExerciseType(ExerciseType $exerciseType): static
    {
        if (!$this->exerciseTypes->contains($exerciseType)) {
            $this->exerciseTypes->add($exerciseType);
            $exerciseType->setSport($this);
        }

        return $this;
    }

    public function removeExerciseType(ExerciseType $exerciseType): static
    {
        if ($this->exerciseTypes->removeElement($exerciseType)) {
            if ($exerciseType->getSport() === $this) {
                $exerciseType->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MetricDefinition>
     */
    public function getMetricDefinitions(): Collection
    {
        return $this->metricDefinitions;
    }

    public function addMetricDefinition(MetricDefinition $metricDefinition): static
    {
        if (!$this->metricDefinitions->contains($metricDefinition)) {
            $this->metricDefinitions->add($metricDefinition);
            $metricDefinition->setSport($this);
        }

        return $this;
    }

    public function removeMetricDefinition(MetricDefinition $metricDefinition): static
    {
        if ($this->metricDefinitions->removeElement($metricDefinition)) {
            if ($metricDefinition->getSport() === $this) {
                $metricDefinition->setSport(null);
            }
        }

        return $this;
    }
}
