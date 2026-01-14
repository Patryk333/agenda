<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contacte;
use App\Entity\Comarca;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contactes', name: 'contacte_')]
class ContacteController extends AbstractController
{

    // Llista de contactes de mostra
    private $repositori;

    public function __construct(private EntityManagerInterface $gestor)
    {
        $this->repositori = $this->gestor->getRepository(Contacte::class);
    }

    // Métode 1
    #[Route('/{codi}', name: 'fitxa', methods: ['GET'], requirements: ['codi' => '\d+'])]
    public function fitxa(int $codi)
    {
        // 1) Buscar el contacte pel codi
        $contacte = $this->repositori->find($codi);

        if ($contacte)
            return $this->render('contacte/fitxa.html.twig', [
                'contacte' => $contacte,
                'codi' => $codi
            ]);
        else
            return $this->render('contacte/fitxa.html.twig', [
                'contacte' => null,
                'codi' => $codi
            ]);
    }

    #[Route('/crear', name: 'crear', methods: ['GET'])]
    public function afegir()
    {
        $comarca = new Comarca();
        $comarca->setNom("Ferland Mendy");

        $contacte = new Contacte();
        $contacte->setNom("Juan Cuesta");
        $contacte->setTelefon("659231544");
        $contacte->setEmail("juan@simarro.org");
        $contacte->setComarca($comarca);

        // Indiquem que volem guardar aquest objecte
        $this->gestor->persist($contacte);
        $this->gestor->persist($comarca);
        // S’executa la inserció
        $this->gestor->flush();

        return new Response("Contacte " . $contacte->getId() . " guardat.");
    }

    // Métode 2
    #[Route('/{text}', name: 'buscar', methods: ['GET'], requirements: ['text' => '[a-zA-Z]+'])]
    public function buscar(string $text): Response
    {
        // 1) Filtrar pel mètode creat al repositori
        $resultat = $this->repositori->findByName($text);

        // 2) Passar la llista (pot ser buida) a la vista
        return $this->render('contacte/cerca.html.twig', [
            'text' => $text,
            'resultats' => $resultat,
        ]);
    }


}