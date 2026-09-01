<?php

namespace App\Modulos\Shared\Http\Helper\Validation;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationErrorFormatter
{
    public static function message(ConstraintViolationListInterface $errors): array
    {
        $errorMessages = [];

        foreach ($errors as $error) {
            $field = $error->getPropertyPath();
            $errorMessages[$field][] = $error->getMessage();
        }

        return $errorMessages;
    }
}
