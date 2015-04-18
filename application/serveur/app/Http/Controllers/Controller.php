<?php

namespace Diplo\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    /**
     * Garde un ensemble de clés d'un tableau.
     *
     * @param array $a     Le tableau de données
     * @param array $garde Les clés à garder
     *
     * @return array
     */
    protected function gardeClesPourTableau(array $a, array $garde)
    {
        $supprime = array_diff(array_keys($a), $garde);

        return $this->enleveClesPourTableau($a, $supprime);
    }

    /**
     * Enlève un ensemble de clés d'un tableau.
     *
     * @param array $a        Le tableau de données
     * @param array $supprime Les clés à supprimer
     *
     * @return array
     */
    protected function enleveClesPourTableau(array $a, array $supprime)
    {
        return array_diff_key($a, array_flip($supprime));
    }
}
