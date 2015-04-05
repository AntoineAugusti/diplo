<?php namespace Diplo\Core;

use Diplo\Cartes\Carte;
use Diplo\Cartes\CaseInterface;
use Diplo\Joueurs\Joueur;

/**
 * Class Partie
 * @package Diplo\Core
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
     * @var integer
     */
    protected $nbTours;
    /**
     * @var integer
     */
    protected $tourCourant;

    /**
     * @param Joueur $joueur
     * @return void
     */
    public function ajouterJoueur(Joueur $joueur) {

    }

    /**
     * @param Joueur $joueur
     * @return void
     */
    public function supprimerJoueur(Joueur $joueur) {

    }

    /**
     * @return Joueur[]
     */
    public function getJoueurs() {

    }

    /**
     * @param Joueur $joueur
     * @return integer
     */
    public function getNbPointsDInteretsParJoueur(Joueur $joueur) {

    }

    /**
     * @param Joueur $joueur
     * @return CaseInterface[]
     */
    public function getPointsDInteretsParJoueur(Joueur $joueur) {

    }

    /**
     * @return boolean
     */
    public function tourEstAutomne() {

    }

    /**
     * @return boolean
     */
    public function tourEstPrintemps() {

    }

    /**
     * @return boolean
     */
    public function phaseEstNegociation() {

    }

    /**
     * @return boolean
     */
    public function phaseEstCombat() {

    }
}
