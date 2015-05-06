<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Http\Response;

trait NextHandlerTrait
{
    /**
     * Envoie l'exception à l'handler si celui-ci est défini.
     *
     * @param Exception                   $exception
     * @param ExceptionHandlerInterface[] $handlers
     *
     * @return Response|null
     */
    protected function next(Exception $exception, array $handlers = [])
    {
        // S'il n'y a plus aucun handler, on s'arrête là
        if (empty($handlers)) {
            return null;
        }

        // Sinon, on défère au suivant
        $handler = array_pop($handlers);

        return $handler->handle($exception, $handlers);
    }
}
