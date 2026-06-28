<?php

namespace App\Entity;

use App\Repository\ActivityLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityLogRepository::class)]
class ActivityLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'activityLogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionLog $sessionLog = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $activity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetricDefinition $metricDefinition = null;

    #[ORM\Column]
    private ?float $actualValue = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionLog(): ?SessionLog
    {
        return $this->sessionLog;
    }

    public function setSessionLog(?SessionLog $sessionLog): static
    {
        $this->sessionLog = $sessionLog;

        return $this;
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

    public function getActualValue(): ?float
    {
        return $this->actualValue;
    }

    public function setActualValue(float $actualValue): static
    {
        $this->actualValue = $actualValue;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }
}
