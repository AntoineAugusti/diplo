<?php

namespace Diplo\Messages;

interface ConversationsRepository
{
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
    public function creerConversation(array $idsJoueurs);
}
