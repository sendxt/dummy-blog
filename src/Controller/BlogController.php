<?php

namespace App\Controller;

use App\Fetcher\BlogPostFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    public function __construct(private BlogPostFetcher $blogPostFetcher){}

    #[Route('/blog', name: 'blog_index')]
    public function index(): Response
    {
        //TODO: cache
        return $this->render(
            'blog/index.html.twig',
            [
                'posts' => $this->blogPostFetcher->fetchPosts()->getPosts()
            ]
        );
    }
}
