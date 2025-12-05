<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Definir una ruta base i nom (prefix) a nivell de controlador
#[Route('/contactes', name: 'contacte_')]
class ContacteController
{
    // Llista de contactes de mostra
    private $contactes = [
        ["codi" => 1, "nom" => "Salvador Sala", 
         "telefon" => "638961244", "email" => "salvasala@simarro.org"],
        ["codi" => 2, "nom" => "Anna Llopis", 
         "telefon" => "669332004", "email" => "annallopis@simarro.org"],
        ["codi" => 3, "nom" => "Marc Sanchis", 
         "telefon" => "962286040", "email" => "marcsanchis@simarro.org"],
        ["codi" => 4, "nom" => "Laura Palop", 
         "telefon" => "663568890", "email" => "laurapalop@simarro.org"],
    ];

    // Métode 1: Mostrar la fitxa d'un contacte pel seu codi
    // Cada mètode defineix la seua ruta relativa i el seu mètode HTTP
    #[Route('/{codi}', name:'fitxa', methods: ['GET'], requirements: ['codi' => '\d+'])]
    public function fitxa(int $codi): Response
    {
        $resultat = array_filter($this->contactes, 
            function($contacte) use ($codi){
                return $contacte['codi'] == $codi;
            }
        );

        if (!$resultat) 
            return new Response('Contacte no trobat');

        // Torna 1r element
        $contacte = array_shift($resultat);
        $resp = "<ul>
                    <li>{$contacte['nom']}</li>
                    <li>{$contacte['telefon']}</li>
                    <li>{$contacte['email']}</li>
                </ul>";

        return new Response("<html><body>$resp</body></html>");
    }


    // Métode 2: Buscar contactes pel seu nom
    // Mateixa ruta /contacte/{text}, però amb requirement diferent (només lletres)
    #[Route('/{text}', name: 'buscar', methods: ['GET'], requirements: ['text' => '[a-zA-Z]+'])]
    public function buscar(string $text): Response
    {
        $resultat = array_filter($this->contactes, 
            function($contacte) use ($text) {
                return stripos($contacte["nom"], $text) !== false;
            }
        );

        if (!$resultat) 
            return new Response("No s'han trobat contactes amb '$text'.");


        $resposta = "<h2>Resultats de la cerca: '$text'</h2>";
        foreach ($resultat as $contacte) {
            $resposta .= "<ul>
                            <li>{$contacte['nom']}</li>
                            <li>{$contacte['telefon']}</li>
                            <li>{$contacte['email']}</li>
                          </ul>";
        }

        return new Response("<html><body>$resposta</body></html>");

    }
}
?>