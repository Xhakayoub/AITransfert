<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use League\Csv\Reader;
use League\Csv\Writer;

class ExtractDataFromWeb
{

    public function updateLeagueData(int $league, String $type, String $dir)
    {

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:5000/' . $league . '/' . $type);
        $fp = fopen("C:/wamp64/www/AiTransfert/public/" . $dir . "/standars_data.csv", "r+");
        $line = fgets($fp);
        fwrite($fp, $response->getContent());
        fclose($fp);

    }
}
