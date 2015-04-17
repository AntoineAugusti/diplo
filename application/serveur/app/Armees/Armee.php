<?php

namespace Diplo\Armees;

use Eloquent;

class Armee extends Eloquent
{
    /**
     * Récupère le joueur propriétaire d'une armée.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function proprietaire()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * Récupère la case sur laquelle se trouve une armée.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
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
     *
     * @return null|Diplo\Cartes\CaseInterface
     */
    public function getCase()
    {
        return $this->caseOccupee;
    }

    /**
     * L'ordre donné à l'armée.
     *
     * @return \Diplo\Ordres\Ordre
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
