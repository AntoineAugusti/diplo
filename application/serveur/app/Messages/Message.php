<?php namespace Diplo\Messages;

use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Message
 * @package Diplo\Messages
 */
class Message extends Model {

    /**
     * @var Joueur
     */
    private $joueur;

    /**
     * @var string
     */
    private $texte;

    /**
     * @return BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * @return BelongsTo
     */
    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

    /**
     * @return Joueur
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * @param Joueur $joueur
     * @return void
     */
    public function setJoueur(Joueur $joueur)
    {
        $this->joueur = $joueur;
    }

    /**
     * @return string
     */
    public function getTexte()
	{
		return $this->texte;
	}

    /**
     * @param string $texte
     * @return void
     */
    public function setTexte($texte)
	{
		$this->texte = $texte;
	}
}