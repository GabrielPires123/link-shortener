<?php

namespace App\Modulos\linkShortener\Application\UseService;

use App\Modulos\HistoryLink\Domain\Entity\HistoryLinkEntity;
use App\Modulos\HistoryLink\Domain\Repository\HistoryLinkRepositoryInterface;
use App\Modulos\linkShortener\Domain\Entity\LinkEntity;
use Modulos\linkShortener\Domain\Repository\LinkShortnerInterface;
use Modulos\linkShortener\Infrastructure\Http\Request\Dto\CreateLinkRequestDto;

readonly class LinkShorterServices
{
    public function __construct(private LinkShortnerInterface $linkShortner,
                                private HistoryLinkRepositoryInterface $historyLinkRepository)
    {

    }

    public function create(CreateLinkRequestDto $dto): void
    {
        $entity = LinkEntity::create($dto->getUrl(), $dto->getExpiresAt());
        $history = HistoryLinkEntity::create($dto->getUrl(), $dto->getCreatedAt(), $entity);

        $this->linkShortner->save($entity);
        $this->historyLinkRepository->save($history);
    }
}
