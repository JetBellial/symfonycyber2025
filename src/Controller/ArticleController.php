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
    
    //Méthode pour afficher tous les articles
    #[Route('/article/all', name: 'app_articles')]
    public function showAll(): Response
    {
        return $this->render('article/articles.html.twig', [
            'articles' => $this->repo->findAll()
        ]);
    }

    //Méthode pour afficher un article par son id
    #[Route('/article/{id}', name:'app_article_id')]
    public function showArticle(int $id): Response 
    {
        return $this->render('article/article.html.twig', [
            'article'=> $this->repo->find($id)
        ]);
    }
}
