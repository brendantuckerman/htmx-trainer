<?php

namespace App\Entity;

use App\Repository\ActivityMetricRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityMetricRepository::class)]
class ActivityMetric
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'activityMetrics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $activity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetricDefinition $metricDefinition = null;

    #[ORM\Column(nullable: true)]
    private ?float $plannedValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): static
    {
        $this->activity = $activity;

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

    public function getPlannedValue(): ?float
    {
        return $this->plannedValue;
    }

    public function setPlannedValue(?float $plannedValue): static
    {
        $this->plannedValue = $plannedValue;

        return $this;
    }
}
