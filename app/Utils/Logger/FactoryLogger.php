<?php

declare(strict_types=1);

namespace App\Utils\Logger;

abstract class FactoryLogger
{
    abstract public function getLogger(): LoggerInterface;

    public function log(string $type, string $message)
    {
        $logger = $this->getLogger();

        call_user_func_array([$logger,$type],[$message]);
    }
}
