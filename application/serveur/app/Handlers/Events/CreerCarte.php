<?php

namespace Diplo\Handlers\Events;

use Diplo\Cartes\CarteFactory;
use Diplo\Events\PartiePreteACommencer;

class CreerCarte
{
    /**
     * @var CarteFactory
     */
    protected $factory;

    /**
     * Create the event handler.
     *
     * @param CarteFactory $factory
     */
    public function __construct(CarteFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle the event.
     *
     * @param PartiePreteACommencer $event
     */
    public function handle(PartiePreteACommencer $event)
    {
        $partie = $event->partie;

        $this->factory->creer($partie);
    }
}
