<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalListController extends AbstractController
{
    /**
     * @Route("/animal/list", name="animal_list")
     */
    public function index(): Response
    {
        return $this->render('animal_list/index.html.twig', [
            'controller_name' => 'AnimalListController',
        ]);
    }
}
