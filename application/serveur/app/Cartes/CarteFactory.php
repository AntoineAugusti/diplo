<?php

namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Armees\ArmeeRepository;
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
    protected $tailleCarre = 10;

    /**
     * Les positions des armées initiales sur les cases.
     *
     * @var array
     */
    protected $positions = [
        [[1,1], [1,2], [2,1], [2,2]],
        [[1,9], [1,10], [2,9], [2,10]],
        [[5,5], [5,6], [6,5], [6,6]],
        [[9,1], [9,2], [10,1], [10,2]],
        [[9,9], [9,10], [10,9], [10,10]],
    ];

    /**
     * @var ArmeeRepository
     */
    private $armeeRepository;

    /**
     * @param ArmeeRepository $armeeRepository
     */
    public function __construct(ArmeeRepository $armeeRepository)
    {
        $this->armeeRepository = $armeeRepository;
    }

    /**
     * Crée une partie.
     *
     * @param Partie $partie
     */
    public function creer(Partie $partie)
    {
        $carte = Carte::create([
            'id_partie' => $partie->getId(),
        ]);

        // Crée une carte de $this->tailleCarre x $this->tailleCarre
        for ($i = 1; $i < $this->tailleCarre + 1; $i++) {
            for ($j = 1; $j < $this->tailleCarre + 1; $j++) {
                $this->cases[$i][$j] = CaseClass::create([
                    'id_carte' => $carte->getId(),
                ]);
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

                $this->getCase($i, $j)->setCasesVoisinesIds($ids);
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
            $armee = $joueur->armees()->save($armee);

            $this->armeeRepository->deplacerArmee(
                $armee,
                $this->getCase($positions[0], $positions[1])
            );
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
