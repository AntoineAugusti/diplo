<?php

namespace Diplo\Providers;

use App;
use Illuminate\Routing\Router;
use Diplo\Parties\PartiesRepository;
use Diplo\Exceptions\PartieIntrouvableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Diplo\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->pattern('partie', '[0-9]+');

        $partiesRepo = App::make(PartiesRepository::class);
        $router->bind('partie', function ($id_partie) use ($partiesRepo) {
            try {
                return $partiesRepo->trouverParId($id_partie);
            } catch (ModelNotFoundException $e) {
                throw new PartieIntrouvableException($id_partie);
            }
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
