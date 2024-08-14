<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\MisingPostData;
use App\ViewHandler\View;
use App\Utils\HttpClient;
use App\Utils\Utils;
use App\Utils\Validator\Validator;

class WsController
{
    public function index(): View
    {
        return View::make(view:'ws/ws_view',params:['data'=>[]], withLayout:true);
    }

    public function fetchData(): View
    {
        $method = $_POST['method'];
        $url = $_POST['url'];

        $validator = new Validator();
        $dataValidated = $validator->validate($_POST,[
            'url'=> ['required','url','nospace']
        ]);
        if(!$dataValidated)
        {
        return View::make(view:'ws/ws_view',params:['errors'=>$validator->getErrors(), 'data'=>[]], withLayout:true);
        }

        try
        {
            $client =  new HttpClient();
            $data = $client->makeRequest($method,$url);
            
            $parseData = [];
            if(is_array($data))
            {
                foreach ($data as $key => $item)
                {
                    $parseData[] = Utils::flattenArray($item);
                }
            }
            else
            {
                $parseData[] = Utils::flattenArray($data);
            }
    
            return View::make(view:'ws/ws_view',params:['data'=>$parseData], withLayout:true);
        }
        catch(MisingPostData $e)
        {
            return View::make(view:'error/error_layout', params:['message'=> $e->getMessage()], withLayout:true);
        }

    }

}