<?php

namespace Modulos\linkShortener\Infrastructure\Http\Request\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateLinkRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Url]
    private ?string $url;
    private \DateTimeImmutable $createdAt;
    private ?string $expiresAt;

    /**
     * @throws \Exception
     */
    public function __construct($data)
    {
        $this->url = $data['link'] ?? null;
        $this->createdAt = new \DateTimeImmutable($data['createdAt']);
        $this->expiresAt = $data['expiresAt'] ?? null;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expiresAt;
    }
}
