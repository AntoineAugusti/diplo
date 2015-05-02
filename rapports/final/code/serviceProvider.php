<?php

namespace Insa\Recipes;

use Illuminate\Support\ServiceProvider;
use Diplo\Http\Controllers\PartiesController;

class RecipesServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Récupération du nom de la classe
        $controller = PartiesController::class;

        $this->app['router']->get('/', [
            // Le nom de la route
            'as'   => 'recipes.index',
            // Définition du contrôleur et de la méthode
            'uses' => $controller.'@index'
        ]);
    }
}
