<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;

interface CaseInterface
{
    /**
     * Récupère l'ID de la case.
     *
     * @return int
     */
    public function getId();

    /**
     * Récupère l'armée sur la case.
     *
     * @return Armee
     */
    public function getArmee();

    /**
     * Pose une armée sur une case.
     *
     * @param Armee $armee
     */
    public function setArmee(Armee $armee);

    /**
     * Récupère les cases voisines.
     *
     * @return CaseInterface[]
     */
    public function getCasesVoisines();

    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return int[]
     */
    public function getCasesVoisinesIds();

    /**
     * Récupère le joueur sur la case.
     *
     * @return Joueur | null
     */
    public function getJoueur();

    /**
     * La case est-elle occupée par une armée ?
     *
     * @return bool
     */
    public function estOccupee();
}
