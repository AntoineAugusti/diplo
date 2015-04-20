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

    /**
     * Trouve plusieurs joueurs depuis un ensemble d'identifiants.
     *
     * @param array $ids Les identifiants des joueurs
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function trouverParIds(array $ids);
}
