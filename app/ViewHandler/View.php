<?php

declare(strict_types=1);

namespace App\ViewHandler;

use App\App;
use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(
        private string $view,
        private array $params = [],
        private bool $withLayout = false
    )
    {
        
    }

    public static function make(string $view, array $params = [], bool $withLayout = false): static
    {
        return new static($view, $params, $withLayout);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH. '/'.$this->view.'.php';

        $layoutPath = VIEW_PATH. '/layout/layout.php';


        if(! file_exists($viewPath))
        {
            App::logger()->log('error',"Error, view $viewPath not found");
            throw new ViewNotFoundException();
        }
        ob_start();

        include $viewPath;
        
        $content = ob_get_clean();

        if($this->withLayout)
        {
            include $layoutPath;
            return (string) ob_get_clean();
        }
        else
        {
            return (string) $content;
        }
    }

    public function __toString()
    {
        return $this->render();
    }
    public function __get($name)
    {
        return $this->params[$name] ?? null;
    }
}
