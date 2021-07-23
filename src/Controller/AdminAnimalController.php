<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAnimalController extends AbstractController
{
    /**
     * @Route("/admin/animal", name="admin_animal")
     */
    public function index(): Response
    {
        return $this->render('admin_animal/index.html.twig', [
            'controller_name' => 'AdminAnimalController',
        ]);
    }
}
