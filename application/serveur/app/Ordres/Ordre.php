<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;

abstract class Ordre
{
    public static $typeAcceptes = ['Attaquer', 'SoutienOffensif', 'SoutienDefensif', 'Tenir'];

    private $joueur;

    private $armee;

    public function setJoueur(Joueur $j)
    {
        $this->joueur = $j;
    }

    public function setArmee(Armee $a)
    {
        $this->armee = $a;
    }

    public function getArmee()
    {
        return $this->armee;
    }

    public function getJoueur()
    {
        return $this->joueur;
    }
}
