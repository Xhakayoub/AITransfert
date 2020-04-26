<?php

namespace App\Controller;

use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ExtractDataFromWeb;
use App\Repository\PlayerRepository;


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

     /**
     * @Route("/table", name="table")
     */
    public function table(ExtractDataFromWeb $service)
    {
     
        return $this->render('table.html.twig', [
            'controller_name' => 'HomeController'
          
        ]);
    }

     /**
     * @Route("/table_dyn", name="table_dynamic")
     */
    public function tableDynamic(PlayerRepository $repo)
    {    
        $players = $repo->findAll();
        //$players = $this->getDoctrine()->getRepository(Player::class);

        return $this->render('tableDynamic.html.twig', [
            'controller_name' => 'HomeController',
              'data' => $players
          
        ]);
    }
}
