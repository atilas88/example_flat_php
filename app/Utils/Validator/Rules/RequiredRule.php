<?php

declare(strict_types=1);

namespace App\Utils\Validator\Rules;

use App\Utils\Validator\ValidatorRule;

class RequiredRule implements ValidatorRule
{
    public function apply(string $field, mixed $value = null, $constraint = null): bool
    {
        return !empty($value);
    }

    public function getMessage(string $field, mixed $constraint = null): string
    {
        return "The $field must be required";
    }
}