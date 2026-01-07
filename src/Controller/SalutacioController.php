<?php

namespace App\Controller;

use App\Service\MissatgeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SalutacioController extends AbstractController
{

    public function __construct(private MissatgeService $missatgeService) {

    }

    #[Route('/salutacio', name: 'salutacio')]
    public function inici(): Response
    {
        $text = $this ->missatgeService->obtindreSalutacio('Patryk');
        return new Response($text);
    }
    
}

?>