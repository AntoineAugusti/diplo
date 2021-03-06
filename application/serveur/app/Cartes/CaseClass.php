<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CaseClass extends Model implements CaseInterface
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
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
    protected $appends = ['est_libre', 'est_occupee', 'id_armee', 'id_cases_voisines'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['id_carte', 'armee', 'joueur', 'created_at', 'updated_at'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_joueur' => 'integer',
    ];

    /**
     * Récupère l'ID de la case.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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
        return is_null($this->getJoueur());
    }

    /**
     * Indique si une case est occupée par une armée.
     *
     * @return bool
     */
    public function getEstOccupeeAttribute()
    {
        return !is_null($this->getArmee());
    }

    /**
     * Retourne l'identifiant de l'armée si la case est occupée ou null sinon.
     *
     * @return int|null
     */
    public function getIdArmeeAttribute()
    {
        $armee = $this->getArmee();
        if (is_null($armee)) {
            return null;
        }

        return (int) $armee->getId();
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
     * @return CaseInterface[]
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
        $casesVoisines = CaseVoisine::where('case_parente', $this->id)
            ->lists('case_voisine');

        return array_map(function ($x) {
            return intval($x);
        }, $casesVoisines);
    }

    /**
     * Définit les identifiants des cases voisines.
     *
     * @param int[] $ids
     */
    public function setCasesVoisinesIds(array $ids)
    {
        $this->casesVoisines()->sync($ids);
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
     * Récupère l'armée sur la case.
     *
     * @return Armee
     */
    public function getArmee()
    {
        return $this->armee;
    }

    /**
     * Définit le joueur possèdant la case.
     *
     * @param Joueur $joueur
     */
    public function setJoueur(Joueur $joueur)
    {
        $this->id_joueur = $joueur->getId();
    }

    /**
     * Récupère le joueur possèdant la case.
     *
     * @return Joueur | null
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Définit la relation avec le joueur possèdant la case.
     *
     * @return Joueur|null
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * La case est-elle occupée par une armée ?
     *
     * @return bool
     */
    public function estOccupee()
    {
        return $this->est_occupee;
    }
}
