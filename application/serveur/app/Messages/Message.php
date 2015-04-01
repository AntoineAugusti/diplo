<?php namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;

class Message {
	
	private $texte;

	public function getTexte()
	{
		return $this->texte;
	}

	public function setTexte($texte)
	{
		$this->texte = $texte;
	}
}