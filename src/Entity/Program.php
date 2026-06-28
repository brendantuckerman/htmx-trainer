<?php

namespace App\Entity;

use App\Enum\ProgramStatus;
use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramRepository::class)]
class Program
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $endDate = null;

    #[ORM\Column(enumType: ProgramStatus::class, options: ['default' => 'draft'])]
    private ProgramStatus $status = ProgramStatus::Draft;

    #[ORM\Column(options: ['default' => false])]
    private bool $isTemplate = false;

    /**
     * @var Collection<int, ProgramWeek>
     */
    #[ORM\OneToMany(targetEntity: ProgramWeek::class, mappedBy: 'program', orphanRemoval: true)]
    private Collection $programWeeks;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'program', orphanRemoval: true)]
    private Collection $goals;

    public function __construct()
    {
        $this->programWeeks = new ArrayCollection();
        $this->goals = new ArrayCollection();
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

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatus(): ProgramStatus
    {
        return $this->status;
    }

    public function setStatus(ProgramStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isTemplate(): bool
    {
        return $this->isTemplate;
    }

    public function setIsTemplate(bool $isTemplate): static
    {
        $this->isTemplate = $isTemplate;

        return $this;
    }

    /**
     * @return Collection<int, ProgramWeek>
     */
    public function getProgramWeeks(): Collection
    {
        return $this->programWeeks;
    }

    public function addProgramWeek(ProgramWeek $programWeek): static
    {
        if (!$this->programWeeks->contains($programWeek)) {
            $this->programWeeks->add($programWeek);
            $programWeek->setProgram($this);
        }

        return $this;
    }

    public function removeProgramWeek(ProgramWeek $programWeek): static
    {
        if ($this->programWeeks->removeElement($programWeek)) {
            // set the owning side to null (unless already changed)
            if ($programWeek->getProgram() === $this) {
                $programWeek->setProgram(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setProgram($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getProgram() === $this) {
                $goal->setProgram(null);
            }
        }

        return $this;
    }
}
