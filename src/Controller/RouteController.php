<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
    /**
     * @Route("/exo-1", name="route")
     */
    public function index(): Response
    {
        $str='On en a gros !';
        $var = 'gagné';

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'str'=>$str,
            'resultat'=>$var

        ]);

    }
}
