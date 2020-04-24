<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ExtractDataFromWeb;


class HomeController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(ExtractDataFromWeb $service)
    {
     
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController'
          
        ]);
    }

    /**
     * @Route("/index", name="index")
     */
    public function indexTest(ExtractDataFromWeb $service)
    {
     
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController'
          
        ]);
    }
}
