<?php

namespace App\Entity;

use App\Repository\PersonalRecordRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalRecordRepository::class)]
class PersonalRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetricDefinition $metricDefinition = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $achievedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    /** The session log where this PR was set, if known. */
    #[ORM\ManyToOne]
    private ?SessionLog $sessionLog = null;

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

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getAchievedAt(): ?\DateTime
    {
        return $this->achievedAt;
    }

    public function setAchievedAt(\DateTime $achievedAt): static
    {
        $this->achievedAt = $achievedAt;

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

    public function getSessionLog(): ?SessionLog
    {
        return $this->sessionLog;
    }

    public function setSessionLog(?SessionLog $sessionLog): static
    {
        $this->sessionLog = $sessionLog;

        return $this;
    }
}
