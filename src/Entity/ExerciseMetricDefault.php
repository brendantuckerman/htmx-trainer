<?php

namespace App\Entity;

use App\Repository\ExerciseMetricDefaultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseMetricDefaultRepository::class)]
class ExerciseMetricDefault
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'metricDefaults')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetricDefinition $metricDefinition = null;

    #[ORM\Column(nullable: true)]
    private ?float $defaultValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getMetricDefinition(): ?MetricDefinition
    {
        return $this->metricDefinition;
    }

    public function setMetricDefinition(?MetricDefinition $metricDefinition): static
    {
        $this->metricDefinition = $metricDefinition;

        return $this;
    }

    public function getDefaultValue(): ?float
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?float $defaultValue): static
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}
