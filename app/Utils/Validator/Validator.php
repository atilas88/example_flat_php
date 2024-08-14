<?php

declare(strict_types=1);

namespace App\Utils\Validator;

use App\Exceptions\InvalidFieldException;
use App\Exceptions\ValidatorException;
use App\Utils\Validator\Rules\MaxRule;
use App\Utils\Validator\Rules\MinRule;
use App\Utils\Validator\Rules\NospaceRule;
use App\Utils\Validator\Rules\RequiredRule;
use App\Utils\Validator\Rules\UrlRule;

class Validator
{
    private array $errorList = [];

    private array $rulesClass = [
        'required'=> RequiredRule::class,
        'min' => MinRule::class,
        'max'=> MaxRule::class,
        'nospace'=>NospaceRule::class,
        'url'=>UrlRule::class
    ];

    public function validate(array $data,  array $rules): bool
    {
        foreach($rules as $field => $fieldRules)
        {
            if(!array_key_exists($field,$data))
             {
                throw new InvalidFieldException();
             }
             foreach($fieldRules as $rule => $constraint)
             {
                $ruleName = is_string($rule) ? $rule : $constraint;
                $constraintName = is_string($rule) ? $constraint : null;

                $validatorRule = $this->findRule($ruleName);

                $ruleApplied = $validatorRule->apply(
                    field: $field,
                    value: $data[$field],
                    constraint: $constraintName
                );
                 if(!$ruleApplied)
                 {
                    $this->errorList[$field][$ruleName] = $validatorRule->getMessage($field,$constraintName);
                 }
             }

        }
        return !count($this->errorList) > 0;

    }

    private function findRule(string $name): ValidatorRule
    {
        if (isset($this->rulesClass[$name]))
        {
            return new $this->rulesClass[$name]();
        }
        throw new ValidatorException();
    }

    public function getErrors(): array
    {
        return $this->errorList;
    }
}
