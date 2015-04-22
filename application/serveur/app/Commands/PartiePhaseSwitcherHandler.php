<?php

namespace Diplo\Commands;

use Carbon\Carbon;
use Diplo\Events\PartieChangeDePhase;
use Diplo\Events\PartieChangeDeTour;
use Diplo\Events\PartieEstTerminee;
use Diplo\Parties\Partie;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Events\Dispatcher as Event;
use Illuminate\Queue\QueueManager as Queue;
use Illuminate\Queue\SerializesModels;

class PartiePhaseSwitcherHandler extends Command implements SelfHandling
{
    use SerializesModels;

    /**
     * @var Partie
     */
    private $partie;

    /**
     * @var string
     */
    private $phase;

    /**
     * Crée la commande.
     *
     * @param Partie $partie La partie où l'on va changer de phase
     * @param string $phase  La nouvelle phase de jeu
     */
    public function __construct(Partie $partie, $phase)
    {
        $this->partie = $partie;
        $this->phase = $phase;
    }

    /**
     * Exécute la commande.
     *
     * @param Queue $queue
     * @param Event $event
     *
     * @event PartieChangeDePhase Quand la partie change de phase
     * @event PartieChangeDeTour  Quand la partie change de tour
     * @event PartieEstTerminee   Quand la partie vient de se terminer
     */
    public function handle(Queue $queue, Event $event)
    {
        $partie = $this->partie;
        $phase = $this->phase;

        // Si on a demandé à terminer la partie, on lève l'événement
        if ($phase == 'FIN') {
            $event->fire(new PartieEstTerminee($partie));

            return;
        }

        if ($partie->estPremierTour() and $phase == 'DEBUT') {
            $prochainePhase = Partie::COMBAT;
        } else {
            // On met à jour la nouvelle phase
            $partie->phase = $phase;
            $event->fire(new PartieChangeDePhase($partie, $phase));

            // On incrémente le numéro de tour si on retourne sur une phase de combat
            // Sauf dans le cas particulier du premier tour
            if ($partie->estNegociation() and $phase != 'DEBUT') {
                $nouveauTour = $partie->tour_courant + 1;
                $partie->tour_courant = $nouveauTour;
                $event->fire(new PartieChangeDeTour($partie, $nouveauTour));
            }

            $prochainePhase = $this->prochainePhase($partie);
        }

        // On détermine la date du prochain changement de phase
        $date = $this->datePourPhase($prochainePhase);
        // On se souvient de la date du prochain changement
        $partie->date_prochaine_phase = $date;
        $partie->save();

        // On queue le prochain changement de phase
        $queue->later($date, new self($partie, $prochainePhase));
    }

    /**
     * Détermine la date du changement de la prochaine phase.
     *
     * @param string $phase Le nom de la prochaine phase
     *
     * @return Carbon
     */
    private function datePourPhase($phase)
    {
        if ($phase == Partie::NEGOCIATION) {
            return Carbon::now()->addMinutes(2);
        }

        return Carbon::now()->addMinutes(1);
    }

    /**
     * Détermine la prochaine phase pour une partie.
     *
     * @param Partie $partie
     *
     * @return string
     */
    private function prochainePhase(Partie $partie)
    {
        // Phase de combat lors du dernier tour, on peut demander la clôture de la partie
        if ($partie->estDernierTour() and $partie->estCombat()) {
            return 'FIN';
        }

        if ($partie->estCombat()) {
            return PARTIE::NEGOCIATION;
        }

        return PARTIE::COMBAT;
    }
}
