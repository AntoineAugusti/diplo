<?php

namespace Diplo\Ordres;

abstract class OrdreCibleExecuteur extends OrdreExecuteur
{
    /**
     * Vérifie si la case cible est une case voisine.
     *
     * @param OrdreCible $ordre
     *
     * @return bool
     */
    protected function verifierSiCaseCibleEstCaseVoisine(OrdreCible $ordre)
    {
        $casesVoisinesDeLArmee = $ordre->getArmee()->getCase()->getCasesVoisinesIds();

        return in_array($ordre->getCase(), $casesVoisinesDeLArmee);
    }
}
