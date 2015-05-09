<?php

namespace Diplo\Messages;

use Diplo\Exceptions\ConversationExistanteException;
use Diplo\Exceptions\JoueurAbsentConversationException;
use Diplo\Exceptions\JoueurDupliqueException;
use Diplo\Exceptions\JoueurInexistantConversationException;
use Diplo\Exceptions\PartieEnPhasedeCombatException;
use Diplo\Exceptions\PartieNonEnJeuException;
use Diplo\Exceptions\PartiesDifferentesException;
use Diplo\Exceptions\PasAssezDeJoueursException;
use Diplo\Joueurs\JoueursRepository;
use Illuminate\Database\Eloquent\Collection;

class EloquentConversationsRepository implements ConversationsRepository
{
    /**
     * @var JoueursRepository
     */
    private $joueursRepo;

    public function __construct(JoueursRepository $joueursRepo)
    {
        $this->joueursRepo = $joueursRepo;
    }

    /**
     * Trouve une conversation à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la conversation
     *
     * @return Conversation
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La conversation n'a pas été trouvée
     */
    public function trouverParId($id)
    {
        return Conversation::findOrFail($id);
    }

    /**
     * Demande à créer une conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return Conversation
     *
     * @throws PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     * @throws JoueurInexistantConversationException Au moins un des joueurs n'existait pas
     * @throws PartiesDifferentesException           Au moins un des joueurs n'était pas dans la même partie que les autres
     * @throws PartieNonEnJeuException               La partie n'est pas en jeu
     * @throws PartieEnPhasedeCombatException        La partie n'est pas en phase de négociation
     */
    public function creerConversation(array $idsJoueurs)
    {
        $joueurs = $this->verifiePossibiliteCreerConversation($idsJoueurs);

        // On crée la conversation et on ajoute les joueurs
        $conversation = Conversation::create([]);
        foreach ($joueurs as $joueur) {
            $conversation->joueurs()->save($joueur);
        }

        $conversation->save();

        return $conversation;
    }

    /**
     * Ajoute un message à une conversation.
     *
     * @param Conversation $conversation La conversation
     * @param int          $idJoueur     L'identifiant du joueur
     * @param string       $texte        Le contenu du message
     *
     * @return Message
     *
     * @throws JoueurAbsentConversationException L'auteur du message n'est pas présent dans la conversation
     */
    public function posterMessage(Conversation $conversation, $idJoueur, $texte)
    {
        if ($this->joueurAbsentConversation($conversation, $idJoueur)) {
            throw new JoueurAbsentConversationException($idJoueur);
        }

        $messageData = [
            'id_joueur'       => $idJoueur,
            'id_conversation' => $conversation->id,
            'texte'           => $texte,
        ];
        $message = Message::create($messageData);
        $conversation->messages()->save($message);

        return $message;
    }

    /**
     * Détermine si un joueur est absent d'une conversation ou non.
     *
     * @param Conversation $c
     * @param int          $idJoueur L'identifiant du joueur
     *
     * @return bool
     */
    private function joueurAbsentConversation(Conversation $c, $idJoueur)
    {
        return !in_array($idJoueur, $c->getJoueursIds());
    }

    /**
     * Vérifie qu'il est possible de créer la conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return Collection Les joueurs
     *
     * @throws PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     * @throws JoueurInexistantConversationException Au moins un des joueurs n'existait pas
     * @throws PartiesDifferentesException           Au moins un des joueurs n'était pas dans la même partie que les autres
     * @throws PartieNonEnJeuException               La partie n'est pas en jeu
     * @throws PartieEnPhasedeCombatException        La partie n'est pas en phase de négociation
     */
    private function verifiePossibiliteCreerConversation(array $idsJoueurs)
    {
        // Vérifions qu'il y a au moins 2 joueurs dans la conversation
        if (count($idsJoueurs) < 2) {
            throw new PasAssezDeJoueursException();
        }

        // Vérifions qu'aucun joueur n'a été demandé plus d'une fois
        if ($this->tableauPossedeDoublons($idsJoueurs)) {
            throw new JoueurDupliqueException();
        }

        // On récupère tous les joueurs
        $joueurs = $this->recupererJoueurs($idsJoueurs);

        // On vérifie qu'on a bien récupéré tous les joueurs
        $idsJoueursRecuperes = $joueurs->lists('id');
        foreach ($idsJoueurs as $idJoueur) {
            if (!in_array($idJoueur, $idsJoueursRecuperes)) {
                throw new JoueurInexistantConversationException($idJoueur);
            }
        }

        // Vérifions que tous les joueurs sont dans la même partie
        if (!$this->partiesSontLesMemes($joueurs)) {
            throw new PartiesDifferentesException();
        }

        // On vérifie que la partie est en jeu
        $partie = $joueurs->first()->partie;
        if (!$partie->estEnJeu()) {
            throw new PartieNonEnJeuException($partie->id);
        }

        // On vérifie que la partie est en phase de négociation
        if (!$partie->estNegociation()) {
            throw new PartieEnPhasedeCombatException($partie->id);
        }

        // Vérifions qu'une conversation entre ces joueurs n'existe pas
        if ($this->conversationEntreJoueursExiste($joueurs)) {
            throw new ConversationExistanteException();
        }

        return $joueurs;
    }

    /**
     * Vérifie que les parties d'un ensemble de joueurs sont les mêmes.
     *
     * @param Collection $joueurs
     *
     * @return bool
     */
    private function partiesSontLesMemes(Collection $joueurs)
    {
        return count(array_unique($joueurs->lists('id_partie'))) == 1;
    }

    /**
     * Récupère les joueurs depuis un ensemble d'identifiants.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function recupererJoueurs(array $idsJoueurs)
    {
        return $this->joueursRepo->trouverParIds($idsJoueurs);
    }

    /**
     * Détermine si un tableau possède des valeurs en double.
     *
     * @param array $a
     *
     * @return bool
     */
    private function tableauPossedeDoublons(array $a)
    {
        return count($a) !== count(array_unique($a));
    }

    /**
     * Indique si une conversation entre joueurs données en paramètre existe déjà.
     *
     * @param Collection $joueurs
     *
     * @return bool
     */
    private function conversationEntreJoueursExiste($joueurs)
    {
        $idsJoueurs = $joueurs->lists('id');
        sort($idsJoueurs);

        foreach (Conversation::all() as $conversation) {
            if ($conversation->getJoueursIds() == $idsJoueurs) {
                return true;
            }
        }

        return false;
    }
}
