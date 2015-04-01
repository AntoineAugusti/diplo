<?php namespace Diplo\Tours;

/**
 * Class TourAutomne
 * @author Etienne Batise
 */
abstract class TourAutomne extends Tours
{
    /**
     * undocumented function
     *
     * @return boolean
     */
    public function estPrintemps()
    {
        return false;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function estAutomne()
    {
        return true;
    }
}
