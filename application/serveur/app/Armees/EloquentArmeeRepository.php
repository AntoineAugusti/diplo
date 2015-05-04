<?php

namespace Diplo\Armees;

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
     * @param Armee $armee
     * @param int   $caseId
     */
    public function deplacerArmee(Armee $armee, $caseId)
    {
        $armee->id_case = $caseId;
        $armee->save();
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
