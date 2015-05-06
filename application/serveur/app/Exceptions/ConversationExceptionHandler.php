<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ConversationExceptionHandler implements ExceptionHandlerInterface
{
    use NextHandlerTrait;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @param ResponseFactory $responseFactory
     */
    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Gère l'exception passée si possible, sinon fait suivre le traitement.
     *
     * @param Exception                   $exception
     * @param ExceptionHandlerInterface[] $nextHandlers
     *
     * @return Response|null
     */
    public function handle(Exception $exception, array $nextHandlers = array())
    {
        if ($exception instanceof ConversationExistanteException) {
            $statut = 'conversation_existante';
            $erreur = 'Une conversation entre ces joueurs existe déjà. Utilisez cette conversation';

            return $this->responseFactory->json(compact('statut', 'erreur'), 403);
        }

        if ($exception instanceof ConversationIntrouvableException) {
            $statut = 'non_trouve';
            $erreur = 'La conversation '.$exception->getMessage()." n'existe pas";

            return $this->responseFactory->json(compact('statut', 'erreur'), 404);
        }

        if ($exception instanceof PasAssezDeJoueursException) {
            $statut = 'manque_joueurs';
            $erreur = "Une conversation ne peut être créée qu'entre deux joueurs ou plus";

            return $this->responseFactory->json(compact('statut', 'erreur'), 400);
        }

        if ($exception instanceof JoueurInexistantConversationException) {
            $statut = 'joueur_non_present';
            $erreur = "Au moins un des joueurs n'existe pas. Impossible de créer la conversation";

            return $this->responseFactory->json(compact('statut', 'erreur'), 403);
        }

        if ($exception instanceof JoueurDupliqueException) {
            $statut = 'joueur_duplique';
            $erreur = "Un joueur ne peut être plus d'une fois dans la même conversation";

            return $this->responseFactory->json(compact('statut', 'erreur'), 400);
        }

        if ($exception instanceof JoueurAbsentConversationException) {
            $statut = 'joueur_non_present';
            $erreur = 'Le joueur '.$exception->getMessage()." n'est pas présent dans la conversation";

            return $this->responseFactory->json(compact('statut', 'erreur'), 403);
        }

        if ($exception instanceof PartiesDifferentesException) {
            $statut = 'parties_differentes';
            $erreur = 'Les joueurs ne sont pas dans la même partie';

            return $this->responseFactory->json(compact('statut', 'erreur'), 403);
        }

        return $this->next($exception, $nextHandlers);
    }
}
