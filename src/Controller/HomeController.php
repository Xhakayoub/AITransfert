<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ExtractDataFromWeb;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ExtractDataFromWeb $service)
    {
     
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController'
          
        ]);
    }
}
