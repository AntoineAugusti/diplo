<?php

namespace Diplo\Providers;

use Diplo\Joueurs\EloquentJoueursRepository;
use Diplo\Joueurs\JoueurGenerator;
use Diplo\Joueurs\JoueurGeneratorInterface;
use Diplo\Joueurs\JoueursRepository;
use Diplo\Messages\ConversationsRepository;
use Diplo\Messages\EloquentConversationsRepository;
use Diplo\Parties\EloquentPartiesRepository;
use Diplo\Parties\PartiesRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            PartiesRepository::class,
            EloquentPartiesRepository::class
        );

        $this->app->bind(
            JoueursRepository::class,
            EloquentJoueursRepository::class
        );

        $this->app->bind(
            ConversationsRepository::class,
            EloquentConversationsRepository::class
        );

        $this->app->bind(
            JoueurGeneratorInterface::class,
            JoueurGenerator::class
        );
    }
}
