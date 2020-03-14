<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;


class ExtractDataFromWeb{

public function updateLeagueData(String $league){
    
    //$api = 'https://fantasy.premierleague.com/api/bootstrap-static/';
    $client = HttpClient::create();
    $response = $client->request('GET', 'http://127.0.0.1:5000/'.$league);
            
    return $response->getContent();

}

}