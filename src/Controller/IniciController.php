<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IniciController extends AbstractController
{
    #[Route('/', name: 'inici', methods: ['GET'])]
    public function inici(): Response
    {
        return $this->render('inici.html.twig');
    }
    
}

?>