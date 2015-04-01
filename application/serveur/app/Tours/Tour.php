<?php namespace Diplo\Tours;

/**
 * Class Tours
 * @author John Doe
 */
abstract class Tours
{
    /**
     * undocumented class variable
     *
     * string : $type
     */
    private $type;

    /**
     * undocumented class variable
     *
     * Phase : $phaseCourante 
     */
    private $phaseCourante;


    /**
     * undocumented function
     *
     * @return boolean
     */
    abstract public function estAutomne();

    /**
     * undocumented function
     *
     * @return boolean
     */
    abstract public function estPrintemps();

    /**
     * undocumented function
     *
     * @return boolean
     */
    public function phaseEstNegociation()
    {
        return $phaseCourante.estNegociation();
    }

    /**
     * undocumented function
     *
     * @return boolean
     */
    public function phaseEstCombat()
    {
        return $phaseCourante.estCombat();
    }

    /**
     * undocumented function
     *
     * @return boolean
     */
    public function setPhase(Phase $p)
    {
        $phaseCourante = $p;
    }

}
