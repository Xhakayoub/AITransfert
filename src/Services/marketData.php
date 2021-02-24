<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Player;

class marketData {

    public function getValueByPlayer(Player $player){

        $fullName = explode('\\', $player->getName(), 2)[1];
        $age = $player->getAge();
        $club = $player->getSquad();

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://127.0.0.1:5000/TransfertMarekt/' . $fullName . '/' . $age . '/' .$club);
        
        return $response->getContent();

    }


}


?>