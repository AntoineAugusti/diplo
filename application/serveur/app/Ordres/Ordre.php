<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;

abstract class Ordre
{
    /**
     * @var array
     */
    public static $typeAcceptes = ['Tenir', 'Attaquer', 'SoutienDefensif', 'SoutienOffensif'];

    /**
     * @var Joueur
     */
    protected $joueur;

    /**
     * @var Armee
     */
    protected $armee;

    /**
     * Définit le joueur passant l'ordre.
     *
     * @param Joueur $joueur
     */
    public function setJoueur(Joueur $joueur)
    {
        $this->joueur = $joueur;
    }

    /**
     * Définit l'armée concernée par l'ordre.
     *
     * @param Armee $armee
     */
    public function setArmee(Armee $armee)
    {
        $this->armee = $armee;
    }

    /**
     * Récupère l'armée concernée par l'ordre.
     *
     * @return Armee
     */
    public function getArmee()
    {
        return $this->armee;
    }

    /**
     * Récupère le joueur passant l'ordre.
     *
     * @return Joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Présente les ordres qu'il est possible de donner.
     *
     * @return string
     */
    public static function presenteOrdresPossibles()
    {
        return implode(', ', self::$typeAcceptes);
    }
}
