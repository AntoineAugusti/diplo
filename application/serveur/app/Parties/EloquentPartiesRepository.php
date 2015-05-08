<?php

namespace Diplo\Parties;

use Diplo\Events\PartiePreteACommencer;
use Diplo\Exceptions\PartiePleineException;
use Diplo\Joueurs\JoueurGeneratorInterface;
use Illuminate\Events\Dispatcher as Event;

class EloquentPartiesRepository implements PartiesRepository
{
    /**
     * @var JoueurGeneratorInterface
     */
    private $joueurGenerator;

    /**
     * @var Event
     */
    private $event;

    public function __construct(JoueurGeneratorInterface $joueurGenerator, Event $event)
    {
        $this->joueurGenerator = $joueurGenerator;
        $this->event = $event;
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
    public function rejoindre($id)
    {
        $partie = $this->trouverParId($id);

        // Vérifions que la partie n'est pas pleine
        if ($partie->estPleine()) {
            throw new PartiePleineException($id);
        }

        // Génération et ajout du joueur dans la partie
        $partie->nb_joueurs_inscrits = $partie->nb_joueurs_inscrits + 1;
        $joueur = $this->joueurGenerator->generate($partie->nb_joueurs_inscrits);
        $joueur->id_partie = $id;

        $partie->save();
        $joueur->save();

        // La partie est maintenant pleine
        // On lève l'événement disant que la partie peut démarrer
        if ($partie->estPleine()) {
            $this->event->fire(new PartiePreteACommencer($partie));
        }

        return $joueur;
    }
}
