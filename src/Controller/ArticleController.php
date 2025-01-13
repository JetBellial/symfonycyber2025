<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $repo
    ) {}

    #[Route('/articles', name: 'app_articles')]
    public function showAll(): Response
    {
        return $this->render('article/articles.html.twig', [
            'articles' => $this->repo->findAll()
        ]);
    }
}
