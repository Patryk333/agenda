<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Definir una ruta base i nom (prefix) a nivell de controlador
#[Route('/contactes', name: 'contacte_')]
class ContacteController extends AbstractController
{
    // Llista de contactes de mostra
    private array $contactes = [
        ["codi" => 1, "nom" => "Salvador Sala",
         "telefon" => "638961244", "email" => "salvasala@simarro.org"],
        ["codi" => 2, "nom" => "Anna Llopis",
         "telefon" => "669332004", "email" => "annallopis@simarro.org"],
        ["codi" => 3, "nom" => "Marc Sanchis",
         "telefon" => "962286040", "email" => "marcsanchis@simarro.org"],
        ["codi" => 4, "nom" => "Laura Palop",
         "telefon" => "663568890", "email" => "laurapalop@simarro.org"],
    ];

    // Métode 1
    #[Route('/{codi}', name:'fitxa', methods: ['GET'], requirements: ['codi' => '\d+'])]
    public function fitxa(int $codi): Response
    {
        // 1) Buscar el contacte pel codi
        $resultat = array_filter($this->contactes, fn($c) => $c['codi'] === $codi);

        if (!$resultat) {
            // En un cas real, podríem llançar una 404 o mostrar una vista d’error
            return $this->render('contacte/fitxa.html.twig', [
                'contacte' => null,
                'codi' => $codi,
            ]);
        }

        $contacte = array_shift($resultat);

        // 2) Passar dades a la plantilla Twig
        return $this->render('contacte/fitxa.html.twig', [
            'contacte' => $contacte,
            'codi' => $codi,
        ]);
    }

    // Métode 2
    #[Route('/{text}', name: 'buscar', methods: ['GET'], requirements: ['text' => '[a-zA-Z]+'])]
    public function buscar(string $text): Response
    {
        // 1) Filtrar per nom (coincidència parcial, sense tindre en compte maj./min.)
        $resultat = array_filter($this->contactes, function ($c) use ($text) {
            return stripos($c['nom'], $text) !== false;
        });

        // 2) Passar la llista (pot ser buida) a la vista
        return $this->render('contacte/cerca.html.twig', [
            'text' => $text,
            'resultats' => $resultat,
        ]);
    }
}