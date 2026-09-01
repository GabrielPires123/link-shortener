<?php

namespace App\Modulos\linkShortener\Infrastructure\Orm\Repository;

use App\Modulos\linkShortener\Domain\Entity\LinkEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Modulos\linkShortener\Domain\Repository\LinkShortnerInterface;

class LinkRepository extends ServiceEntityRepository implements LinkShortnerInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkEntity::class);
    }

    public function save($data): void
    {
        $this->getEntityManager()->persist($data);
        $this->getEntityManager()->flush();
    }
}
