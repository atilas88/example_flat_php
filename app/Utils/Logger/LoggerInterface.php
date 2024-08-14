<?php

declare(strict_types=1);

namespace App\Utils\Logger;

interface LoggerInterface
{
    public function info(string $logMessage): void;

    public function error(string $logMessage): void;
}
