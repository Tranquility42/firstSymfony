<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exo3Controller extends AbstractController
{

    /**
     * @Route("/exo3/{nb1}/{operateur}/{nb2}", name="exo3")
     */
    public function index($nb1 , $operateur, $nb2 ): Response
    {
        $result = "";
        if ($operateur == 'add'){
            $result= $nb1 + $nb2 ;
        }elseif ($operateur == 'divide'){
            $result= $nb1 / $nb2 ;
        }elseif ($operateur == 'substract'){
            $result= $nb1 - $nb2 ;
        }elseif ($operateur == 'multiply'){
            $result= $nb1 * $nb2 ;
        }

        dump($result);

        return $this->render('exo3/index.html.twig', [
            'controller_name' => 'Exo3Controller',
            'result'=>$result
        ]);
    }
}
