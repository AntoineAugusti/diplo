<?php

namespace Diplo\Handlers\Events;

use Carbon\Carbon;
use Diplo\Commands\PartiePhaseSwitcherHandler;
use Diplo\Events\CarteAEteCreee;
use Diplo\Parties\Partie;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\QueueManager as Queue;

class DemarragePartie implements ShouldBeQueued
{
    /**
     * @var Queue
     */
    private $queue;

    /**
     * Create the event handler.
     */
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * Démarre une partie.
     *
     * @param CarteAEteCreee $event
     */
    public function handle(CarteAEteCreee $event)
    {
        $partie = $event->partie;
        $partie->statut = Partie::EN_JEU;

        $dateProchainePhase = Carbon::now()->addMinutes(2);
        $partie->setDateProchainePhase($date);

        $partie->save();

        // On initialise les changements de phases
        $this->queue->later($dateProchainePhase, new PartiePhaseSwitcherHandler($partie, Partie::COMBAT));
    }
}
