<?php

namespace Projets\diplo\application\serveur\app\Cartes;

/**
 * Classe qui gère la carte du jeu d'une partie
 */
class Carte
{
    /**
     * Contient l'ensemble des cases d'une carte
     *
     * @var List<CaseInterface> cases
     */
    private $cases;

    public function __construct($options)
    {
        // TODO ! 
        // code
    }

    /**
     * Retourne le nombre de points d'interets pour un joueur
     *
     * @var Joueur j : Le joueur concerné
     * @return integer : Le nombre de points d'interets du joueur
     */
    public function getNbPointsDInteretsParJoueur(Joueur $j)
    {
        // TODO
        return 0;
    }

    /**
     * Retourne les points d'interets pour un joueur
     *
     * @var Joueur j : Le joueur concerné
     * @return List<PointDInteret> : Les points d'interets du joueur
     */
    public function getPointsDInteretParJoueur(Joueur j)
    {
        // TODO
        return 0;
    }

    /**
     * Retourne le nombre de cases possédées par un joueur
     *
     * @var Joueur j : Le joueur concerné
     * @return integer 
     */
    public function getNbCasesParJoueur(Joueur j)
    {
        return null;
    }

    /**
     * Retourne les cases possédées par un joueur
     * @var le joueur concerné
     * @return List<CaseInterface>
     */
    public function getCasesParJoueur(Joueur j)
    {
        // TODO
        return null;
    }


    /**
     * Retourne le nombre de point d'interets sur la carte
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
        // TODO
        return 0;
    }


    /**
     * Retourne les cases de la cartes
     *
     * @return integer
     */
    public function getCases()
    {
        return 0;
    }

}
