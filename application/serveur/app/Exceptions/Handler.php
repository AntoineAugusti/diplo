<?php

namespace Diplo\Exceptions;

use Exception;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
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

        return parent::render($request, $e);
    }
}
