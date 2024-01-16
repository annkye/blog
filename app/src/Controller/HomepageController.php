<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $posts = $this->postRepository->getRecentPosts();

        return $this->render('homepage/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
