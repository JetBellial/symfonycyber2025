<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $repo,
        private readonly EntityManagerInterface $em
    ) {}
    
    //Méthode pour afficher tous les articles
    #[Route('/article/all', name: 'app_article_all')]
    public function showAll(): Response
    {
        return $this->render('article/articles.html.twig', [
            'articles' => $this->repo->findAll()
        ]);
    }

    //Méthode pour afficher un article par son id
    #[Route('/article/{id}', name:'app_article_id', requirements: ['id' => '\d+'])]
    public function showArticleById(int $id): Response 
    {
        return $this->render('article/article.html.twig', [
            'article'=> $this->repo->find($id)
        ]);
    }

    //Méthode qui ajoute un article en BDD
    #[Route('/article/add', name:'app_article_add')]
    public function addArticle(Request $request) : Response
    {
        return $this->render('article/articleAdd.html.twig',
        [
            'formulaire' =>''
        ]);
    }
}
