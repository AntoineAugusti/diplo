<?php

namespace Diplo\Joueurs;

interface JoueursRepository
{
    /**
     * Trouve un joueur à l'aide de son identifiant.
     *
     * @param int $id L'identifiant du joueur
     *
     * @return Joueur
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Le joueur n'a pas été trouvé
     */
    public function trouverParId($id);
}
