<?php namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Conversation
 * @package Diplo\Messages
 */
class Conversation extends Model {

    /**
     * @var Joueur[]
     */
    private $joueurs = [];

    /**
     * @var Message[]
     */
    private $messages = [];

    /**
     * @return BelongsToMany
     */
    public function joueurs()
    {
        return $this->belongsToMany(Joueur::class);
    }

    /**
     * @return Joueur[]
     */
    public function getJoueurs()
	{
		return $this->joueurs;
	}

    /**
     * @param Joueur $joueur
     * @return void
     */
    public function addJoueur(Joueur $joueur)
	{
		$this->joueurs[] = $j;
	}

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return Message[]
     */
    public function getMessages()
	{
		return $this->messages;
	}

    /**
     * @param Message $message
     * @return void
     */
    public function addMessage(Message $message)
	{
		$this->messages[] = $m;
	}
}