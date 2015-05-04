<?php

namespace Diplo\Ordres;

use Diplo\Cartes\CaseInterface;

/**
 * Class OrdreCible.
 */
abstract class OrdreCible extends Ordre
{
    /**
     * @var CaseInterface
     */
    protected $caseCible;

    /**
     * @return CaseInterface
     */
    public function getCase()
    {
        return $this->caseCible;
    }

    /**
     * @param CaseInterface $case
     */
    public function setCase(CaseInterface $case)
    {
        $this->caseCible = $case;
    }
}
