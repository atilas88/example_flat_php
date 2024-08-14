<?php

namespace App\Exceptions;

class NoCurlExtensionException extends \Exception
{
    protected $message = 'No curl extension installed';
}
