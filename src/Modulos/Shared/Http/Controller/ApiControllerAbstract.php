<?php

namespace App\Modulos\Shared\Http\Controller;

use App\Modulos\Shared\Http\Helper\ResponseServer;
use App\Modulos\Shared\Http\Helper\Validation\ValidationErrorFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiControllerAbstract extends AbstractController
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    protected function validatorDto($dto): void
    {
        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $errorMessages = ValidationErrorFormatter::message($errors);
            $response = ResponseServer::responseArray(Response::HTTP_BAD_REQUEST, $errorMessages);

            throw new \InvalidArgumentException(json_encode($response));
        }
    }
}
