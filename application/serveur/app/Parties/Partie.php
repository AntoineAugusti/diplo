<?php

namespace Diplo\Parties;

use Diplo\Armees\Armee;
use Diplo\Cartes\Carte;
use Diplo\Exceptions\PartieNonEnJeuException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;
use Diplo\Phases\PhaseInterface;
use Diplo\Joueurs\Joueur;

class Partie extends Model implements PhaseInterface
{
    const NEGOCIATION = 'negociation';
    const COMBAT = 'combat';
    const ATTENTE_JOUEURS = 'attente_joueurs';
    const EN_JEU = 'en_jeu';
    const FIN = 'fin';

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'date_prochaine_phase'];

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
     * Récupère l'ID de la partie.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Les attributs qui doivent être traités comme des dates.
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'date_prochaine_phase'];
    }

    /**
     * Récupère les joueurs d'une partie.
     *
     * @return Relation
     */
    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'id_partie', 'id');
    }

    /**
     * Définit la relation avec une carte.
     *
     * @return Relation
     */
    public function carte()
    {
        return $this->hasOne(Carte::class, 'id_partie', 'id');
    }

    /**
     * Récupère la carte de la partie.
     *
     * @return Carte
     *
     * @throws PartieNonEnJeuException
     */
    public function getCarte()
    {
        $carte = $this->carte;

        if (is_null($carte)) {
            throw new PartieNonEnJeuException();
        }

        return $this->carte->load('cases');
    }

    /**
     * Définit la relation entre une partie et les armées à travers les joueurs.
     *
     * @return HasManyThrough
     */
    public function armees()
    {
        return $this->hasManyThrough(Armee::class, Joueur::class, 'id_partie', 'id_joueur');
    }

    /**
     * Récupère les armées de la partie.
     *
     * @return Armee[]
     */
    public function getArmees()
    {
        return $this->armees->load('ordres');
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

        $this->attributes['phase'] = $value;
    }

    /**
     * Indique si la partie est dans son dernier tour.
     *
     * @return bool
     */
    public function estDernierTour()
    {
        return $this->tour_courant == $this->nb_tours;
    }

    /**
     * Indique si la partie est dans son premier tour.
     *
     * @return bool
     */
    public function estPremierTour()
    {
        return $this->tour_courant == 1;
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
     * Détermine si la partie est en attente.
     *
     * @return bool
     */
    public function estEnAttente()
    {
        return $this->statut == self::ATTENTE_JOUEURS;
    }

    /**
     * Détermine si la partie est en jeu.
     *
     * @return bool
     */
    public function estEnJeu()
    {
        return $this->statut == self::EN_JEU;
    }

    /**
     * Détermine si la partie est terminée.
     *
     * @return bool
     */
    public function estTerminee()
    {
        return $this->statut == self::FIN;
    }

    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    public function estNegociation()
    {
        return $this->phase == self::NEGOCIATION;
    }

    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    public function estCombat()
    {
        return $this->phase == self::COMBAT;
    }

    /**
     * Récupère les joueurs d'une partie.
     *
     * @return Joueur[]
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }
}
