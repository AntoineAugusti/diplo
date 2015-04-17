<?php

namespace Diplo\Core;

use Diplo\Cartes\Carte;
use Diplo\Cartes\CaseInterface;
use Diplo\Joueurs\Joueur;

/**
 * Class Partie.
 */
class Partie
{
    /**
     * @var Carte
     */
    protected $carte;

    /**
     * @var Joueur[]
     */
    protected $joueurs;
    /**
     * @var int
     */
    protected $nbTours;
    /**
     * @var int
     */
    protected $tourCourant;

    /**
     * @param Joueur $joueur
     */
    public function ajouterJoueur(Joueur $joueur)
    {
    }

    /**
     * @param Joueur $joueur
     */
    public function supprimerJoueur(Joueur $joueur)
    {
    }

    /**
     * @return Joueur[]
     */
    public function getJoueurs()
    {
    }

    /**
     * @param Joueur $joueur
     *
     * @return int
     */
    public function getNbPointsDInteretsParJoueur(Joueur $joueur)
    {
    }

    /**
     * @param Joueur $joueur
     *
     * @return CaseInterface[]
     */
    public function getPointsDInteretsParJoueur(Joueur $joueur)
    {
    }

    /**
     * @return bool
     */
    public function tourEstAutomne()
    {
    }

    /**
     * @return bool
     */
    public function tourEstPrintemps()
    {
    }

    /**
     * @return bool
     */
    public function phaseEstNegociation()
    {
    }

    /**
     * @return bool
     */
    public function phaseEstCombat()
    {
    }
}
