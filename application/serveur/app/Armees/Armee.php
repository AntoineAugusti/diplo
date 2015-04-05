<?php namespace Diplo\Armees;

use Diplo\Cartes\CaseInterface;
use Diplo\Ordres\Ordre;

abstract class Armee {
	
	private $proprietaire;

	private $case;

	private $ordre;

	public function setProprietaire(Joueur $j)
	{
		$this->proprietaire = $j;
	}

	public function getProprietaire()
	{
		return $this->proprietaire;
	}

	public function setCase(CaseInterface $c)
	{
		$this->case = $c;
	}

	public function getCase()
	{
		return $this->case;
	}

    public function setOrdre(Ordre $o)
	{
		$this->ordre = $o;
	}

    public function getOrdre()
	{
		return $this->ordre;
	}

	public function estArmeeMaritime()
	{
		return false;
	}

	public function estArmeeTerrestre()
	{
		return false;
	}
}
