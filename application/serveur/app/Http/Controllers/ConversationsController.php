<?php

namespace Diplo\Http\Controllers;

use Diplo\Exceptions\ConversationExistanteException;
use Diplo\Exceptions\JoueurAbsentConversationException;
use Diplo\Exceptions\JoueurDupliqueException;
use Diplo\Exceptions\JoueurInexistantConversationException;
use Diplo\Exceptions\PasAssezDeJoueursException;
use Diplo\Joueurs\Joueur;
use Diplo\Messages\Conversation;
use Diplo\Messages\ConversationsRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConversationsController extends Controller
{
    /**
     * @var ConversationsRepository
     */
    protected $conversationsRepo;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @param ConversationsRepository $conversationsRepo
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ConversationsRepository $conversationsRepo, ResponseFactory $responseFactory)
    {
        $this->conversationsRepo = $conversationsRepo;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Créer une conversation entre joueurs.
     *
     * @param Request $request La requête HTTP
     *
     * @throws PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws JoueurInexistantConversationException Un des joueurs n'existe pas
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     *
     * @return Response
     */
    public function postConversations(Request $request)
    {
        // Récupération des données
        $joueurs = $request->json('joueurs');

        // On s'assure d'avoir un tableau
        if (empty($joueurs)) {
            $joueurs = [];
        }

        $conversation = $this->conversationsRepo->creerConversation($joueurs);

        // Préparation des valeurs de retour
        $id = $conversation->getId();
        $messages = [];
        $joueurs = $conversation->getJoueursIds();

        return $this->responseFactory->json(compact('id', 'joueurs', 'messages'), 201);
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
        $id = $conversation->getId();
        $joueurs = $conversation->getJoueursIds();
        $messages = $conversation->getMessages();

        return $this->responseFactory->json(compact('id', 'joueurs', 'messages'), 200);
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
        foreach ($joueur->getConversations() as $conversation) {
            $id = $conversation->getId();
            $joueurs = $conversation->getJoueursIds();
            $conversations[] = compact('id', 'joueurs');
        }

        return $this->responseFactory->json(compact('conversations'), 200);
    }

    /**
     * Ajoute un message à une conversation.
     *
     * @param Request      $request      La requête HTTP
     * @param Conversation $conversation La conversation
     *
     * @return Response
     *
     * @throws JoueurAbsentConversationException L'auteur du message n'est pas présent dans la conversation
     */
    public function postConversationMessages(Conversation $conversation, Request $request)
    {
        $idJoueur = $request->get('id_joueur');
        $texte = $request->get('texte');

        $message = $this->conversationsRepo->posterMessage($conversation, $idJoueur, $texte);

        return $this->responseFactory->json($message, 201);
    }
}
