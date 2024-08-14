<?php

declare(strict_types=1);

namespace App\Utils\Validator;

interface ValidatorRule
{
    public function apply(string $field, mixed $value = null, mixed $constraint = null): bool;

    public function getMessage(string $field, mixed $constraint = null): string;
}