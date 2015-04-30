<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;

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
}
