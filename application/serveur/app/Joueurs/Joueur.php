<?php

namespace Diplo\Joueurs;

use Eloquent;

class Joueur extends Eloquent
{
    protected $fillable = ['pseudo', 'pays'];

    /**
     * Le pseudo du joueur.
     *
     * @return string
     */
    private function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Le pays du joueur au format ISO 3166-1 alpha-3.
     *
     * @return string
     */
    private function getPays()
    {
        return $this->pays;
    }
}
