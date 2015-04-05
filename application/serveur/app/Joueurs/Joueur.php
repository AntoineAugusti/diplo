<?php namespace Diplo\Joueurs;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseInterface;
use Diplo\Core\Partie;
use Diplo\Ordres\Ordre;

/**
 * Class Joueur
 * @package Diplo\Joueurs
 */
class Joueur
{
    /**
     * @var Armee[]
     */
    protected $armees;

    /**
     * @var string
     */
    protected $nom;

    /**
     * @var Partie
     */
    protected $partie;

    /**
     * @param Armee $armee
     * @return void
     */
    public function ajouterArmee(Armee $armee) {

    }

    /**
     * @param Armee $armee
     * @return void
     */
    public function supprimerArmee(Armee $armee) {

    }

    /**
     * @return Armee[]
     */
    public function getArmees() {

    }

    /**
     * @param Armee $armee
     * @param Ordre $ordre
     * @return void
     */
    public function donnerOrdre(Armee $armee, Ordre $ordre) {

    }

    /**
     * @return string
     */
    public function getNom() {

    }

    /**
     * @return CaseInterface[]
     */
    public function getPointsDInterets() {

    }

    /**
     * @return integer
     */
    public function getNbPointsDInterets() {

    }

    /**
     * @return CaseInterface[]
     */
    public function getCasesControlees() {

    }

    /**
     * @param Partie $partie
     * @return void
     */
    public function rejoindrePartie(Partie $partie) {

    }

    /**
     * @return void
     */
    public function quitterPartie() {

    }
}
