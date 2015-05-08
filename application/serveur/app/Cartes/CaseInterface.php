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
     * Définit les identifiants des cases voisines.
     *
     * @param int[] $ids
     */
    public function setCasesVoisinesIds(array $ids);

    /**
     * Définit le joueur possèdant la case.
     *
     * @param Joueur $joueur
     */
    public function setJoueur(Joueur $joueur);

    /**
     * Récupère le joueur possèdant la case.
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
