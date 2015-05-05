<?php

namespace Diplo\Handlers\Events;

use Diplo\Parties\Partie;
use Diplo\Events\PartiePreteACommencer;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\QueueManager as Queue;
use Diplo\Commands\PartiePhaseSwitcherHandler;

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
     * @param PartiePreteACommencer $event
     */
    public function handle(PartiePreteACommencer $event)
    {
        $partie = $event->partie;
        $partie->statut = Partie::EN_JEU;
        $partie->save();

        // On initialise les changements de phases
        $this->queue->push(new PartiePhaseSwitcherHandler($partie, 'DEBUT'));
    }
}
