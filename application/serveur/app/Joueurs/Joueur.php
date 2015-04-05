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
    public function ajouterArmee(Armee $armee) 
    {

        array_push($this->cases, $armee);

    }

    /**
     * @param Armee $armee
     * @return void
     */
    public function supprimerArmee(Armee $armee) 
    {


    }

    /**
     * @return Armee[]
     */
    public function getArmees() 
    {

        return $this->armee;
    }

    /**
     * @param Armee $armee
     * @param Ordre $ordre
     * @return void
     */
    public function donnerOrdre(Armee $armee, Ordre $ordre)
    {

        $armee->setOrdre($ordre);
        $ordre->setArmee($armee);

    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $nom;
    }

    /**
     * Non implementée
     *
     * @return CaseInterface[]
     */
    public function getPointsDInterets() 
    {

        return null;
    }

    /**
     * Non implementée
     *
     * @return integer
     */
    public function getNbPoinsDInterets()
    {
        return 0;
    }

    /**
     * @return CaseInterface[]
     */
    public function getCasesControlees()
    {

        $cases = array();

        foreach ($this->armees as $armee)
        {

            array_push($cases, $armee->getCase());

        }

        return $cases;
    }

    /**
     * @param Partie $partie
     * @return void
     */
    public function rejoindrePartie(Partie $partie)
    {

        $this.partie = $partie;
    }

    /**
     * @return void
     */
    public function quitterPartie()
    {

    }

}
