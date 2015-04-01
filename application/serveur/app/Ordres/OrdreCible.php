<?php namespace Diplo\Ordres;

use Diplo\Cartes\CaseInterface;

abstract class OrdreCible extends Ordre {
	
	private $caseCible;

	public function getCase()
	{
		return $this->caseCible;
	}

	public function setCase(CaseInterface $c)
	{
		$this->caseCible = $c;
	}

	public function estAttaque()
	{
		return false;
	}

	public function estSoutienDefensif()
	{
		return false;
	}

	public function estSoutienOffensif()
	{
		return false;
	}
}