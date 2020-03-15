<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use League\Csv\Reader;
use League\Csv\Writer;

class ExtractDataFromWeb{

public function updateLeagueData(int $league, String $type, String $dir){
    
    //$api = 'https://fantasy.premierleague.com/api/bootstrap-static/';
    $client = HttpClient::create();
    $response = $client->request('GET', 'http://127.0.0.1:5000/'.$league.'/'.$type);
    //$handle = fopen("test.csv", "r");
    //$readerOfStandarsData = Writer::createFromPath('%kernel.root_dir%/../public/' . $dir . '/standars_data.csv');
    //$response = "reading and editing";
    $fp = fopen("C:/wamp64/www/AiTransfert/public/".$dir."/standars_data.csv", "r+");
    $line = fgets($fp);
    //fseek($fp, 2);
   // ftruncate($fp, 0);
    //fwrite($fp, $line);
    fwrite($fp,$response->getContent());
    fclose($fp);

            
    return $line;

}

}