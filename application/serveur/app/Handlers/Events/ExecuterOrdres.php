<?php

namespace Diplo\Handlers\Events;

use Diplo\Events\PartieChangeDeTour;
use Diplo\Ordres\Ordre;
use Diplo\Ordres\OrdreExecuteur;
use Diplo\Ordres\OrdreRepository;
use Illuminate\Contracts\Foundation\Application;

class ExecuterOrdres
{
    protected $executeurs = [];

    /**
     * Application Laravel.
     *
     * @var Application
     */
    protected $application;
    /**
     * @var OrdreRepository
     */
    private $ordreRepository;

    /**
     * @param Application $application
     * @param OrdreRepository $ordreRepository
     */
    public function __construct(Application $application, OrdreRepository $ordreRepository)
    {
        $this->application = $application;
        $this->ordreRepository = $ordreRepository;
    }

    public function handle(PartieChangeDeTour $event)
    {
        $partie = $event->partie;

        $armees = $partie->getArmees();

        $ordres = [];
        foreach ($armees as $armee) {
            // Récupère le modèle d'ordre puis l'objet métier ordre.
            $ordre = $armee->getOrdre()->getOrdre();

            if ($this->verifierOrdre($ordre)) {
                $ordres[] = $ordre;
            }
        }

        foreach ($ordres as $ordre) {
            $this->executer($ordre, $ordres);
        }

        // On marque tous les ordres de la partie passés ce tour comme exécuté afin de ne pas les compter au prochain tour.
        $this->ordreRepository->marquerTousLesOrdresCommeExecutes($partie);
    }

    /**
     * Vérifie qu'un ordre est correct via l'exécuteur.
     *
     * @param Ordre $ordre
     *
     * @return bool
     */
    protected function verifierOrdre(Ordre $ordre)
    {
        $executeur = $this->getOrdreExecuteur($ordre);

        return $executeur->verifierOrdre($ordre);
    }

    /**
     * Exécute un ordre via l'exécuteur.
     *
     * @param Ordre $ordre
     */
    protected function executer(Ordre $ordre, $ordres)
    {
        $executeur = $this->getOrdreExecuteur($ordre);
        $executeur->executer($ordre, $ordres);
    }

    /**
     * Récupère l'objet en charge d'exécuter l'ordre.
     *
     * @param Ordre $ordre
     *
     * @return OrdreExecuteur
     */
    protected function getOrdreExecuteur(Ordre $ordre)
    {
        $nomExecuteur = get_class($ordre).'Executeur';

        if (is_null($this->executeurs[$nomExecuteur])) {
            $this->executeurs[$nomExecuteur] = $this->application->make($nomExecuteur);
        }

        return $this->executeurs[$nomExecuteur];
    }
}
