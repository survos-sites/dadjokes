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
     * joke also works on big kids, never the reverse), then sortOrder — the
     * admin's ↑/↓ arrows, i.e. Tac's manually-curated performance set within
     * that age group. Star rating is a separate axis (confidence/print
     * filter), not part of this ordering — it stopped driving position once
     * ↑/↓ became a dedicated reorder control.
     *
     * @return list<Joke>
     */
    public function findAllOrdered(): array
    {
        return $this->findBy([], ['ageGroup' => 'DESC', 'sortOrder' => 'ASC']);
    }

    public function nextSortOrder(): int
    {
        return 1 + (int) ($this->createQueryBuilder('j')
            ->select('MAX(j.sortOrder)')
            ->getQuery()
            ->getSingleScalarResult() ?? 0);
    }
}
