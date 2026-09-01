<?php

namespace App\Modulos\linkShortener\Domain\Entity;

use App\Modulos\HistoryLink\Domain\Entity\HistoryLinkEntity;
use App\Modulos\linkShortener\Infrastructure\Orm\Repository\LinkRepository;
use Couchbase\Collection;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Random\RandomException;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class LinkEntity
{
    const LINK_DEFAULT = 'http://127.0.0.1:8000/api/';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $originalUrl = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $newUrl = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?DateTimeInterface $expiresAt = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive = null;

    #[ORM\OneToMany(targetEntity: HistoryLinkEntity::class, mappedBy: 'linkEntity', cascade: ['persist'])]
    private Collection $statusHistories;

    public function __construct()
    {
    }

    /**
     * @throws RandomException
     */
    public static function create($url, $expiresAt): self
    {
        $link = new self();

        $shortUrl = LinkEntity::sortUrl();

        $link->originalUrl = $url;
        $link->newUrl = $shortUrl;
        $link->isActive = true;
        $link->expiresAt = $expiresAt;

        return $link;
    }

    private static function treatUrl($url, $urlRequest): self
    {
        if($urlRequest === $url) {
            throw new \DomainException('URL ja existente');
        }

        return $url;
    }

    /**
     * @throws RandomException
     */
    private static function sortUrl(): string
    {
        $byte = random_bytes(5);
        return bin2hex($byte);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(?string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }

    public function getNewUrl(): ?string
    {
        return $this->newUrl;
    }

    public function setNewUrl(?string $newUrl): void
    {
        $this->newUrl = $newUrl;
    }

    public function getExpiresAt(): ?DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?DateTimeInterface $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
