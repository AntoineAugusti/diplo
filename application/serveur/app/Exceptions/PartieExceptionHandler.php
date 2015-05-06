<?php namespace Diplo\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class PartieExceptionHandler implements ExceptionHandlerInterface
{
    use NextHandlerTrait;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @param ResponseFactory $responseFactory
     */
    function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Gère l'exception passée si possible, sinon fait suivre le traitement.
     *
     * @param Exception $exception
     * @param ExceptionHandlerInterface[] $nextHandlers
     * @return Response|null
     */
    public function handle(Exception $exception, array $nextHandlers = [])
    {
        if ($exception instanceof PartieIntrouvableException) {
            $statut = 'non_trouve';
            $erreur = 'La partie '.$exception->getMessage()." n'existe pas";

            return $this->responseFactory->json(compact('statut', 'erreur'), 404);
        }

        if ($exception instanceof PartiePleineException) {
            $statut = 'partie_pleine';
            $erreur = 'La partie '.$exception->getMessage().' est pleine';

            return $this->responseFactory->json(compact('statut', 'erreur'), 400);
        }

        if ($exception instanceof PartieNonEnJeuException) {
            $statut = 'partie_invalide';
            $erreur = 'La partie '.$exception->getMessage()." n'est pas en jeu : la partie peut être en attente de joueurs ou terminée";

            return $this->responseFactory->json(compact('statut', 'erreur'), 405);
        }

        if ($exception instanceof PartieEnPhasedeCombatException) {
            $statut = 'partie_phase_combat';
            $erreur = 'La partie '.$exception->getMessage().' est en phase de combat';

            return $this->responseFactory->json(compact('statut', 'erreur'), 403);
        }

        return $this->next($exception, $nextHandlers);
    }
}
