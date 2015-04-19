<?php

namespace Diplo\Messages;

use Eloquent;
use Diplo\Joueurs\Joueur;

class Message extends Eloquent
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
    protected $fillable = ['id_joueur', 'texte', 'id_conversation'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['id_conversation', 'updated_at'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'id_conversation' => 'integer',
        'id_joueur'       => 'integer',
    ];

    /**
     * Récupère l'auteur d'un message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * Récupère la conversation associée à un message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'id_conversation', 'id');
    }
}
