<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CaseExceptionHandler implements ExceptionHandlerInterface
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
        if ($exception instanceof CaseNonExistanteException) {
            $statut = 'case_non_trouvee';
            $erreur = 'La case '.$exception->getMessage()." n'existe pas";

            return $this->responseFactory->json(compact('statut', 'erreur'), 404);
        }

        return $this->next($exception, $nextHandlers);
    }
}
