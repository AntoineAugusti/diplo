<?php namespace Diplo\Cartes;

/**
 * Classe qui gère la carte du jeu d'une partie
 */
class Carte
{
    /**
     * Contient l'ensemble des cases d'une carte
     *
     * @var CaseInterface[] cases
     */
    private $cases;

    public function __construct($options)
    {
        $this->cases = array(); 
    }

    /**
     * Retourne le nombre de points d'interets pour un joueur
     *
     * Non implémentée
     *
     * @var Joueur j : Le joueur concerné
     * @return integer : Le nombre de points d'interets du joueur
     */
    public function getNbPointsDInteretsParJoueur(Joueur $j)
    {
        return null;
    }

    /**
     * Retourne les points d'interets pour un joueur
     *
     * Non implémentée
     *
     * @var Joueur j : Le joueur concerné
     * @return PointDInteret[] : Les points d'interets du joueur
     */
    public function getPointsDInteretParJoueur(Joueur $j)
    {
        
        return null;
    }

    /**
     * Retourne le nombre de cases possédées par un joueur
     *
     * @var Joueur j : Le joueur concerné
     * @return integer 
     */
    public function getNbCasesParJoueur(Joueur $j)
    {
        $counter = 0;

        foreach ($this->cases as $case)
        {

            if ($case.proprietaire == $j) 
            {
                $counter++;
            }
            
        }
        return $counter;
    }

    /**
     * Retourne les cases possédées par un joueur
     * @var le joueur concerné
     * @return List<CaseInterface>
     */
    public function getCasesParJoueur(Joueur $j)
    {
        $cases = array();

        foreach ($this->cases as $case) 
        {
            if ($case.proprietaire == $j) 
            {
                array_pus($cases, $case);
            }
            
        }

        return $cases;
    }


    /**
     * Retourne le nombre de point d'interets sur la carte
     *
     * Non implementée
     *
     * @return integer
     */
    public function getNbPointDInteret()
    {
        return  0;
    }

    /**
     * Retourne le nombre de cases sur la carte
     *
     * @return integer
     */
    public function getNbCases()
    {
        return count($this->cases);
    }


    /**
     * Retourne les cases de la cartes
     *
     * @return integer
     */
    public function getCases()
    {
        return $this->cases;
    }

}
