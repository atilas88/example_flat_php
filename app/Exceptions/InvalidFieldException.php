<?php

namespace App\Exceptions;

class InvalidFieldException extends \Exception
{
    protected $message = 'Invalid field provided';
}
