<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;


class ExtractDataFromWeb{

public function getPremierleagueData(String $api) :array{
    
    //$api = 'https://fantasy.premierleague.com/api/bootstrap-static/';

    $client = HttpClient::create();

    $response = $client->request('GET', $api);
    
    $content = $response->getContent();
    $content = $response->toArray();
            
    return $content;

}

}