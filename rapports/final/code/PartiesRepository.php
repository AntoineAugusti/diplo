<?php

namespace Diplo\Parties;

interface PartiesRepository
{
    /**
     * Trouve une partie à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Partie
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La partie n'a pas été trouvée
     */
    public function trouverParId($id);

    /**
     * Demande à rejoindre une partie, crée un joueur et le met dans la partie.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Diplo\Joueurs\Joueur
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La partie n'a pas été trouvée
     * @throws \Diplo\Exceptions\PartiePleineException              La partie est pleine
     *
     * @event PartiePreteACommencer La partie est prête à commencer
     */
    public function rejoindre($id);
}
