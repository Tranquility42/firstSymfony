<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


///**
//* @IsGranted("ROLE_ADMIN")
// */
class AdminAnimalController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * AdminAnimalController constructor.
     * @param EntityManagerInterface $em
     * @param AnimalRepository $animalRepository
     */
    public function __construct(EntityManagerInterface $em, AnimalRepository $animalRepository)
    {
        $this->em = $em;
        $this->animalRepository = $animalRepository;
    }


    /**
     * @Route("/admin/animal", name="admin_animal")
     */
    public function index(): Response
    {
        $hasAccess =$this->isGranted("ROLE_ADMIN");
        dump($hasAccess);
        return $this->render('admin_animal/index.html.twig', [
            'controller_name' => 'AdminAnimalController',
        ]);
    }

    /**
     * @Route("/admin/animal-create", name="admin_create_animal")
     * @param Request $request
     * @return Response
     */

    public function createAnimal(Request $request): Response
    {
        dump($request);

        $animalEntity = new Animal();
        $form = $this->createForm(AnimalType::class, $animalEntity);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $this->em->persist($animalEntity);
            $this->em->flush();
        }


        return $this->render('admin_animal/create.animal.html.twig', [
            'controller_name' => 'AdminAnimalController',
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/animal-edit/{id}", name="admin_edit_animal")
     * @param Request $request
     * @param $id
     * @return Response
     */


    public function editAnimal(Request $request, $id): Response
    {
        $animalEntity = $this->animalRepository->find($id);
        $form = $this->createForm(AnimalType::class, $animalEntity);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            dump($animalEntity);
            $this->em->persist($animalEntity);
            $this->em->flush();
        }


        return $this->render('admin_animal/create.animal.html.twig', [
            'form'=>$form->createView()
        ]);
    }




}
