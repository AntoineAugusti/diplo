<?php namespace Diplo\Cartes;

use Diplo\Armees\Armee;
use Diplo\Joueurs\Joueur;

interface CaseInterface {
	
	public function getNom();
	
	public function getVoisins();
	
	public function getArmee();
	
	public function setArmee(Armee $a);
	
	public function getProprietaire();
	
	public function setProprietaire(Joueur $j);
	
	public function estLibre();
	
	public function estMaritime();

	public function estTerrestre();
}