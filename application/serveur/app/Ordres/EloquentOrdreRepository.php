<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Diplo\Parties\Partie;

class EloquentOrdreRepository implements OrdreRepository
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
    public function passerOrdre(Armee $armee, $type, CaseClass $case = null)
    {
        return OrdreModel::create([
            'type' => $type,
            'id_armee' => $armee->id,
            'id_case' => is_null($case) ? null : $case->id,
        ]);
    }

    /**
     * Marquer tous les ordres d'une partie comme exécutés
     *
     * @param Partie $partie
     */
    public function marquerTousLesOrdresCommeExecutes(Partie $partie)
    {
        $idsArmees = $partie->getArmees()->lists('id');

        OrdreModel::whereIn('id_armee', $idsArmees)->update([
            'execute' => true
        ]);
    }
}
