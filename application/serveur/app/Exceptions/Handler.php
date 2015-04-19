<?php

namespace Diplo\Exceptions;

use Exception;
use Response;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
        'Diplo\Exceptions\PartieIntrouvableException',
        'Diplo\Exceptions\PartieNonEnJeuException',
        'Diplo\Exceptions\PartiePleineException',
        'Diplo\Exceptions\PasAssezDeJoueursException',
        'Diplo\Exceptions\JoueurInexistantException',
        'Diplo\Exceptions\ConversationExistanteException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof PartieIntrouvableException) {
            $statut = 'non_trouve';
            $erreur = 'La partie '.$e->getMessage()." n'existe pas";

            return Response::json(compact('statut', 'erreur'), 404);
        }

        if ($e instanceof PartiePleineException) {
            $statut = 'partie_pleine';
            $erreur = 'La partie '.$e->getMessage().' est pleine';

            return Response::json(compact('statut', 'erreur'), 400);
        }

        if ($e instanceof PartieNonEnJeuException) {
            $statut = 'partie_invalide';
            $erreur = 'La partie '.$e->getMessage()." n'est pas en jeu : la partie peut être en attente de joueurs ou terminée";

            return Response::json(compact('statut', 'erreur'), 405);
        }

        if ($e instanceof JoueurInexistantException) {
            $statut = 'joueur_non_present';
            $erreur = "Au moins un des joueurs n'existe pas. Impossible de créer la conversation";

            return Response::json(compact('statut', 'erreur'), 403);
        }

        if ($e instanceof PasAssezDeJoueursException) {
            $statut = 'manque_joueurs';
            $erreur = "Une conversation ne peut être créée qu'entre deux joueurs ou plus";

            return Response::json(compact('statut', 'erreur'), 400);
        }

        if ($e instanceof ConversationExistanteException) {
            $statut = 'conversation_existante';
            $erreur = 'Une conversation entre ces joueurs existe déjà. Utilisez cette conversation';

            return Response::json(compact('statut', 'erreur'), 403);
        }

        return parent::render($request, $e);
    }
}
