<?php

namespace Diplo\Messages;

use Diplo\Exceptions\ConversationExistanteException;
use Diplo\Exceptions\JoueurInexistantException;
use Diplo\Exceptions\PasAssezDeJoueursException;
use Diplo\Joueurs\JoueursRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentConversationsRepository implements ConversationsRepository
{
    /**
     * @var JoueursRepository
     */
    private $joueurRepo;

    public function __construct(JoueursRepository $joueurRepo)
    {
        $this->joueurRepo = $joueurRepo;
    }

    /**
     * Demande à créer une conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return Conversation
     *
     * @throws PasAssezDeJoueursException     Une conversation doit être créée au moins entre 2 joueurs
     * @throws JoueurInexistantException      Un des joueurs n'existe
     * @throws ConversationExistanteException Une conversation entre ces joueurs existait déjà
     */
    public function creerConversation(array $idsJoueurs)
    {
        $this->verifiePossibiliteCreerConversation($idsJoueurs);

        // On crée la conversation et on ajoute les joueurs
        $conversation = Conversation::create([]);
        foreach ($idsJoueurs as $idJoueur) {
            try {
                $joueur = $this->joueurRepo->trouverParId($idJoueur);
            } catch (ModelNotFoundException $e) {
                throw new JoueurInexistantException();
            }
            $conversation->joueurs()->save($joueur);
        }

        return $conversation;
    }


    /**
     * Vérifie qu'il est possible de créer la conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @throws PasAssezDeJoueursException     Une conversation doit être créée au moins entre 2 joueurs
     * @throws ConversationExistanteException Une conversation entre ces joueurs existait déjà
     */
    private function verifiePossibiliteCreerConversation(array $idsJoueurs)
    {
        // Vérifions qu'il y a au moins 2 joueurs dans la conversation
        if (count($idsJoueurs) < 2) {
            throw new PasAssezDeJoueursException();
        }

        // Vérifions qu'une conversation entre ces joueurs n'existe pas
        if ($this->conversationEntreJoueursExiste($idsJoueurs)) {
            throw new ConversationExistanteException();
        }
    }

    /**
     * Indique si une conversation entre joueurs données en paramètre existe déjà.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return bool
     */
    private function conversationEntreJoueursExiste(array $idsJoueurs)
    {
        sort($idsJoueurs);

        foreach (Conversation::all() as $conversation) {
            if ($conversation->joueursIds() == $idsJoueurs) {
                return true;
            }
        }

        return false;
    }
}
