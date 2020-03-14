<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\ExtractDataFromWeb;
use Symfony\Component\BrowserKit\HttpBrowser;





class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ExtractDataFromWeb $service)
    {

       $response = $service->updateLeagueData('ligue1');
        // $api1 = 'https://www.premierleague.com/stats/top/players/goals';

        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $response
           
        ]);
    }
}
