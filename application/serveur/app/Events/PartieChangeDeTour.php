<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

class PartieChangeDeTour extends Event
{
    use SerializesModels;

    /**
     * @var Partie
     */
    public $partie;

    /**
     * Le nouveau tour.
     *
     * @var string
     */
    public $tour;

    /**
     * Constructeur.
     *
     * @param Partie $partie La partie
     * @param int    $tour   Le nouveau tour
     */
    public function __construct(Partie $partie, $tour)
    {
        $this->partie = $partie;
        $this->tour  = $tour;
    }
}
