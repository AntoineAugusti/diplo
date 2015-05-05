<?php

namespace Diplo\Http\Controllers;

use Diplo\Joueurs\Joueur;
use Diplo\Messages\Conversation;
use Diplo\Messages\ConversationsRepository;
use Illuminate\Http\Request;
use Response;

class ConversationsController extends Controller
{
    /**
     * @var ConversationsRepository
     */
    private $conversationsRepo;

    public function __construct(ConversationsRepository $conversationsRepo)
    {
        // Laravel va se charger d'injecter une classe concrète respectant l'interface
        // spécifiée. On peut donc utiliser cette interface dans le contrôleur
        $this->conversationsRepo = $conversationsRepo;
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
        $id = $conversation->id;
        $messages = [];
        $joueurs = $conversation->joueursIds();

        return Response::json(compact('id', 'joueurs', 'messages'), 201);
    }
}
