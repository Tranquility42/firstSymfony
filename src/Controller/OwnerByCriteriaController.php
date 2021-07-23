<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerByCriteriaController extends AbstractController

{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var OwnerRepository
     */

    private $ownerRepository;

    /**
     * OwnerByCriteriaController constructor.
     * @param EntityManagerInterface $em
     * @param OwnerRepository $ownerRepository
     */
    public function __construct(EntityManagerInterface $em, OwnerRepository $ownerRepository)
    {
        $this->em = $em;
        $this->ownerRepository = $ownerRepository;
    }

    /**
     *
     * @Route("/ownercriteria/{prenom}", name="owner_by_criteria")
     */

    public function index(string $prenom): Response
    {
        $ownerEntities = $this->ownerRepository->findOneBy (['firstName'=>$prenom]);
        dump($ownerEntities);

        return $this->render('owner_by_criteria/index.html.twig', [
            'controller_name' => 'OwnerByCriteriaController',
        ]);
    }

    /**
     *
     * @Route("addownerbyname/{prenom}/{nom}", name="addownerbyname")
     * @param string $prenom
     * @param string $nom
     * @return Response
     */

    public function addOwner(string $prenom ,  string $nom): Response
    {

        $ownerEntity = new Owner();
        $ownerEntity->setFirstName($prenom);
        $ownerEntity->setLastName($nom);
        $this->em->persist($ownerEntity);
        $this->em->flush();

        return $this->render('owner_by_criteria/index.html.twig', [
            'controller_name' => 'OwnerByCriteriaController',
        ]);
    }


    /**
     * @Route("/remove-owner/{logan}", name="remove_logan")
     * @param string $prenom
     * @return Response
     */
    public function removeAnimal(string $prenom)
    {
        $animalEntity = $this->animalRepository->find($prenom);
        $this->em->remove($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

}

