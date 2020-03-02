<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {   
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://fantasy.premierleague.com/api/bootstrap-static/');

        // $statusCode = $response->getStatusCode();
        // // $statusCode = 200
        // $contentType = $response->getHeaders()['content-type'][0];
        // // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
                
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $content
        ]);
    }
}
