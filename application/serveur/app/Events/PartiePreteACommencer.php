<?php

namespace Diplo\Events;

use Illuminate\Queue\SerializesModels;
use Diplo\Parties\Partie;

class PartiePreteACommencer extends Event
{
    use SerializesModels;

    /**
     * @var Partie
     */
    public $partie;

    /**
     * Create a new event instance.
     */
    public function __construct(Partie $partie)
    {
        $this->partie = $partie;
    }
}
