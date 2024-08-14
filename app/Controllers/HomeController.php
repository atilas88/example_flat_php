<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Models\LodgingModel;
use App\Models\ProviderModel;
use App\Utils\Validator\Validator;
use App\ViewHandler\View;


class HomeController
{
    public function index(): View
    {
        return View::make(view: 'index',params:['data'=>[]], withLayout:true);
    }

    public function fetchData(): View
    {
        $validator = new Validator();
        $dataValidated = $validator->validate($_POST,[
            'server'=> ['required','min'=>9,'max'=>50,'nospace'],
            'user'=> ['required','min'=>9,'nospace'],
            'password'=> ['required','min'=>9,'nospace'],
            'database'=> ['required','min'=>5,'nospace'],
        ]);

        if(!$dataValidated)
        {
            return View::make(view:'index',params:['errors'=>$validator->getErrors(),'data'=>[]], withLayout:true);
        }
        $opts = [
            'host' => $_POST['server'],
            'user' => $_POST['user'],
            'password' => $_POST['password'],
            'database' => $_POST['database']
        ];
        try
        {
            $logModel = new LodgingModel($opts);
            $data = $logModel->getAll();
            return View::make(view:'index',params:['data'=>$data], withLayout:true);
        }
        catch(\PDOException $e)
        {
            return View::make(view:'error/error_layout', params:['message'=> $e->getMessage()], withLayout:true);
        }

    }
}
