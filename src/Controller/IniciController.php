<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IniciController
{
    #[Route('/', name: 'inici', methods: ['GET'])]
    public function inici(): Response
    {
        return new Response('Benvingut/da al web de contactes');
    }
}
?>