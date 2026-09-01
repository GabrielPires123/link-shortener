<?php

namespace App\Modulos\HistoryLink\Domain\Repository;

use Doctrine\Persistence\ObjectRepository;

interface HistoryLinkRepositoryInterface extends ObjectRepository
{
    public function save($data): void;
}
