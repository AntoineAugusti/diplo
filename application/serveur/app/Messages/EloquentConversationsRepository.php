<?php

namespace Diplo\Messages;

use Diplo\Exceptions\ConversationExistanteException;
use Diplo\Exceptions\JoueurDupliqueException;
use Diplo\Exceptions\JoueurInexistantConversationException;
use Diplo\Exceptions\PasAssezDeJoueursException;
use Diplo\Joueurs\JoueursRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentConversationsRepository implements ConversationsRepository
{
    /**
     * @var JoueursRepository
     */
    private $joueurRepo;

    public function __construct(JoueursRepository $joueurRepo)
    {
        $this->joueurRepo = $joueurRepo;
    }

    /**
     * Trouve une conversation à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la conversation
     *
     * @return Conversation
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException La conversation n'a pas été trouvée
     */
    public function trouverParId($id)
    {
        return Conversation::findOrFail($id);
    }

    /**
     * Demande à créer une conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return Conversation
     *
     * @throws PasAssezDeJoueursException            Une conversation doit être créée au moins entre 2 joueurs
     * @throws JoueurInexistantConversationException Un des joueurs n'existe pas
     * @throws ConversationExistanteException        Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException               Un joueur ne peut être plus d'une fois dans la même conversation
     */
    public function creerConversation(array $idsJoueurs)
    {
        $this->verifiePossibiliteCreerConversation($idsJoueurs);

        // On crée la conversation et on ajoute les joueurs
        $conversation = Conversation::create([]);
        foreach ($idsJoueurs as $idJoueur) {
            try {
                $joueur = $this->joueurRepo->trouverParId($idJoueur);
            } catch (ModelNotFoundException $e) {
                throw new JoueurInexistantConversationException();
            }
            $conversation->joueurs()->save($joueur);
        }

        return $conversation;
    }

    /**
     * Vérifie qu'il est possible de créer la conversation entre plusieurs joueurs.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @throws PasAssezDeJoueursException     Une conversation doit être créée au moins entre 2 joueurs
     * @throws ConversationExistanteException Une conversation entre ces joueurs existait déjà
     * @throws JoueurDupliqueException        Un joueur ne peut être plus d'une fois dans la même conversation
     */
    private function verifiePossibiliteCreerConversation(array $idsJoueurs)
    {
        // Vérifions qu'il y a au moins 2 joueurs dans la conversation
        if (count($idsJoueurs) < 2) {
            throw new PasAssezDeJoueursException();
        }

        if ($this->tableauPossedeDoublons($idsJoueurs)) {
            throw new JoueurDupliqueException();
        }

        // Vérifions qu'une conversation entre ces joueurs n'existe pas
        if ($this->conversationEntreJoueursExiste($idsJoueurs)) {
            throw new ConversationExistanteException();
        }
    }

    /**
     * Détermine si un tableau possède des valeurs en double.
     *
     * @param array $a
     *
     * @return bool
     */
    private function tableauPossedeDoublons(array $a)
    {
        return count($a) !== count(array_unique($a));
    }

    /**
     * Indique si une conversation entre joueurs données en paramètre existe déjà.
     *
     * @param array $idsJoueurs Les identifiants des joueurs
     *
     * @return bool
     */
    private function conversationEntreJoueursExiste(array $idsJoueurs)
    {
        sort($idsJoueurs);

        foreach (Conversation::all() as $conversation) {
            if ($conversation->joueursIds() == $idsJoueurs) {
                return true;
            }
        }

        return false;
    }
}
