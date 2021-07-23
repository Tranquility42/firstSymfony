<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingRepositoryController extends AbstractController

{
    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * TrainingRepositoryController constructor.
     * @param AnimalRepository $animalRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $em)
    {
        $this->animalRepository = $animalRepository;
        $this->em = $em;
    }




    /**
     * @Route("/training/repository", name="training_repository")
     */

//    #######  SELECT     #######
    public function index(): Response
    {
        $animalEntity= $this->animalRepository->find(2);
        dump($animalEntity);
        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }


    /**
     * @Route("/training/createAnimal", name="createAnimal")
     * @return Response
     */
    public function createAnimal()
    {
        $animalEntity = new Animal();
        $animalEntity->setNickName('loulou');
        $animalEntity->setType('loutre');
        $this->em->persist($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

    //    #######  UPDATE     #######

    /**
     * @Route("/training/updateAnimal", name="updateAnimal")
     * @param string $id
     * @return Response
     */
    public function updateAnimal(string $id)
    {
        $animalEntity = $this->animalRepository->find($id);
        dump($animalEntity);

        $animalEntity->setNickName('Paul');
        $this->em->persist($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

    //    #######  DELETE     #######

    /**
     * @Route("/remove-animal/{id}", name="remove_animal")
     * @param string $id
     * @return Response
     */
    public function removeAnimal(string $id)
    {
        $animalEntity = $this->animalRepository->find($id);
        $this->em->remove($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

}
