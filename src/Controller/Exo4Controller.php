<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exo4Controller extends AbstractController
{
    /**
     * @Route("/exo4", name="exo4")
     */
    public function index(): Response
    {
        return $this->render('exo4/index.html.twig', [
            'controller_name' => 'Exo4Controller',
        ]);
    }
}
