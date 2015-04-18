<?php

namespace Diplo\Phases;

interface PhaseInterface
{
    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    public function estNegociation();

    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    public function estCombat();
}
