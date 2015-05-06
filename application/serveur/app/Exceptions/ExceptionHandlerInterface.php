<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Http\Response;

interface ExceptionHandlerInterface
{
    /**
     * Gère l'exception passée si possible, sinon fait suivre le traitement.
     *
     * @param Exception                   $exception
     * @param ExceptionHandlerInterface[] $nextHandlers
     *
     * @return Response|null
     */
    public function handle(Exception $exception, array $nextHandlers = []);
}
