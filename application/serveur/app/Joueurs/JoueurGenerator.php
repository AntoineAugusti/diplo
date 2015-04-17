<?php

namespace Diplo\Joueurs;

class JoueurGenerator
{
    /**
     * Génère un joueur à partir du numéro du joueur dans une partie.
     *
     * @param int $idDansPartie
     *
     * @return Joueur Le joueur correspondant à l'identifiant dans la partie
     */
    public function generate($idDansPartie)
    {
        $pays = $this->generatePays($this->idToIndex($idDansPartie));
        $pseudo = $this->generatePseudo($this->idToIndex($idDansPartie));

        return new Joueur(compact('pays', 'pseudo'));
    }

    /**
     * Transforme un identifiant dans une partie vers un index.
     *
     * @param int $id
     *
     * @return int
     */
    private function idToIndex($id)
    {
        return $id - 1;
    }

    /**
     * Génère un pseudo depuis un index.
     *
     * @param int $index
     *
     * @return string
     */
    private function generatePseudo($index)
    {
        $pseudos = [
            'Bob',
            'Alex',
            'Alice',
            'Manon',
            'Antoine',
            'Nathan',
            'Claudette',
            'Jules',
            'Capucine',
            'Bertrand',
            'Leonie',
        ];

        return $pseudos[$index];
    }

    /**
     * Génère un pays depuis un index.
     *
     * @param int $index
     *
     * @return string Le code du pays au format ISO 3166-1 alpha-3
     */
    private function generatePays($index)
    {
        $pays = [
            'FRA',
            'GBR',
            'BEL',
            'ESP',
            'CHE',
            'DEU',
            'ITA',
            'PRT',
            'IRL',
        ];

        return $pays[$index];
    }
}
