<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/main", name="home")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' =>  'MainController',
        ]);
    }
}
