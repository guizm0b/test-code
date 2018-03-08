<?php

namespace App\Helper;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationHelper
{
    public function formatErrors(ConstraintViolationList $violations)
    {
        $errorArr = [];

        foreach ($violations as $violation) {
            $errorArr[] = [
                'property' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return [
          'errors' => $errorArr,
        ];
    }
}
