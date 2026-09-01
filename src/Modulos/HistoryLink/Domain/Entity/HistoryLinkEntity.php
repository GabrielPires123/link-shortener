<?php

namespace App\Modulos\HistoryLink\Domain\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
class HistoryLinkEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $oldUrl = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $newUrl = null;

    #[ORM\Column(type: 'DateTimeImmutable')]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?DateTimeInterface $updateddAt = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $deletedAt = null;

    #[ManyToOne(targetEntity: HistoryLinkEntity::class, cascade: ['persist', 'remove'], inversedBy: 'linkentity')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HistoryLinkEntity $historyLink = null;

    public function __construct()
    {
    }

    public static function create($url, $createdAt):self
    {
        $history = new self();

        $history->setOldUrl(null);
        $history->setNewUrl($url);
        $history->setCreatedAt($createdAt);
        $history->setDeletedAt(null);
        $history->setUpdateddAt(null);

        return $history;
    }

    public function getOldUrl(): ?string
    {
        return $this->oldUrl;
    }

    public function setOldUrl(?string $oldUrl): void
    {
        $this->oldUrl = $oldUrl;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdateddAt(): ?DateTimeInterface
    {
        return $this->updateddAt;
    }

    public function setUpdateddAt(?DateTimeInterface $updateddAt): void
    {
        $this->updateddAt = $updateddAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    public function getNewUrl(): ?string
    {
        return $this->newUrl;
    }

    public function setNewUrl(?string $newUrl): void
    {
        $this->newUrl = $newUrl;
    }
}
