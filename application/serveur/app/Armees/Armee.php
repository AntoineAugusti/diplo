<?php namespace Diplo\Armees;

use Diplo\Cartes\CaseInterface;
use Diplo\Ordres\Ordre;

/**
 * Classe qui gère les armées d'un Joueur
 */
abstract class Armee {
	
    /**
     * Le joueur proprietaire de l'armee
     *
     * @var Joueur
     */
	private $proprietaire;

    /**
     * La case sur laquelle se trouve l'armee
     *
     * @var Case
     */
	private $case;

    /**
     * Le prochaine ordre que l'armee va executer
     *
     * @var Ordre
     */
	private $ordre; 

    /**
     * Change le proprietaire de cette armee
     *
     * @var Joueur
     */
	public function setProprietaire(Joueur $j)
	{
		$this->proprietaire = $j;
	}

	public function getProprietaire()
	{
		return $this->proprietaire;
	}

    /**
     * Change la case sur laquelle se trouve cette armee
     *
     * @var CaseInterface
     */
	public function setCase(CaseInterface $c)
	{
		$this->case = $c;
	}

	public function getCase()
	{
		return $this->case;
	}

    /**
     * Donne le prochain ordre de l'armee
     *
     * @var Ordre
     */
    public function setOrdre(Ordre $o)
	{
		$this->ordre = $o;
	}

    public function getOrdre()
	{
		return $this->ordre;
	}

    /**
     * @return false
     */
	public function estArmeeMaritime()
	{
		return false;
	}

    /**
     * @return false
     */
	public function estArmeeTerrestre()
	{
		return false;
	}
}
