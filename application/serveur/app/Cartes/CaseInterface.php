<?php

namespace Diplo\Cartes;

interface CaseInterface
{
    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return array
     */
    public function getCasesVoisinesIds();

    /**
     * Récupère les cases voisines.
     *
     * @return \Illuminate\Support\Collection
     */
    public function casesVoisines();

    /**
     * Récupère la case sur laquelle se trouve une armée.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function armee();

    /**
     * Récupère le joueur sur la case.
     *
     * @return \Diplo\Joueurs\Joueur
     */
    public function joueur();
}
