<?php

namespace Diplo\Phases;

class PhaseNegociation implements PhaseInterface
{
    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    public function estNegociation()
    {
        return true;
    }

    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    public function estCombat()
    {
        return false;
    }
}
