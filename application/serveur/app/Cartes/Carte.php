<?php

namespace Diplo\Cartes;

use Diplo\Parties\Partie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carte extends Model
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
    protected $fillable = ['id_partie'];

    /**
     * Récupère l'ID de la carte.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit la relation avec la partie.
     *
     * @return BelongsTo
     */
    public function partie()
    {
        return $this->belongsTo(Partie::class, 'id_partie', 'id');
    }

    /**
     * Récupère la partie de la carte.
     *
     * @return Partie
     */
    public function getPartie()
    {
        return $this->partie;
    }

    /**
     * Définit la relation avec les cases.
     *
     * @return HasMany
     */
    public function cases()
    {
        return $this->hasMany(CaseClass::class, 'id_carte', 'id');
    }

    /**
     * Récupère les cases de la carte.
     *
     * @return CaseClass[]
     */
    public function getCases()
    {
        return $this->cases;
    }
}
