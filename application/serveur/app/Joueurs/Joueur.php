<?php

namespace Diplo\Joueurs;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Diplo\Cartes\CaseInterface;
use Diplo\Messages\Conversation;
use Diplo\Messages\Message;
use Diplo\Parties\Partie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Joueur extends Model
{
    /**
     * Les attributs que l'on peut définir lors de l'appel au constructeur.
     *
     * @var array
     */
    protected $fillable = ['pseudo', 'pays'];

    /**
     * Les attributs cachés lors de la conversion en array ou JSON.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Les attributs à rajouter au modèle.
     *
     * @var array
     */
    protected $appends = ['armees_restantes', 'cases_controlees'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'id_partie' => 'integer',
    ];

    /**
     * Récupère l'ID du joueur.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit la relation avec la partie.
     *
     * @return BelongsTo
     */
    public function partie()
    {
        return $this->belongsTo(Partie::class, 'id_partie', 'id');
    }

    /**
     * Récupère la partie du joueur.
     *
     * @return Partie
     */
    public function getPartie()
    {
        return $this->partie;
    }

    /**
     * Définit la relation avec les conversations.
     *
     * @return BelongsToMany
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversations_joueurs', 'id_joueur', 'id_conversation');
    }

    /**
     * Récupère les conversations du joueur.
     *
     * @return Conversation[]
     */
    public function getConversations()
    {
        return $this->conversations;
    }

    /**
     * Définit la relation avec les messages.
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'id_joueur', 'id');
    }

    /**
     * Récupère tous les messages du joueur.
     *
     * @return Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Définit la relation avec les armées.
     *
     * @return HasMany
     */
    public function armees()
    {
        return $this->hasMany(Armee::class, 'id_joueur', 'id');
    }

    /**
     * Récupère les armées du joueur.
     *
     * @return Armee[]
     */
    public function getArmees()
    {
        return $this->armees;
    }

    /**
     * Le pseudo du joueur.
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Le pays du joueur au format ISO 3166-1 alpha-3.
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Retourne le nombre d'armées possédées par le joueur.
     *
     * @return int
     */
    public function getArmeesRestantesAttribute()
    {
        return $this->armees()->count();
    }

    /**
     * Définit la relation avec les cases contrôlées.
     *
     * @return HasMany
     */
    public function cases()
    {
        return $this->hasMany(CaseClass::class, 'id_joueur', 'id');
    }

    /**
     * Récupère les cases contrôlées par le joueur.
     *
     * @return CaseInterface[]
     */
    public function getCases()
    {
        return $this->cases;
    }

    /**
     * Retourne le nombre de cases contrôlées par le joueur.
     *
     * @return int
     */
    public function getCasesControleesAttribute()
    {
        return count($this->getCases());
    }
}
