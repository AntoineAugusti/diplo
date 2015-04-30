<?php namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;

class EloquentOrdreRepository implements OrdreRepository
{
    /**
     * Passe un ordre à une armée.
     *
     * @param Armee $armee
     * @param $type 'Attaquer', 'SoutienOffensif', 'SoutienDefensif' ou 'Tenir'
     * @param CaseClass $case
     * @return OrdreModel
     */
    public function passerOrdre(Armee $armee, $type, CaseClass $case = null)
    {
        return OrdreModel::create([
            'type' => $type,
            'id_armee' => $armee->id,
            'id_case' => $case->id
        ]);
    }
}
