<?php

namespace Diplo\Joueurs;

use Diplo\Armees\Armee;
use Eloquent;
use Diplo\Messages\Conversation;
use Diplo\Messages\Message;
use Diplo\Parties\Partie;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'id_partie' => 'integer',
    ];

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
     * Récupère les conversations d'un joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversations_joueurs', 'id_joueur', 'id_conversation');
    }

    /**
     * Récupère les messages d'un joueur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'id_joueur', 'id');
    }

    /**
     * Récupère les armées d'un joueur.
     *
     * @return HasMany
     */
    public function armees()
    {
        return $this->hasMany(Armee::class, 'id_joueur', 'id');
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
