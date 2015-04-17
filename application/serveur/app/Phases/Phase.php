<?php

namespace Diplo\Phases;

abstract class Phase
{
    /**
     * Détermine si une phase est une phase de négociation.
     *
     * @return bool
     */
    abstract public function estNegociation();

    /**
     * Détermine si une phase est une phase de combat.
     *
     * @return bool
     */
    abstract public function estCombat();
}
