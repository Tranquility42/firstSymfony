<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllOwnersController extends AbstractController

{
    /**
     * @var OwnerRepository
     */
    private $ownerRepository;


    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * AllOwnersController constructor.
     * @param OwnerRepository $ownerRepository
     * @param AnimalRepository $animalRepository
     */
    public function __construct(OwnerRepository $ownerRepository, AnimalRepository $animalRepository)
    {
        $this->ownerRepository = $ownerRepository;
        $this->animalRepository = $animalRepository;
    }


    /**
     * @Route("/owners", name="all_owners")
     */
    public function index(): Response
    {
        $ownerEntities = $this->ownerRepository->findAll();


        return $this->render('all_owners/index.html.twig', [
            'controller_name' => 'AllOwnersController',
            'ownerEntities' => $ownerEntities,


        ]);
    }

    /**
     * @Route("/animals-by-Owner/{id}", name="animalsByOwner")
     * @param $id
     * @return Response
     */
    public function animalsByOwners($id): Response
    {

        $animals = $this->animalRepository->findAll();
        $ownerEntity = $this->ownerRepository->find($id);

        return $this->render('all_owners/animals-by-owner.twig', [
            'controller_name' => 'AllOwnersController',
            'animals'=> $animals,
            'ownerEntity' => $ownerEntity,

        ]);
    }
}
