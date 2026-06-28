<?php

namespace App\Entity;

use App\Repository\GoalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: GoalRepository::class)]
class Goal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $targetValue = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $unit = null;

    #[ORM\Column(nullable: true)]
    private ?float $currentValue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $targetDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $achievedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne]
    private ?MetricDefinition $metricDefinition = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Program $program = null;

    #[ORM\ManyToOne]
    private ?ProgramWeek $week = null;

    #[ORM\ManyToOne]
    private ?Sport $sport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTargetValue(): ?float
    {
        return $this->targetValue;
    }

    public function setTargetValue(?float $targetValue): static
    {
        $this->targetValue = $targetValue;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getCurrentValue(): ?float
    {
        return $this->currentValue;
    }

    public function setCurrentValue(?float $currentValue): static
    {
        $this->currentValue = $currentValue;

        return $this;
    }

    public function getTargetDate(): ?\DateTime
    {
        return $this->targetDate;
    }

    public function setTargetDate(?\DateTime $targetDate): static
    {
        $this->targetDate = $targetDate;

        return $this;
    }

    public function getAchievedAt(): ?\DateTime
    {
        return $this->achievedAt;
    }

    public function setAchievedAt(?\DateTime $achievedAt): static
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

    public function getMetricDefinition(): ?MetricDefinition
    {
        return $this->metricDefinition;
    }

    public function setMetricDefinition(?MetricDefinition $metricDefinition): static
    {
        $this->metricDefinition = $metricDefinition;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): static
    {
        $this->program = $program;

        return $this;
    }

    public function getWeek(): ?ProgramWeek
    {
        return $this->week;
    }

    public function setWeek(?ProgramWeek $week): static
    {
        $this->week = $week;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): static
    {
        $this->sport = $sport;

        return $this;
    }
}
