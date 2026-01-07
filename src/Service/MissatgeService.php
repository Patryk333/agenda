<?php

namespace App\Service;

class MissatgeService
{
    public function obtindreSalutacio(string $nom): string
    {
        return "Hola, $nom! Benvingut a Symfony 🚀";
    }
}

?>