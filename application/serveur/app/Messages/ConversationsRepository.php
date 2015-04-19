<?php

namespace Diplo\Messages;

use Diplo\Exceptions\ConversationExistanteException;
use Diplo\Exceptions\JoueurDupliqueException;
use Diplo\Exceptions\JoueurInexistantConversationException;
use Diplo\Exceptions\PasAssezDeJoueursException;
use Diplo\Exceptions\JoueurAbsentConversationException;

interface ConversationsRepository
{
    /**
     * Trouve une conversation à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la conversation
     *
     * @return Conversation
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La conversation n'a pas été trouvée
     */
    public function trouverParId($id);

    /**
     * Demande à créer une conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return Conversation
     *
     * @throws PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws JoueurInexistantConversationException Un des joueurs n'existe pas
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     */
    public function creerConversation(array $idsJoueurs);

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
    public function posterMessage(Conversation $conversation, $idJoueur, $texte);
}
