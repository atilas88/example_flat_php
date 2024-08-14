<?php

namespace App\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'Error, view not found';
}
