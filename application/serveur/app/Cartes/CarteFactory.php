<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;
use Diplo\Parties\Partie;

class CarteFactory
{
    /**
     * Les cases de la carte.
     *
     * @var array
     */
    protected $cases = [];

    /**
     * La taille du carré de la carte.
     *
     * @var int
     */
    protected $tailleCarre = 15;

    /**
     * Les positions des armées initiales sur les cases.
     *
     * @var array
     */
    protected $positions = [
        [[1,1], [1,3], [3,1], [3,3]],
        [[1,13], [1,15], [3,13], [3,15]],
        [[6,6], [6,9], [9,6], [9,9]],
        [[13,1], [13,3], [15,1], [15,3]],
        [[13,13], [13,15], [15,13], [15,15]],
    ];

    /**
     * Crée une partie.
     *
     * @param Partie $partie
     */
    public function creer(Partie $partie)
    {
        // Crée une carte de $this->tailleCarre x $this->tailleCarre
        for ($i = 1; $i < $this->tailleCarre + 1; $i++) {
            for ($j = 1; $j < $this->tailleCarre + 1; $j++) {
                $this->cases[$i][$j] = CaseClass::create([]);
            }
        }

        // On définit les cases voisines
        for ($i = 1; $i < $this->tailleCarre + 1; $i++) {
            for ($j = 1; $j < $this->tailleCarre + 1; $j++) {
                $ids = [];

                if ($i != 1) {
                    $ids[] = $this->cases[$i - 1][$j]->id;
                }

                if ($i != $this->tailleCarre) {
                    $ids[] = $this->cases[$i + 1][$j]->id;
                }

                if ($j != 1) {
                    $ids[] = $this->cases[$i][$j - 1]->id;
                }

                if ($j != $this->tailleCarre) {
                    $ids[] = $this->cases[$i][$j + 1]->id;
                }

                $this->getCase($i, $j)->casesVoisines()->sync($ids);
            }
        }

        // On ajoute les armées sur les cases
        $idJoueurDansPartie = 0;
        foreach ($partie->getJoueurs() as $joueur) {
            $this->definirPositionsArmeesPourJoueur($joueur, $idJoueurDansPartie);
            $idJoueurDansPartie++;
        }
    }

    /**
     * Définit les emplacements initiaux des armées pour un jour.
     *
     * @param Joueur $joueur
     * @param int    $id     Le numéro du joueur au sein de la partie, de 0 à (nbJoueursMax - 1)
     */
    private function definirPositionsArmeesPourJoueur(Joueur $joueur, $id)
    {
        foreach ($this->positions[$id] as $positions) {
            $armee = new Armee();
            $armee->id_case = $this->getCase($positions[0], $positions[1])->id;
            $joueur->armees()->save($armee);
        }
    }

    /**
     * Accède à la case à la position demandée.
     *
     * @param int $i
     * @param int $j
     *
     * @return CaseInterface
     */
    protected function getCase($i, $j)
    {
        return $this->cases[$i][$j];
    }
}
