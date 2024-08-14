<?php

declare(strict_types=1);

namespace App\Utils\Validator\Rules;

use App\Utils\Validator\ValidatorRule;

class UrlRule implements ValidatorRule
{
    public function apply(string $field, mixed $value = null, $constraint = null): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) === $value;
    }

    public function getMessage(string $field, mixed $constraint = null): string
    {
        return "The $field must be a valid url";
    }
}