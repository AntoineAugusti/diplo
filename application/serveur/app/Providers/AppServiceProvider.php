<?php

namespace Diplo\Providers;

use Diplo\Armees\ArmeeRepository;
use Diplo\Armees\EloquentArmeeRepository;
use Diplo\Cartes\CaseRepository;
use Diplo\Cartes\EloquentCaseRepository;
use Diplo\Joueurs\EloquentJoueursRepository;
use Diplo\Joueurs\JoueurGenerator;
use Diplo\Joueurs\JoueurGeneratorInterface;
use Diplo\Joueurs\JoueursRepository;
use Diplo\Messages\ConversationsRepository;
use Diplo\Messages\EloquentConversationsRepository;
use Diplo\Ordres\EloquentOrdreRepository;
use Diplo\Ordres\OrdreRepository;
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

        $this->app->bind(
            OrdreRepository::class,
            EloquentOrdreRepository::class
        );

        $this->app->bind(
            ArmeeRepository::class,
            EloquentArmeeRepository::class
        );

        $this->app->bind(
            CaseRepository::class,
            EloquentCaseRepository::class
        );
    }
}
