<?php

namespace App\Controller;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @var postRepository
     */
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(postRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/post/list", name="post_list")
     */


    public function index(): Response
    {
        $posts = $this->postRepository->findAll();
        dump($posts);

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'posts'=>$posts,
        ]);
    }

}
