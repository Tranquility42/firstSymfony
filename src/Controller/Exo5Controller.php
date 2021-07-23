<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exo5Controller extends AbstractController
{
    /**
     * @Route("/exo5", name="exo5")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('route');

    }
}
