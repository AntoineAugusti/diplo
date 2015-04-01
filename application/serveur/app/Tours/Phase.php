<?php namespace Diplo\Tours;

/**
 * Class Phase
 * @author Etienne Batise
 */
abstract class Phase
{
    private $type;

    /**
     * undocumented function
     *
     * @return boolean
     */
    abstract public function estNegociation();

    /**
     * undocumented function
     *
     * @return boolean
     */
    abstract public function estCombat();

}
