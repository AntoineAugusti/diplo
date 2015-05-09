<?php

namespace Diplo\Parties;

use Diplo\Exceptions\PartiePleineException;
use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface PartiesRepository
{
    /**
     * Trouve une partie à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Partie
     *
     * @throws ModelNotFoundException La partie n'a pas été trouvée
     */
    public function trouverParId($id);

    /**
     * Demande à rejoindre une partie, crée un joueur et le met dans la partie.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Joueur
     *
     * @throws ModelNotFoundException La partie n'a pas été trouvée
     * @throws PartiePleineException  La partie est pleine
     *
     * @event PartiePreteACommencer La partie est prête à commencer
     */
    public function rejoindre($id);
}
