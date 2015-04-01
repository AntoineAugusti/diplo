<?php namespace Diplo\Tours;

/**
 * Class Phase
 * @author John Doe
 */
class PhaseCombat
{
    public function __construct($options)
    {
        $type = "PhaseCombat";
    }

    /**
     * undocumented function
     *
     * @return boolean : true
     */
    public function estCombat()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return boolean : false
     */
    public function estNegociation()
    {
        return false;
    }

}
