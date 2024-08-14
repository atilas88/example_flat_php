<?php

declare(strict_types=1);

namespace App\Utils\Validator\Rules;

use App\Utils\Validator\ValidatorRule;

class NospaceRule implements ValidatorRule
{
    public function apply(string $field, mixed $value = null, mixed $constraint = null): bool
    {
        
        preg_match('/\s+/',$value,$match);
        return empty($match);
    }

    public function getMessage(string $field, mixed $constraint = null): string
    {
        return "The $field must not contain spaces";
    }
}
