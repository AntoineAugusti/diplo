<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

/**
 * Événement lancé quand une partie change de tour.
 * À la fin du tour 1 (en phase de combat), on va passer
 * en phase de négociation mais dans le tour 2. Cet événement
 * est lancé quand la partie passe au tour numéro, avec le numéro
 * de tour valant 2.
 */
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
