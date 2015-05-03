<?php

namespace Diplo\Armees;

use Diplo\Cartes\CaseClass;
use Diplo\Joueurs\Joueur;
use Diplo\Ordres\Ordre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Armee extends Model
{
    /**
     * Récupère le joueur propriétaire d'une armée.
     *
     * @return Relation
     */
    public function proprietaire()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * Récupère la case sur laquelle se trouve une armée.
     *
     * @return Relation
     */
    public function caseOccupee()
    {
        return $this->hasOne(CaseClass::class, 'id_case', 'id');
    }

    /**
     * Le propriétaire de l'armée.
     *
     * @return \Diplo\Joueurs\Joueur
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * La case occupée par une armée.
     */
    public function getCase()
    {
        return $this->caseOccupee;
    }

    /**
     * L'ordre donné à l'armée.
     *
     * @return Ordre
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
