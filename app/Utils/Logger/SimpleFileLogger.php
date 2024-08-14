<?php

declare(strict_types=1);

namespace App\Utils\Logger;

class SimpleFileLogger implements LoggerInterface
{
    public function info(string $logMessage): void
    {

        $this->writeLog('INFO',$logMessage) ;
    }

    public function error(string $logMessage): void
    {

        $this->writeLog('ERROR',$logMessage) ;
    }

    private function writeLog(string $severity, string $logMessage): void
    {
        $format = 'H:i:s d-M-Y';
        $time = date($format);

        $timeLog = "[{$time}] ";

        $severityLog = "[{$severity}]";
        $messageLog = $logMessage;

        if(file_exists(LOG_FILE_PATH))
        {
            file_put_contents(LOG_FILE_PATH, "{$timeLog}: {$severityLog} - {$messageLog}".PHP_EOL,FILE_APPEND);
        }

    }
}
