<?php

namespace Projets\diplo\application\serveur\app\Joueurs;

/**
 * Class Joueur
 */
class Joueur
{
    /**
     * Liste des armées que le joueur possède
     *
     * @var List<Armee>
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
     * @return void
     */
    public function ajouterArmee(Armee a)
    {
    }

    /**
     * @return void
     */
    public function supprimerArmee(Armee a)
    {
    }

    /**
     * @return List<Armee>
     */
    public function getArmee()
    {
        return $armees;
    }

    /**
     * @return void
     */
    public function donnerOrdre(Armee a, Ordre o)
    {
        // TODO
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $nom;
    }


    /**
     * @return List<PointDInterets>
     */
    public function getPointsDInterets()
    {
    }

    /**
     * @return integer
     */
    public function getNbPoinsDInterets()
    {
        return 0;
    }

    /**
     * @return List<CaseInterface>
     */
    public function getCasesControlees()
    {
        // TODO
        return null;
    }

    /**
     * @return void
     */
    public function rejoindrePartie(Partie p)
    {
    }

    /**
     * @return void
     */
    public function quitterPartie()
    {
    }

}
