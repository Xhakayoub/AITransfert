<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;


class marketData {

    public function getValueByPlayer($fullName, $age, $club){

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:5000/TransfertMarekt/' . $fullName . '/' . $age . '/' .$club);
        
        return $response->getContent();

    }


}


?>