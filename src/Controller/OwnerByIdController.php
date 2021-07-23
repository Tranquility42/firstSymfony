<?php

namespace App\Controller;

use App\Repository\OwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerByIdController extends AbstractController
{
    /**
     * @var OwnerRepository
     */

    private $ownerRepository;

    /**
     * OwnerByIdController constructor.
     * @param OwnerRepository $ownerRepository
     */
    public function __construct(OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    /**
     * @Route("/ownerid/{id}", name="owner_by_id")
     */
    public function index($id): Response
    {

        $ownerEntity = $this->ownerRepository->find($id);



        return $this->render('owner_by_id/index.html.twig', [
            'controller_name' => 'OwnerByIdController',
            'ownerEntity'=> $ownerEntity
        ]);
    }
}
