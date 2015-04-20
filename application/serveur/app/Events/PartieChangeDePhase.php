<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

class PartieChangeDePhase extends Event
{
    use SerializesModels;

    /**
     * @var Partie
     */
    public $partie;

    /**
     * La nouvelle phase.
     *
     * @var string
     */
    public $phase;

    /**
     * Constructeur.
     *
     * @param Partie $partie La partie
     * @param string $phase  La nouvelle phase
     */
    public function __construct(Partie $partie, $phase)
    {
        $this->partie = $partie;
        $this->phase  = $phase;
    }
}
