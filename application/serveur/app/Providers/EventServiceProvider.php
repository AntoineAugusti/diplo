<?php

namespace Diplo\Providers;

use Diplo\Events\PartieEstTerminee;
use Diplo\Events\PartiePreteACommencer;
use Diplo\Handlers\Events\CloturerPartie;
use Diplo\Handlers\Events\CreerCarte;
use Diplo\Handlers\Events\DemarragePartie;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
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
            DemarragePartie::class,
            CreerCarte::class,
        ],
        PartieEstTerminee::class => [
            CloturerPartie::class,
        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
