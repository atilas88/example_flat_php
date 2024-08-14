<?php

declare(strict_types=1);

namespace App\Utils;

use App\App;
use App\Exceptions\MisingPostData;
use App\Exceptions\NoCurlExtensionException;

class HttpClient
{
    public function makeRequest(string $method, string $url, array $params = [], array $options = []) : array
    {
        if(!extension_loaded("curl"))
        {
           App::logger()->log('error','No curl extension installed');
           throw new NoCurlExtensionException();
        }
        $curl = curl_init();

        $defaultOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
        ];

        if($method === strtolower("POST") && !empty($params))
        {
            $defaultOptions = array_merge( $defaultOptions, [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $params
            ]);
        }
        elseif($method === strtolower("POST") && empty($params))
        {
            App::logger()->log('error','No post data provided');
         throw new MisingPostData();
        }
        if(!empty($options))
        {
            $defaultOptions = array_merge( $defaultOptions, $options);
        }
        
        curl_setopt_array($curl, $defaultOptions);

        $data = curl_exec($curl);

        curl_close($curl);

        return json_decode($data);
    }


}
