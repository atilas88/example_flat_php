<?php

namespace App\Exceptions;

class MisingPostData extends \Exception
{
    protected $message = 'No post data provided';
}