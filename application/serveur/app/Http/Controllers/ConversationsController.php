<?php

namespace Diplo\Http\Controllers;

use Input;
use Response;
use Diplo\Joueurs\Joueur;
use Diplo\Messages\Conversation;
use Diplo\Messages\ConversationsRepository;

class ConversationsController extends Controller
{
    /**
     * @var ConversationsRepository
     */
    private $conversationsRepo;

    public function __construct(ConversationsRepository $conversationsRepo)
    {
        $this->conversationsRepo = $conversationsRepo;
    }

    /**
     * Créer une conversation entre joueurs.
     *
     * @throws \Diplo\Exceptions\PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws \Diplo\Exceptions\JoueurInexistantConversationException Un des joueurs n'existe pas
     * @throws \Diplo\Exceptions\ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws \Diplo\Exceptions\JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     *
     * @return Response
     */
    public function postConversations()
    {
        // Récupération des données
        $joueurs = json_decode(Input::get('joueurs'), true);

        // On s'assure d'avoir un tableau
        if (empty($joueurs)) {
            $joueurs = [];
        }

        $conversation = $this->conversationsRepo->creerConversation($joueurs);

        // Préparation des valeurs de retour
        $id = $conversation->id;
        $messages = [];
        $joueurs = $conversation->joueursIds();

        return Response::json(compact('id', 'joueurs', 'messages'), 201);
    }

    /**
     * Retourne des informations sur une conversation.
     *
     * @param Conversation $conversation
     *
     * @return Response
     */
    public function getConversation(Conversation $conversation)
    {
        $id = $conversation->id;
        $joueurs = $conversation->joueursIds();
        $messages = $conversation->messages;

        return Response::json(compact('id', 'joueurs', 'messages'), 200);
    }

    /**
     * Récupère les conversations auxquelles participe un joueur.
     *
     * @param Joueur $joueur
     *
     * @return Response
     */
    public function getConversationJoueur(Joueur $joueur)
    {
        $conversations = [];
        foreach ($joueur->conversations as $conversation) {
            $id = $conversation->id;
            $joueurs = $conversation->joueursIds();
            $conversations[] = compact('id', 'joueurs');
        }

        return Response::json(compact('conversations'), 200);
    }

    /**
     * Ajoute un message à une conversation.
     *
     * @param Conversation $conversation La conversation
     *
     * @return Response
     *
     * @throws \Diplo\Exceptions\JoueurAbsentConversationException L'auteur du message n'est pas présent dans la conversation
     */
    public function postConversationMessages(Conversation $conversation)
    {
        $idJoueur = Input::get('id_joueur');
        $texte = Input::get('texte');

        $message = $this->conversationsRepo->posterMessage($conversation, $idJoueur, $texte);

        return Response::json($message, 201);
    }
}
