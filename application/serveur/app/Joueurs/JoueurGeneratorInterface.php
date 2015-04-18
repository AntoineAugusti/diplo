<?php

namespace Diplo\Joueurs;

interface JoueurGeneratorInterface
{
    /**
     * Génère un joueur à partir du numéro du joueur dans une partie.
     *
     * @param int $idDansPartie
     *
     * @return Joueur Le joueur correspondant à l'identifiant dans la partie
     */
    public function generate($idDansPartie);
}
