<?php

namespace Diplo\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Psr\Log\LoggerInterface;
use Response;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use NextHandlerTrait;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
        'Diplo\Exceptions\ArmeeNonExistanteException',
        'Diplo\Exceptions\CaseNonExistanteException',
        'Diplo\Exceptions\ConversationExistanteException',
        'Diplo\Exceptions\ConversationIntrouvableException',
        'Diplo\Exceptions\JoueurAbsentConversationException',
        'Diplo\Exceptions\JoueurDupliqueException',
        'Diplo\Exceptions\JoueurInexistantConversationException',
        'Diplo\Exceptions\JoueurInexistantException',
        'Diplo\Exceptions\OrdreNonExistantException',
        'Diplo\Exceptions\PartieEnPhasedeCombatException',
        'Diplo\Exceptions\PartieIntrouvableException',
        'Diplo\Exceptions\PartieNonEnJeuException',
        'Diplo\Exceptions\PartiePleineException',
        'Diplo\Exceptions\PartiesDifferentesException',
        'Diplo\Exceptions\PasAssezDeJoueursException',
    ];

    /**
     * @var Application
     */
    protected $application;

    function __construct(LoggerInterface $loggerInterface, Application $application)
    {
        $this->application = $application;

        parent::__construct($loggerInterface);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $handlers = $this->getHandlers($this->getModules());

        $response = $this->next($exception, $handlers);

        if (is_null($response)) {
            return parent::render($request, $exception);
        } else {
            return $response;
        }
    }

    /**
     * Récupère les différents modules de l'application.
     *
     * @return string[]
     */
    protected function getModules()
    {
        return ['conversation', 'partie', 'joueur', 'ordre', 'armee', 'case'];
    }

    /**
     * Récupère un tableau des handlers
     *
     * @param string[] $moduleNames
     * @return ExceptionHandlerInterface[]
     */
    public function getHandlers(array $moduleNames)
    {
        return array_map(function($moduleName) {
            return $this->getHandler($moduleName);
        }, $moduleNames);
    }

    /**
     * Récupère l'objet en charge de la gestion des exceptions pour un module.
     *
     * @param string $moduleName
     * @return ExceptionHandlerInterface
     */
    protected function getHandler($moduleName)
    {
        $handler = '\\Diplo\\Exceptions\\' . ucfirst($moduleName) . 'ExceptionHandler';
        return $this->application->make($handler);
    }
}
