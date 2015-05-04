<?php

namespace Diplo\Ordres;

class TenirExecuteur extends OrdreExecuteur
{
    /**
     * Exécute l'ordre.
     *
     * @param Ordre   $ordre
     * @param Ordre[] $autresOrdres
     */
    public function executer(Ordre $ordre, array $autresOrdres)
    {
    }

    /**
     * Vérifie si l'ordre est possible.
     *
     * @param Ordre $ordre
     *
     * @return bool
     */
    public function verifierOrdre(Ordre $ordre)
    {
        return $ordre instanceof Tenir;
    }
}
