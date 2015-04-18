<?php

namespace Diplo\Providers;

use Diplo\Parties\EloquentPartiesRepository;
use Diplo\Parties\PartiesRepository;
use Diplo\Joueurs\JoueurGeneratorInterface;
use Diplo\Joueurs\JoueurGenerator;
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
            JoueurGeneratorInterface::class,
            JoueurGenerator::class
        );
    }
}
