<?php namespace Diplo\Exceptions;

use Diplo\Ordres\Attaquer;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OrdreExceptionHandler implements ExceptionHandlerInterface
{
    use NextHandlerTrait;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

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
        if ($exception instanceof OrdreNonExistantException) {
            $statut = 'ordre_inconnu';
            $valeursPossibles = Attaquer::presenteOrdresPossibles();
            $erreur = "L'ordre ".$exception->getMessage()." n'existe pas. Valeurs possibles : ".$valeursPossibles;

            return $this->responseFactory->json(compact('statut', 'erreur'), 400);
        }

        return $this->next($exception, $nextHandlers);
    }
}
