<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class CommercantsController extends AbstractController
{
    #[Route('/commercants', name: 'book_index_commercants')]
    public function index(ArticlesRepository $repo): Response
    {
        $articles = $repo->findAll();
        return $this->render('commercants/index.html.twig', [
            'articles' => $articles,
        ]);
    }


}