<?php

declare(strict_types=1);

namespace App\Database;

use App\App;
use PDO;

class Db
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try
        {
            $this->pdo = new PDO(
                "sqlsrv:Server={$config['host']};Database={$config['database']}",
                $config['user'],
                $config['password'],
                $config['options'] ?? $defaultOptions
            );
        }
        catch(\PDOException $e)
        {
            App::logger()->log('error',$e->getMessage());
            throw new \PDOException($e->getMessage());
        }
    }
    
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo,$name],$arguments);
    }

}
