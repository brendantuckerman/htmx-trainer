<?php

namespace App\Repository;

use App\Entity\ExerciseMetricDefault;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciseMetricDefault>
 */
class ExerciseMetricDefaultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseMetricDefault::class);
    }
}
