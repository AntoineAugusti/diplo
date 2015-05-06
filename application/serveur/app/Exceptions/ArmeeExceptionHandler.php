<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class ArmeeExceptionHandler implements ExceptionHandlerInterface
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
        if ($exception instanceof ArmeeNonExistanteException) {
            $statut = 'armee_non_trouvee';
            $erreur = "L'armée ".$exception->getMessage()." n'existe pas";

            return $this->responseFactory->json(compact('statut', 'erreur'), 404);
        }

        return $this->next($exception, $nextHandlers);
    }
}
