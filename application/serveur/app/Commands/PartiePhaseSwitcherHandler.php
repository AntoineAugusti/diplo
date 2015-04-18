<?php

namespace Diplo\Commands;

use Carbon\Carbon;
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
            $prochainePhase = Partie::NEGOCIATION;
        } else {
            // On met à jour la nouvelle phase
            $partie->phase = $phase;

            // On incrémente le numéro de tour si on retourne sur une phase de combat
            // Sauf dans le cas particulier du premier
            if ($partie->estCombat() and $phase != 'DEBUT') {
                $partie->tour_courant = $partie->tour_courant + 1;
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
        if ($partie->estCombat()) {
            if (!$partie->estDernierTour()) {
                return PARTIE::NEGOCIATION;
            // Phase de combat lors du dernier tour
            // On peut demander la clôture de la partie
            } else {
                return 'FIN';
            }
        }

        return PARTIE::COMBAT;
    }
}
