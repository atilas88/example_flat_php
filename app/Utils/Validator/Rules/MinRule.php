<?php

declare(strict_types=1);

namespace App\Utils\Validator\Rules;

use App\Utils\Validator\ValidatorRule;

class MinRule implements ValidatorRule
{
    public function apply(string $field, mixed $value = null, mixed $constraint = null): bool
    {
        return strlen($value) >= (int)$constraint;
    }

    public function getMessage(string $field, mixed $constraint = null): string
    {
        return "The $field must be have at least $constraint characters";
    }
}