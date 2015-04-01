<?php namespace Diplo\Tours;

/**
 * Class TourPrintemps
 * @author Etienne Batise
 */
abstract class TourPrintemps extends Tours
{
    /**
     * undocumented function
     *
     * @return boolean
     */
    public function estAutomne()
    {
        return false;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function estPrintemps()
    {
        return true;
    }
}
