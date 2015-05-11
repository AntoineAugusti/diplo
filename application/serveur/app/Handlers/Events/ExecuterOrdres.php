<?php

namespace Diplo\Handlers\Events;

use Diplo\Events\PartieChangeDeTour;
use Diplo\Ordres\Attaquer;
use Diplo\Ordres\Ordre;
use Diplo\Ordres\OrdreExecuteur;
use Diplo\Ordres\OrdreRepository;
use Illuminate\Contracts\Foundation\Application;

class ExecuterOrdres
{
    /**
     * @var OrdreExecuteur[] Les exécuteurs pour chaque type d'ordre
     */
    private $executeurs = [];

    /**
     * Application Laravel.
     *
     * @var Application
     */
    private $application;

    /**
     * @var OrdreRepository
     */
    private $ordreRepository;

    /**
     * @param Application     $application
     * @param OrdreRepository $ordreRepository
     */
    public function __construct(Application $application, OrdreRepository $ordreRepository)
    {
        $this->application = $application;
        $this->ordreRepository = $ordreRepository;
    }

    /**
     * Exécute les ordres donnés lors de la phase de combat précédente.
     *
     * @param PartieChangeDeTour $event
     */
    public function handle(PartieChangeDeTour $event)
    {
        $partie = $event->partie;

        $armees = $partie->getArmees();

        $ordres = [];
        $casesAttaques = [];
        foreach ($armees as $armee) {
            // Récupère le modèle d'ordre.
            $ordreModel = $armee->getOrdre();

            // Si le modèle ordre existe, on récupère l'ordre métier et on vérifie que cet ordre est valide.
            if (!is_null($ordreModel)) {
                $ordre = $ordreModel->getOrdre();

                if ($ordre instanceof Attaquer) {
                    $casesAttaques[] = $ordre->getCase()->getId();
                }

                // On vérifie que l'ordre donné est valide
                if ($this->verifierOrdre($ordre)) {
                    $ordres[] = $ordre;
                }
            }
        }

        // Suppression des ordres passés depuis des cases attaquées.
        $ordres = array_filter($ordres, function(Ordre $ordre) use ($casesAttaques) {
            return !in_array($ordre->getArmee()->getCase()->getId(), $casesAttaques);
        });

        foreach ($ordres as $ordre) {
            $this->executer($ordre, $ordres);
        }

        // On marque tous les ordres de la partie passés ce tour comme exécutés
        // afin de ne pas les compter au prochain tour.
        $this->ordreRepository->marquerTousLesOrdresCommeExecutes($partie);
    }

    /**
     * Vérifie qu'un ordre est correct via son exécuteur.
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

        // Si l'exécuteur n'a pas déjà été instancié, on demande à Laravel
        // de le créer à l'aide de l'IoC container
        if (!array_key_exists($nomExecuteur, $this->executeurs)) {
            $this->executeurs[$nomExecuteur] = $this->application->make($nomExecuteur);
        }

        return $this->executeurs[$nomExecuteur];
    }
}
