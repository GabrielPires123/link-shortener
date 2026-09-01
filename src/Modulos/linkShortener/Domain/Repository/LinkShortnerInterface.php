<?php

namespace Modulos\linkShortener\Domain\Repository;

use Doctrine\Persistence\ObjectRepository;

interface LinkShortnerInterface extends ObjectRepository
{
    public function save($data): void;

}
