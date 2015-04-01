<?php namespace Diplo\Ordres;

abstract class OrdreExecuteur {

	private $ordre;

	public function getOrdre()
	{
		return $this->ordre;
	}

	public function setOrdre(Ordre $o)
	{
		return $this->ordre = $o;
	}

	abstract public function executer();
}