<?php

namespace Diplo\Messages;

use Eloquent;
use Diplo\Joueurs\Joueur;

class Conversation extends Eloquent
{
    /**
     * Récupère les joueurs dans une conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function joueurs()
    {
        return $this->belongsToMany(Joueur::class, 'conversations_joueurs', 'id_conversation', 'id_joueur');
    }

    /**
     * Récupère les messages d'une conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'id_conversation', 'id');
    }
}
