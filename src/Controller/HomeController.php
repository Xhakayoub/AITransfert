<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Services\ExtractDataFromWeb;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\HttpBrowser;





class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ExtractDataFromWeb $data)
    {   
        
        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', 'https://www.premierleague.com/stats/top/players/goals');
        // $api1 = 'https://www.premierleague.com/stats/top/players/goals';

        $api = 'https://fantasy.premierleague.com/api/bootstrap-static/';
        $client = HttpClient::create(); 
       // $response = $client->request('GET', $api1);
        // $html = <<<'HTML'
        // <!DOCTYPE html>
        // <html>
        //     <body>
        //         <p class="message">Hello World!</p>
        //         <p>Hello Crawler!</p>
        //     </body>
        // </html>
        // HTML;
        //$crawler = new Crawler($html);

        // foreach ($crawler as $domElement) {
        //     var_dump($domElement->nodeName);
        // }
        $content = $data->getPremierleagueData($api);
       // $content1 = $data->getPremierleagueData($api1);
        // $client = HttpClient::create();

        // $response = $client->request('GET', 'https://fantasy.premierleague.com/api/bootstrap-static/');

        // $content = $response->getContent();
        // $content = $response->toArray();
                
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'data' => $content,
            'test' => $crawler
        ]);
    }
}
