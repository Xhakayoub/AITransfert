<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;


class ExtractDataFromWeb{

public function getPremierleagueData(String $api){
    
    //$api = 'https://fantasy.premierleague.com/api/bootstrap-static/';
    $browser = new HttpBrowser(HttpClient::create());
    $crawler = $browser->request('GET', 'https://fbref.com/en/comps/8/misc/Champions-League-Stats');
            
    return $crawler;

}

}