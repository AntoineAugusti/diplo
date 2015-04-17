<?php

namespace Diplo\Phases;

class PhaseCombat
{
    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    public function estCombat()
    {
        return true;
    }

    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    public function estNegociation()
    {
        return false;
    }
}
