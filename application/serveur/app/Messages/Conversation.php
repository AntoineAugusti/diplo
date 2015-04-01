<?php namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;

class Conservation {
	
	private $joueurs = [];
	
	private $messages = [];

	public function getJoueurs()
	{
		return $this->joueurs;
	}

	public function addJoueur(Joueur $j)
	{
		$this->joueurs[] = $j;
	}

	public function getMessages()
	{
		return $this->messages;
	}


	public function addMessage(Message $m)
	{
		$this->messages[] = $m;
	}
}