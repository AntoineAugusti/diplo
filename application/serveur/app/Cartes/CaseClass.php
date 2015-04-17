<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;

class CaseClass implements CaseInterface
{
    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return array
     */
    public function getCasesVoisinesIds()
    {
        return $this->casesVoisines()->lists('id');
    }

    /**
     * Récupère les cases voisines.
     *
     * @return \Illuminate\Support\Collection
     */
    public function casesVoisines()
    {
        return $this->belongsToMany(self::class, 'cases_cases', 'case_parente', 'case_voisine');
    }

    /**
     * Récupère la case sur laquelle se trouve une armée.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function armee()
    {
        return $this->hasOne(Armee::class, 'id_armee', 'id');
    }

    /**
     * Récupère le joueur sur la case.
     *
     * @return \Diplo\Joueurs\Joueur
     */
    public function joueur()
    {
        $armee = $this->armee();

        // La case n'est occupée par aucune armée
        if (is_null($armee)) {
            return;
        }

        return $armee->proprietaire;
    }
}
