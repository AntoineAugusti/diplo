<?php

namespace Diplo\Handlers\Events;

use Diplo\Cartes\CarteFactory;
use Diplo\Events\CarteAEteCreee;
use Diplo\Events\PartiePreteACommencer;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Events\Dispatcher as Event;

class CreerCarte implements ShouldBeQueued
{
    /**
     * @var CarteFactory
     */
    private $factory;

    /**
     * @var Event
     */
    private $event;

    /**
     * Create the event handler.
     *
     * @param CarteFactory $factory
     */
    public function __construct(CarteFactory $factory, Event $event)
    {
        $this->factory = $factory;
        $this->event = $event;
    }

    /**
     * Crée la carte et place les armées aux positions initiales.
     *
     * @param PartiePreteACommencer $event
     */
    public function handle(PartiePreteACommencer $event)
    {
        $partie = $event->partie;

        $this->factory->creer($partie);

        $this->event->fire(new CarteAEteCreee($partie));
    }
}
