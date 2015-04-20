<?php

namespace Diplo\Messages;

use Diplo\Exceptions\ConversationExistanteException;
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
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     * @throws JoueurInexistantConversationException Au moins un des joueurs n'existait pas
     * @throws PartiesDifferentesException           Au moins un des joueurs n'était pas dans la même partie que les autres
     * @throws PartieNonEnJeuException               La partie n'est pas en jeu
     * @throws PartieEnPhasedeCombatException        La partie n'est pas en phase de négociation
     */
    public function creerConversation(array $idsJoueurs)

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
