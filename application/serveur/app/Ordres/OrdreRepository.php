<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Diplo\Parties\Partie;

interface OrdreRepository
{
    /**
     * Passe un ordre à une armée.
     *
     * @param Armee     $armee
     * @param $type 'Attaquer', 'SoutienOffensif', 'SoutienDefensif' ou 'Tenir'
     * @param CaseClass $case
     *
     * @return OrdreModel
     */
    public function passerOrdre(Armee $armee, $type, CaseClass $case = null);

    /**
     * Marquer tous les ordres d'une partie comme exécutés
     *
     * @param Partie $partie
     */
    public function marquerTousLesOrdresCommeExecutes(Partie $partie);
}
