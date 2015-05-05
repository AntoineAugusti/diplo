<?php

namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;

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
        // Tri dans l'ordre croissant
        sort($ids);
        // Conversion en entiers
        array_map('intval', $ids);

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
