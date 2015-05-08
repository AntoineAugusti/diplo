<?php

namespace Diplo\Providers;

use Diplo\Events\CarteAEteCreee;
use Diplo\Events\PartieChangeDeTour;
use Diplo\Events\PartieEstTerminee;
use Diplo\Events\PartiePreteACommencer;
use Diplo\Handlers\Events\CloturerPartie;
use Diplo\Handlers\Events\CreerCarte;
use Diplo\Handlers\Events\DemarragePartie;
use Diplo\Handlers\Events\ExecuterOrdres;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PartiePreteACommencer::class => [
            CreerCarte::class,
        ],
        CarteAEteCreee::class => [
            DemarragePartie::class,
        ],
        PartieEstTerminee::class => [
            CloturerPartie::class,
        ],
        PartieChangeDeTour::class => [
            ExecuterOrdres::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
