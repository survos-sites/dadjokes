<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Joke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Joke> */
final class JokeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Joke::class);
    }

    /**
     * little_kids first (they're the safe, universal bucket — a little-kids
     * joke also works on big kids, never the reverse), then by rating
     * (highest-confidence jokes first), then sortOrder as a manual tiebreak.
     *
     * @return list<Joke>
     */
    public function findAllOrdered(): array
    {
        return $this->findBy([], ['ageGroup' => 'DESC', 'rating' => 'DESC', 'sortOrder' => 'ASC']);
    }

    public function nextSortOrder(): int
    {
        return 1 + (int) ($this->createQueryBuilder('j')
            ->select('MAX(j.sortOrder)')
            ->getQuery()
            ->getSingleScalarResult() ?? 0);
    }
}
