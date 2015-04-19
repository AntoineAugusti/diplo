<?php

namespace Diplo\Messages;

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
     * @throws PasAssezDeJoueursException     Une conversation doit être créée au moins entre 2 joueurs
     * @throws JoueurInexistantException      Un des joueurs n'existe pas
     * @throws ConversationExistanteException Une conversation entre ces joueurs existait déjà
     */
    public function creerConversation(array $idsJoueurs);
}
