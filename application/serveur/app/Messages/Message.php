<?php

namespace Diplo\Messages;

use Eloquent;
use Diplo\Joueurs\Joueur;

class Message extends Eloquent
{
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
