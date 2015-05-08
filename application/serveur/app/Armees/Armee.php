<?php

namespace Diplo\Armees;

use Diplo\Cartes\CaseClass;
use Diplo\Cartes\CaseInterface;
use Diplo\Joueurs\Joueur;
use Diplo\Ordres\Ordre;
use Diplo\Ordres\OrdreModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;

class Armee extends Model
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
    protected $fillable = ['id_case'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'id_partie'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'id_case'   => 'integer',
        'id_joueur' => 'integer',
    ];

    /**
     * Récupère l'ID de l'armée.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit la relation avec le propriétaire d'une armée.
     *
     * @return BelongsTo
     */
    public function proprietaire()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * Récupère le propriétaire de l'armée.
     *
     * @return Joueur
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * Récupère le propriétaire de l'armée (alias).
     *
     * @return Joueur
     */
    public function getJoueur()
    {
        return $this->getProprietaire();
    }

    /**
     * Définit la relation avec la case qu'occupe l'armée.
     *
     * @return HasOne
     */
    public function caseOccupee()
    {
        return $this->hasOne(CaseClass::class, 'id_case', 'id');
    }

    /**
     * Définit la case sur laquelle se trouve une armée.
     *
     * @param CaseInterface $case
     */
    public function setCase(CaseInterface $case)
    {
        $this->id_case = $case->getId();
    }

    /**
     * Récupère la case sur laquelle se trouve une armée.
     *
     * @return CaseClass
     */
    public function getCase()
    {
        return $this->caseOccupee;
    }

    /**
     * Définit la relation avec les ordres passés.
     *
     * @return HasMany
     */
    public function ordres()
    {
        return $this->hasMany(OrdreModel::class, 'id_armee', 'id');
    }

    /**
     * Récupère tous les ordres passés à une armée.
     *
     * @return OrdreModel[]
     */
    public function getOrdres()
    {
        return $this->ordres;
    }

    /**
     * Définit la relation avec le dernier ordre passé.
     *
     * @return HasOne
     */
    public function ordre()
    {
        return $this->hasOne(OrdreModel::class, 'id_armee', 'id')
            ->where('execute', false)
            ->latest();
    }

    /**
     * Récupère le dernier ordre passé à l'armée.
     *
     * @return OrdreModel
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
