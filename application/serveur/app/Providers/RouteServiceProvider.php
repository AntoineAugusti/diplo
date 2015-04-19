<?php

namespace Diplo\Providers;

use App;
use Diplo\Exceptions\ConversationIntrouvableException;
use Diplo\Exceptions\PartieIntrouvableException;
use Diplo\Messages\ConversationsRepository;
use Diplo\Parties\PartiesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

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
        $router->pattern('conversation', '[0-9]+');

        $partiesRepo = App::make(PartiesRepository::class);
        $router->bind('partie', function ($idPartie) use ($partiesRepo) {
            try {
                return $partiesRepo->trouverParId($idPartie);
            } catch (ModelNotFoundException $e) {
                throw new PartieIntrouvableException($idPartie);
            }
        });

        $conversationsRepo = App::make(ConversationsRepository::class);
        $router->bind('conversation', function ($idConversation) use ($conversationsRepo) {
            try {
                return $conversationsRepo->trouverParId($idConversation);
            } catch (ModelNotFoundException $e) {
                throw new ConversationIntrouvableException($idConversation);
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
