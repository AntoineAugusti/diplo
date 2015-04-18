<?php

namespace Diplo\Http\Controllers;

use Response;

class WelcomeController extends Controller
{
    /**
     * Souhaite la bienvenue et donne des informations utiles.
     *
     * @return Response
     */
    public function showWelcome()
    {
        $documentation_url = 'https://developers.diplo-lejeu.fr';
        $project_url = 'https://github.com/AntoineAugusti/diplo';

        return Response::json(compact('documentation_url', 'project_url'), 200);
    }
}
