<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScriptHomeController extends AbstractController
{
    /**
     * @Route("/script", name="script_home")
     */
    public function index(): Response
    {
        return $this->render('script_home/index.html.twig', [
            'controller_name' => 'ScriptHomeController',
        ]);
    }
}
