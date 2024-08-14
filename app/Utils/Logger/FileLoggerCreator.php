<?php

declare(strict_types=1);

namespace App\Utils\Logger;

class FileLoggerCreator extends FactoryLogger
{
    public function getLogger(): LoggerInterface
    {
        return new SimpleFileLogger();
    }
}
