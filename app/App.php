<?php

declare(strict_types=1);

namespace App;


use App\Router\Router;
use App\Exceptions\RouteNotFoundException;
use App\Utils\Logger\FactoryLogger;
use App\Utils\Logger\FileLoggerCreator;
use App\ViewHandler\View;



class App
{
    private static FactoryLogger $logger;

    public function __construct(private Router $router, private array $request)
    {
        static::$logger = new FileLoggerCreator();
    }

    public static function logger(): FactoryLogger
    {
        return static::$logger;
    }

    public function run()
    {
        try
        {
            echo $this->router->resolve(
                $this->request['uri'],
                strtolower($this->request['method'])
            );
        }
        catch(RouteNotFoundException $e)
        {
            http_response_code(404);
            echo View::make(view:'error/error_layout', params:['message'=> $e->getMessage()], withLayout:true);
        }

    }
}
