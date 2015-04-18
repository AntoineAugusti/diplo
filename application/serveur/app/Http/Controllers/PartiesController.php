<?php

namespace Diplo\Http\Controllers;

use Diplo\Joueurs\Joueur;
use Diplo\Parties\Partie;
use Diplo\Parties\PartiesRepository;
use InvalidArgumentException;
use Response;

class PartiesController extends Controller
{
    /**
     * Retourne le statut d'une partie.
     *
     * @param Partie $partie La partie en question
     *
     * @return Response
     */
    public function getStatut(Partie $partie)
    {
        $statut = $partie->statut;
        $message = $this->statutVersMessage($statut);

        return Response::json(compact('statut', 'message'), 200);
    }

    /**
     * Retourne les joueurs d'une partie.
     *
     * @param Partie $partie La partie en question
     *
     * @return Response
     */
    public function getJoueurs(Partie $partie)
    {
        $joueurs = $partie->joueurs;
        $nb_joueurs = $joueurs->count();

        return Response::json(compact('joueurs', 'nb_joueurs'), 200);
    }

    /**
     * Demande à rejoindre une partie.
     *
     * @param Partie            $partie      La partie en question
     * @param PartiesRepository $partiesRepo
     *
     * @return Response
     */
    public function postRejoindre(Partie $partie, PartiesRepository $partiesRepo)
    {
        $joueur = $partiesRepo->rejoindre($partie->id);

        $data = $this->prepareReponseRejoindre($partie, $joueur);

        return Response::json($data, 201);
    }

    /**
     * Prépare la réponse pour rejoindre une partie.
     *
     * @param Partie $partie [description]
     * @param Joueur $joueur [description]
     *
     * @return array Contient le joueur et la partie
     */
    private function prepareReponseRejoindre(Partie $partie, Joueur $joueur)
    {
        $clesAGarder = ['id', 'pseudo', 'pays'];
        $joueur = $this->gardeClesPourTableau($joueur->toArray(), $clesAGarder);

        $clesAGarder = ['id', 'nb_joueurs_requis', 'nb_joueurs_inscrits'];
        $partie = $this->gardeClesPourTableau($partie->toArray(), $clesAGarder);

        return compact('joueur', 'partie');
    }

    /**
     * Détermine le message associé à un statut.
     *
     * @param string $statut Le statut d'une partie
     *
     * @return string
     *
     * @throws InvalidArgumentException Le statut ne peut pas être résolu
     */
    private function statutVersMessage($statut)
    {
        if (!in_array($statut, Partie::statutsPossibles())) {
            throw new InvalidArgumentException('Statut inconnu : '.$statut);
        }

        switch ($statut) {
            case Partie::ATTENTE_JOUEURS:
                return "Il n'y a pas assez de joueurs pour démarrer la partie";

            case Partie::EN_JEU:
                return 'La partie est en cours';

            case Partie::FIN:
                return 'La partie est terminée';
        }
    }
}
