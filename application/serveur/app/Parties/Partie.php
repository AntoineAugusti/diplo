<?php

namespace Diplo\Parties;

use InvalidArgumentException;
use Eloquent;
use Diplo\Phases\PhaseCombat;
use Diplo\Phases\PhaseInterface;
use Diplo\Phases\PhaseNegociation;
use Diplo\Joueurs\Joueur;

class Partie extends Eloquent implements PhaseInterface
{
    /**
     * Récupère les joueurs d'une partie.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'id_partie', 'id');
    }

    /**
     * Mutateur pour l'attribut "phase".
     *
     * @param string $value
     *
     * @throws InvalidArgumentException La phase est inconnue
     */
    public function setPhaseAttribute($value)
    {
        if (!in_array($value, ['NEGOCIATION', 'COMBAT'])) {
            throw new InvalidArgumentException('Phase inconnue : '.$value);
        }

        switch ($string) {
            case 'NEGOCIATION':
                $this->attributes['phaseObject'] = new PhaseNegociation();
                break;
            case 'COMBAT':
                $this->attributes['phaseObject'] = new PhaseCombat();
                break;
        }
    }

    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    public function estNegociation()
    {
        return $this->phaseObject->estNegociation();
    }

    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    public function estCombat()
    {
        return $this->phaseObject->estCombat();
    }
}
