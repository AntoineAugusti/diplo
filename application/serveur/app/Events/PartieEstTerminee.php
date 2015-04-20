<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

class PartieEstTerminee extends Event
{
    use SerializesModels;

    /**
     * @var Partie
     */
    public $partie;

    /**
     * Constructeur.
     *
     * @param Partie $partie La partie
     */
    public function __construct(Partie $partie)
    {
        $this->partie = $partie;
    }
}
