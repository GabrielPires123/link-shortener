<?php

namespace App\Modulos\linkShortener\Infrastructure\Http\Controller;

use App\Modulos\linkShortener\Application\UseService\LinkShorterServices;
use App\Modulos\Shared\Http\Controller\ApiControllerAbstract;
use http\Client\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Modulos\linkShortener\Infrastructure\Http\Request\Dto\CreateLinkRequestDto;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
class linkShortenerController extends ApiControllerAbstract
{
    public function __construct(ValidatorInterface $validator,
                                private readonly LinkShorterServices $linkShorterServices)
    {
        parent::__construct($validator);
    }


    #[Route(name: 'api_create_link', methods: ['POST'])]
    public function createLink(Response $response): JsonResponse
    {
        $data = json_decode($response->getBody(), true);
        $dto = new CreateLinkRequestDto($data);

        $this->validatorDto($dto);

        $this->linkShorterServices->create($dto);

        return $this->json([], HttpResponse::HTTP_BAD_REQUEST);
    }
}
