<?php

namespace App\Controller;

use App\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exo2Controller extends AbstractController
{
    /**
     * @Route("/exo2/{prenom}", name="exo2")
     */
    public function index($prenom): Response
    {
        $owner = new Owner();
        $owner->setFirstName($prenom);


        return $this->render('exo2/index.html.twig', [
            'controller_name' => 'Exo2Controller',
            'prenom'=>$owner->getFirstName()
        ]);

    }
}
