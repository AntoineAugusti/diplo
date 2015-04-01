<?php namespace Diplo\Tours;

/**
 * Class Phase
 * @author Etienne Batise
 */
class PhaseNegociation
{
    /**
     * undocumented function
     *
     * @return void
     * @author Etienne Batise
     */
    public function __construct($options)
    {
        $type = "PhaseNegociation";
    }

    /**
     * undocumented function
     *
     * @return boolean : true
     */
    public function estNegociation()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return boolean : false
     */
    public function estCombat()
    {
        return false;
    }

}
