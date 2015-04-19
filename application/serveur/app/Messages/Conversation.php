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
     * Les identifiants des joueurs présents dans la conversation, triés dans l'ordre croissant.
     *
     * @return array
     */
    public function joueursIds()
    {
        $ids = $this->joueurs->lists('id');
        sort($ids);

        return $ids;
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
