<?php namespace Diplo\Parties;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Diplo\Cartes\CaseInterface;

class PartieFactory
{
    protected $cases = [];

    protected $nbCases = 15;

    protected $positions = [
        [[1,1], [1,3], [3,1], [3,3]],
        [[1,13], [1,15], [3,13], [3,15]],
        [[6,6], [6,9], [9,6], [9,9]],
        [[13,1], [13,3], [15,1], [15,3]],
        [[13,13], [13,15], [15,13], [15,15]]
    ];

    public function create(Partie $partie)
    {
        // Create a $this->nbCases x $this->nbCases map
        for($i = 1; $i < $this->nbCases + 1; $i++)
        {
            for($j = 1; $j < $this->nbCases + 1; $j++)
            {
                $this->cases[$i][$j] = new CaseClass();
            }
        }

        // Bind neighbor
        for($i = 1; $i < $this->nbCases + 1; $i++)
        {
            for($j = 1; $j < $this->nbCases + 1; $j++)
            {
                $ids = [];

                if ($i != 1)
                    $ids[] = $this->cases[$i - 1][$j]->id;

                if ($i != $this->nbCases)
                    $ids[] = $this->cases[$i + 1][$j]->id;

                if ($j != 1)
                    $ids[] = $this->cases[$i][$j - 1]->id;

                if ($j != $this->nbCases)
                    $ids[] = $this->cases[$i][$j + 1]->id;

                $this->getCase($i, $j)->casesVoisines()->sync($ids);
            }
        }

        // Add armee
        $i = 0;
        foreach ($partie->getJoueurs() as $joueur)
        {
            foreach ($this->positions[$i] as $positions)
            {
                $armee = new Armee();
                $joueur->armees()->save($armee);

                $this->getCase($positions[0], $positions[1])->armee()->save($armee);
            }

            $i++;
        }
    }

    /**
     * @return CaseInterface
     */
    protected function getCase($i, $j)
    {
        return $this->cases[$i][$j];
    }
}
