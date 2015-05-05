<?php

namespace Diplo\Armees;

use Diplo\Cartes\CaseInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentArmeeRepository implements ArmeeRepository
{
    /**
     * Trouve une armée à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de l'armée
     *
     * @return Armee
     *
     * @throws ModelNotFoundException L'armée n'a pas été trouvée
     */
    public function trouverParId($id)
    {
        return Armee::findOrFail($id);
    }

    /**
     * Déplace une armée sur une case.
     *
     * @param Armee         $armee
     * @param CaseInterface $case
     */
    public function deplacerArmee(Armee $armee, CaseInterface $case)
    {
        $case->setArmee($case);
    }

    /**
     * Détruit une armée.
     *
     * @param Armee $armee
     */
    public function detruireArmee(Armee $armee)
    {
        $armee->delete();
    }
}
