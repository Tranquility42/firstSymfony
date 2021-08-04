<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\OwnerRepository;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var OwnerRepository
     */
    private $ownerRepository;

    /**
     * HomeController constructor.
     * @param AnimalRepository $animalRepository
     * @param PostRepository $postRepository
     * @param OwnerRepository $ownerRepository
     */
    public function __construct(AnimalRepository $animalRepository, PostRepository $postRepository, OwnerRepository $ownerRepository)
    {
        $this->animalRepository = $animalRepository;
        $this->postRepository = $postRepository;
        $this->ownerRepository = $ownerRepository;
    }


    /**
     * @Route("/home", name="home")
     */

    public function index(): Response
    {

//        $entities = $this->animalRepository->findByTypeAndNickName('chien', 'rex');
//        dump($entities);
//
//        $animalByOwner = $this->animalRepository->findByOwnerFirstName('youb');
//        dump($animalByOwner);
//
//        $dateMin = new \DateTime('2020-04-01');
//        $dateMax = new \DateTime('2022-04-01');
//        $postEntities = $this->postRepository->getPostsBetweenTwoDates($dateMin,$dateMax);
//        dump($postEntities);
//
//        $animalWithNoOwner = $this->animalRepository->getAnimalWithNoOwner();
//        dump($animalWithNoOwner);



        $ownerEntity = $this->ownerRepository->find(1);
        dump($ownerEntity);

        $postEntities = $this->postRepository->getAllPosts();
        dump($postEntities);

        $animals = $this->animalRepository->animalsByOwner($ownerEntity);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/animal_list", name="animal-list")
     */
    public function animalList(PaginatorInterface $paginator, Request $request)
    {
        $qb = $this->animalRepository->getQbAll();

        $pagination = $paginator->paginate(
            $qb,/* query NOT result */
            $request->query->getInt('page',1), /*page number */
            5 /* limit per page */
        ) ;
        return $this->render('home/animal_list.html.twig',[
            'pagination'=>$pagination
        ]);
    }


    /**
     * @Route("/test-test-ajax", name="test_test_ajax")
     */
    public function testTestAjax(PaginatorInterface $paginator, Request $request)
    {
        $qb =$this->animalRepository->getQbAll();
        $pagination = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            5
        );

        $html = $this->renderView('partial/cards-animals.html.twig',[
           'pagination' => $pagination
        ]);



        $response = new JsonResponse();
        $response->setData([
            'html' => $html
        ]);
        return $response;
    }

}
