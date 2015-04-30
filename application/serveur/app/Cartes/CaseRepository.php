<?php namespace Diplo\Cartes;

use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CaseRepository
{
    /**
     * Trouve une case à l'aide de son identifiant.
     *
     * @param int $id L'identifiant de la case
     * @return CaseClass
     *
     * @throws ModelNotFoundException La case n'a pas été trouvée
     */
    public function trouverParId($id);
}
