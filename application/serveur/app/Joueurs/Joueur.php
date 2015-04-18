<?php

namespace Diplo\Joueurs;

use Eloquent;
use Diplo\Parties\Partie;

class Joueur extends Eloquent
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
    protected $fillable = ['pseudo', 'pays'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Les attributs à rajouter au modèle.
     *
     * @var array
     */
    protected $appends = ['armees_restantes', 'cases_controlees'];

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

    /**
     * Retourne le nombre d'armées possédées par le joueur.
     *
     * @return int
     */
    public function getArmeesRestantesAttribute()
    {
        // TODO
        return 0;
    }

    /**
     * Retourne le nombre de cases contrôlées par le joueur.
     *
     * @return int
     */
    public function getCasesControleesAttribute()
    {
        // TODO
        return 0;
    }
}
