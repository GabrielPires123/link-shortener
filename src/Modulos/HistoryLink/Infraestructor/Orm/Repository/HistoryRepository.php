<?php

namespace App\Modulos\HistoryLink\Infraestructor\Orm\Repository;

use App\Modulos\HistoryLink\Domain\Entity\HistoryLinkEntity;
use App\Modulos\HistoryLink\Domain\Repository\HistoryLinkRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoryLinkEntity>
 */
class HistoryRepository extends ServiceEntityRepository implements HistoryLinkRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoryLinkEntity::class);
    }

    public function save($data): void
    {
        $this->getEntityManager()->persist($data);
        $this->getEntityManager()->flush();
    }
}
