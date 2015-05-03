<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class CaseClass extends Model implements CaseInterface
{
    protected $fillable = ['id_carte'];

    /**
     * Le nom de la table pour le modèle.
     *
     * @var string
     */
    protected $table = 'cases';

    /**
     * Les attributs à rajouter au modèle.
     *
     * @var array
     */
    protected $appends = ['est_libre', 'id_joueur', 'est_occupee', 'id_armee'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['id_carte', 'armee', 'created_at', 'updated_at'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Définit la relation avec une carte.
     *
     * @return BelongsTo
     */
    public function carte()
    {
        return $this->belongsTo(Carte::class, 'id_carte', 'id');
    }

    /**
     * Récupère la carte d'une case.
     *
     * @return Carte
     */
    public function getCarte()
    {
        return $this->carte;
    }

    /**
     * Indique si une case est possédée par un joueur.
     *
     * @return bool
     */
    public function getEstLibreAttribute()
    {
        return is_null($this->joueur());
    }

    /**
     * Retourne l'identifiant du joueur possédant la case ou null si elle n'est pas possédée.
     *
     * @return int|null
     */
    public function getIdJoueurAttribute()
    {
        $joueur = $this->joueur();
        if (is_null($joueur)) {
            return;
        }

        return $joueur->id;
    }

    /**
     * Indique si une case est occupée par une armée.
     *
     * @return bool
     */
    public function getEstOccupeeAttribute()
    {
        return !is_null($this->armee);
    }

    /**
     * Retourne l'identifiant de l'armée si la case est occupée ou null sinon.
     *
     * @return int|null
     */
    public function getIdArmeeAttribute()
    {
        $armee = $this->armee;
        if (is_null($armee)) {
            return;
        }

        return (int) $armee->id;
    }

    /**
     * Récupère les identifiants des cases voisines.
     *
     * @return int[]
     */
    public function getIdCasesVoisinesAttribute()
    {
        return $this->getCasesVoisinesIds();
    }

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
