<?php

namespace Diplo\Ordres;

abstract class OrdreExecuteur
{
    /**
     * Exécute l'ordre.
     *
     * @param Ordre   $ordre
     * @param Ordre[] $autresOrdres
     */
    abstract public function executer(Ordre $ordre, array $autresOrdres);

    /**
     * Vérifie si l'ordre est possible.
     *
     * @param Ordre $ordre
     *
     * @return bool
     */
    abstract public function verifierOrdre(Ordre $ordre);
}
