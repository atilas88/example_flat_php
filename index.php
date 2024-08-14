<?php


use App\Router\Router;
use App\App;
use App\Controllers\HomeController;
use App\Controllers\WsController;
use App\ViewHandler\View;

require_once __DIR__.'/vendor/autoload.php';

define('VIEW_PATH',__DIR__.'/views');

define('LOG_FILE_PATH', __DIR__.'/app/logs/system.log');

define('DEFAULT_LANG','es');

define('DEFAULT_LOCALE',__DIR__.'/app/l10n');

define('LANGUAGE_REGISTER',__DIR__.'/app/l10n/register_lang.txt');

$langRegistered = file_get_contents(LANGUAGE_REGISTER);
$lang = !empty($langRegistered) ? $langRegistered : DEFAULT_LANG;

$GLOBALS["lang"] = require  DEFAULT_LOCALE.'/'. $lang  . '.php';

$router = new Router();

$router->get('/',[HomeController::class, 'index'])
       ->post('/', [HomeController::class, 'fetchData'])
       ->get('/ws',[WsController::class, 'index'])
       ->post('/ws',[WsController::class, 'fetchData'])
       ->get('/lang', function() {
              $lang = $_GET['langID'];
              if(file_exists(DEFAULT_LOCALE.'/'. $lang . '.php'))
              {
                     $GLOBALS["lang"] = require  DEFAULT_LOCALE.'/'. $lang . '.php';
                     file_put_contents(LANGUAGE_REGISTER,$lang);
                     return View::make(view: 'index',params:['data'=>[]], withLayout:true);
              }
              else
              {
                     return View::make(view:'error/error_layout', params:['message'=>'No valid language'], withLayout:true);
              }

       });

(new App(
     $router,
     ['uri' => $_SERVER['PATH_INFO'], 'method' => $_SERVER['REQUEST_METHOD']]
     ))->run();
