<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IniciController extends AbstractController
{
    public function __construct(private LoggerInterface $logger) {

    }

    #[Route('/', name: 'inici')]
    public function inici(): Response
    {
        $dataHora = new \DateTime();
        $this->logger->info("Accés el " . $dataHora->format("d/m/Y H:i:s"));
        return $this->render('inici.html.twig');
    }
}

?>