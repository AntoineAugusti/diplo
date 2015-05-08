<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

class CarteAEteCreee extends Event
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
