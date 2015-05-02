<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class CaseClass extends Model implements CaseInterface
{
    /**
     * Le nom de la table pour le modèle.
     *
     * @var string
     */
    protected $table = 'cases';

    /**
     * Récupère les cases voisines.
     *
     * @return Collection
     */
    public function getCasesVoisines()
    {
        return $this->casesVoisines;
    }

    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return int[]
     */
    public function getCasesVoisinesIds()
    {
        return $this->getCasesVoisines()->lists('id');
    }

    /**
     * Définit la relation avec les cases voisines.
     *
     * @return BelongsToMany
     */
    public function casesVoisines()
    {
        return $this->belongsToMany(self::class, 'cases_cases', 'case_parente', 'case_voisine');
    }

    /**
     * Définit la relation avec une armée.
     *
     * @return HasOne
     */
    public function armee()
    {
        return $this->hasOne(Armee::class, 'id_case', 'id');
    }

    /**
     * Récupère le joueur sur la case.
     *
     * @return Joueur
     */
    public function joueur()
    {
        $armee = $this->armee;

        // La case n'est occupée par aucune armée
        if (is_null($armee)) {
            return;
        }

        return $armee->proprietaire;
    }
}
