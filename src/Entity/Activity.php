<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null;

    /**
     * @var Collection<int, ActivityMetric>
     */
    #[ORM\OneToMany(targetEntity: ActivityMetric::class, mappedBy: 'activity', orphanRemoval: true)]
    private Collection $activityMetrics;

    public function __construct()
    {
        $this->activityMetrics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

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

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
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

    /**
     * @return Collection<int, ActivityMetric>
     */
    public function getActivityMetrics(): Collection
    {
        return $this->activityMetrics;
    }

    public function addActivityMetric(ActivityMetric $activityMetric): static
    {
        if (!$this->activityMetrics->contains($activityMetric)) {
            $this->activityMetrics->add($activityMetric);
            $activityMetric->setActivity($this);
        }

        return $this;
    }

    public function removeActivityMetric(ActivityMetric $activityMetric): static
    {
        if ($this->activityMetrics->removeElement($activityMetric)) {
            if ($activityMetric->getActivity() === $this) {
                $activityMetric->setActivity(null);
            }
        }

        return $this;
    }
}
