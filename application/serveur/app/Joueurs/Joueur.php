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
     * Liste des armées que le joueur possède
     *
     * @var Armee[]
     */
    private $armees;

    /**
     * Le nom du joueur
     *
     * @var string
     */
    private $nom;

    /**
     * La partie dans laquelle est le joueur
     *
     * @var Partie
     */
    private $partie;

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
    public function getNom()
    {
        return $nom;
    }

    /**
     * @return CaseInterface[]
     */
    public function getPointsDInterets() {

    }

    /**
     * @return integer
     */
    public function getNbPoinsDInterets()
    {
        return 0;
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
    public function quitterPartie()
    {
    }

}
