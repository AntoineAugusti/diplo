<?php

namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Message extends Model
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
     * Définit la relation de l'auteur d'un message.
     *
     * @return Relation
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'id_joueur', 'id');
    }

    /**
     * Récupère l'auteur du message.
     *
     * @return Joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * Définit la relation avec les conversations.
     *
     * @return Relation
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'id_conversation', 'id');
    }

    /**
     * Récupère la conversation du message.
     *
     * @return Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }
}
