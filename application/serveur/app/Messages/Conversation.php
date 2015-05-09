<?php

namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Conversation extends Model
{
    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Récupère l'ID de la conversation.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit la relation avec les joueurs dans une conversation.
     *
     * @return Relation
     */
    public function joueurs()
    {
        return $this->belongsToMany(Joueur::class, 'conversations_joueurs', 'id_conversation', 'id_joueur');
    }

    /**
     * Récupère les joueurs dans une conversation.
     *
     * @return Joueur[]
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * Les identifiants des joueurs présents dans la conversation, triés dans l'ordre croissant.
     *
     * @return int[]
     */
    public function getJoueursIds()
    {
        $ids = $this->getJoueurs()->lists('id');
        // Tri dans l'ordre croissant
        sort($ids);
        // Conversion en entiers
        array_map('intval', $ids);

        return $ids;
    }

    /**
     * Définit la relation avec les messages d'une conversation.
     *
     * @return Relation
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'id_conversation', 'id');
    }

    /**
     * Récupère les messages d'une conversation.
     *
     * @return Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
