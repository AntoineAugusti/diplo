<?php namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;

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