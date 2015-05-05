<?php

namespace Diplo\Ordres;

class SoutienDefensifExecuteur extends OrdreCibleExecuteur
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
        if (!($ordre instanceof SoutienDefensif)) {
            return false;
        }

        return $this->verifierSiCaseCibleEstCaseVoisine($ordre);
    }
}
