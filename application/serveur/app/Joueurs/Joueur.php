<?php

namespace Diplo\Joueurs;

use Eloquent;
use Diplo\Parties\Partie;

class Joueur extends Eloquent
{
    protected $fillable = ['pseudo', 'pays'];

    /**
     * Récupère la partie d'un joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function partie()
    {
        return $this->belongsTo(Partie::class, 'id_partie', 'id');
    }

    /**
     * Le pseudo du joueur.
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Le pays du joueur au format ISO 3166-1 alpha-3.
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }
}
