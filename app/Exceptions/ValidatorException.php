<?php

namespace App\Exceptions;

class ValidatorException extends \Exception
{
  protected $message = 'Validation rule not found';
}
