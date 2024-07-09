<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ArticleRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/order/add/article/{id}', name: 'order_add_article')]
    public function index(
        int $id,
        ArticleRepository $articleRepository,
        OrderRepository $orderRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException("Cet article n'existe pas");
        }
        // TODO: 'user' => $this->getUser()
        $panier = $orderRepository->findOneBy(['cart' => true]);
        if (!$panier) {
            $panier = new Order();
            $panier->setCart(true);
        }
        $panier->addArticle($article);
        $entityManager->persist($panier);
        $entityManager->flush();

            $order = new Order();
            $entityManager->persist($order);
            //enregistre dans doctrine
            $entityManager->flush();
            //insere à la bdd
        return $this->render('commandes/index.html.twig', [
            'articles' => $article,
            'orders' => $order,
        ]);
    }

    
     #[Route('/displaypanier', name: 'displaypanier')]
     public function displaypanier(
          OrderRepository $orderRepository,
      ): Response {

        
           $panier = $orderRepository->findAll();

          return $this->render('commandes/panier.html.twig', [
              'panier' => $panier,
          ]);
      }
}
