<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VisiteursController extends AbstractController
{
    #[Route('/visiteurs', name: 'app_visiteurs')]
    public function index(): Response
    {
        return $this->render('visiteurs/index.html.twig', [
            'controller_name' => 'VisiteursController',
        ]);
    }
}
