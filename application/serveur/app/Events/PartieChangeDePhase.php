<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

/**
 * Événement lancé quand une partie change de phase.
 * Si on était en phase de négociation, que celle-ci vient de se terminer
 * et que l'on passe en phase de combat, cet événement va être lancé avec
 * la phase "COMBAT".
 */
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
