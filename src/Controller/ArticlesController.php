<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articles;
use App\Form\ArticleType;
use App\Repository\ArticlesRepository;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function list(ArticlesRepository $repo): Response
    {
        $articles = $repo->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    #[Route('/articles/category/{category}', name: 'app_articles_category')]
    public function liste(ArticlesRepository $repo, string $category): Response
    {
        $articles = $repo->findByCategorie($category);
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/new', name: 'article_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            //enregistre dans doctrine
            $entityManager->flush();
            //insere à la bdd

            return $this->redirectToRoute('app_articles');
        }

        return $this->render('articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/articles/delet/{id}', name: 'article_delet')]
    public function delet(Articles $article, EntityManagerInterface $entityManager): Response
    
    {
        try {
            $entityManager->remove($article);
            $entityManager->flush();            
        } catch(Exception $e) {
        throw $this->createNotFoundException('The page you are looking for does not exist.');
        }

        return $this->redirectToRoute('app_articles');
    }

}


// ! si je crée un lien qui rnvoi vers '/articles/delet/{id}' alors je supprime cet article