<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?array $muscleGroups = null;

    #[ORM\Column(nullable: true)]
    private ?array $equipment = null;

    #[ORM\ManyToOne(inversedBy: 'exercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExerciseType $type = null;

    /**
     * @var Collection<int, ExerciseMetricDefault>
     */
    #[ORM\OneToMany(targetEntity: ExerciseMetricDefault::class, mappedBy: 'exercise', orphanRemoval: true)]
    private Collection $metricDefaults;

    public function __construct()
    {
        $this->metricDefaults = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMuscleGroups(): ?array
    {
        return $this->muscleGroups;
    }

    public function setMuscleGroups(?array $muscleGroups): static
    {
        $this->muscleGroups = $muscleGroups;

        return $this;
    }

    public function getEquipment(): ?array
    {
        return $this->equipment;
    }

    public function setEquipment(?array $equipment): static
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getType(): ?ExerciseType
    {
        return $this->type;
    }

    public function setType(?ExerciseType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, ExerciseMetricDefault>
     */
    public function getMetricDefaults(): Collection
    {
        return $this->metricDefaults;
    }

    public function addMetricDefault(ExerciseMetricDefault $metricDefault): static
    {
        if (!$this->metricDefaults->contains($metricDefault)) {
            $this->metricDefaults->add($metricDefault);
            $metricDefault->setExercise($this);
        }

        return $this;
    }

    public function removeMetricDefault(ExerciseMetricDefault $metricDefault): static
    {
        if ($this->metricDefaults->removeElement($metricDefault)) {
            if ($metricDefault->getExercise() === $this) {
                $metricDefault->setExercise(null);
            }
        }

        return $this;
    }
}
