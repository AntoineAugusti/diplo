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
    const NEGOCIATION = 'negociation';
    const COMBAT = 'combat';
    const ATTENTE_JOUEURS = 'attente_joueurs';
    const EN_JEU = 'attente_joueurs';
    const FIN = 'fin';

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'tour_courant'        => 'integer',
        'nb_tours'            => 'integer',
        'nb_joueurs_requis'   => 'integer',
        'nb_joueurs_inscrits' => 'integer',
    ];

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
        if (!in_array($value, self::phasesPossibles())) {
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
     * Détermine si une partie est pleine.
     *
     * @return bool
     */
    public function estPleine()
    {
        return $this->nb_joueurs_inscrits == $this->nb_joueurs_requis;
    }

    /**
     * Détermine s'il manque un seul joueur pour débuter une partie.
     *
     * @return bool
     */
    public function manqueUnJoueur()
    {
        return $this->nb_joueurs_inscrits == ($this->nb_joueurs_requis - 1);
    }

    /**
     * Retourne les phases possibles.
     *
     * @return array Tableau de chaînes de caractères
     */
    public static function phasesPossibles()
    {
        return [self::COMBAT, self::NEGOCIATION];
    }

    /**
     * Retourne les statuts possibles.
     *
     * @return array Tableau de chaînes de caractères
     */
    public static function statutsPossibles()
    {
        return [self::ATTENTE_JOUEURS, self::EN_JEU, self::FIN];
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
