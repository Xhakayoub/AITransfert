<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index()
    {
        return $this->render('form/dashboard.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }
}
