<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmController extends AbstractController
{
    #[Route(path: '/farm', name: 'farm')]
    public function index(): Response
    {
        return $this->render('farm/index.html.twig');
    }
}
