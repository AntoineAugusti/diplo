<?php

namespace Diplo\Handlers\Events;

use Diplo\Events\PartieEstTerminee;
use Diplo\Parties\Partie;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class CloturerPartie implements ShouldBeQueued
{
    /**
     * Create the event handler.
     */
    public function __construct()
    {
        //
    }

    /**
     * Clôt une partie.
     *
     * @param PartieEstTerminee $event
     */
    public function handle(PartieEstTerminee $event)
    {
        $partie = $event->partie;
        $partie->statut = Partie::FIN;
        $partie->save();
    }
}
