<?php

namespace Diplo\Parties;

use Diplo\Joueurs\JoueurGeneratorInterface;
use Diplo\Exceptions\PartiePleineException;

class EloquentPartiesRepository implements PartiesRepository
{
    /**
     * @var \Diplo\Joueurs\JoueurGeneratorInterface
     */
    private $joueurGenerator;

    public function __construct(JoueurGeneratorInterface $joueurGenerator)
    {
        $this->joueurGenerator = $joueurGenerator;
    }

    /**
     * Trouve une partie à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Partie
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La partie n'a pas été trouvée
     */
    public function trouverParId($id)
    {
        return Partie::findOrFail($id);
    }

    /**
     * Demande à rejoindre une partie, crée un joueur et le met dans la partir.
     *
     * @param int $id L'identifiant de la partie
     *
     * @return Diplo\Joueurs\Joueur
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La partie n'a pas été trouvée
     * @throws \Diplo\Exceptions\PartiePleineException              La partie est pleine
     */
    public function rejoindre($id)
    {
        $partie = $this->trouverParId($id);

        // Vérifions que la partie n'est pas pleine
        if ($partie->nb_joueurs_inscrits >= $partie->nb_joueurs_requis) {
            throw new PartiePleineException();
        }

        // Génération et ajout du joueur dans la partie
        $partie->nb_joueurs_inscrits = $partie->nb_joueurs_inscrits + 1;
        $joueur = $this->joueurGenerator->generate($partie->nb_joueurs_inscrits);
        $joueur->id_partie = $id;

        $partie->save();
        $joueur->save();

        return $joueur;
    }
}
