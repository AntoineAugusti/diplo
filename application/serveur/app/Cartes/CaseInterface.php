<?php

namespace Diplo\Cartes;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

interface CaseInterface
{
    /**
     * Récupère les cases voisines.
     *
     * @return Collection
     */
    public function getCasesVoisines();

    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return int[]
     */
    public function getCasesVoisinesIds();

    /**
     * Définit la relation avec les cases voisines..
     *
     * @return BelongsToMany
     */
    public function casesVoisines();

    /**
     * Définit la relation avec une armée.
     *
     * @return HasOne
     */
    public function armee();

    /**
     * Récupère le joueur sur la case.
     *
     * @return Joueur
     */
    public function joueur();
}
