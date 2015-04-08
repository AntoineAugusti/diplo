package fr.insarouen.asi.diplo.MoteurJeu;

public class Joueur{
	public int id;
	public String pseudo;
	public String pays;
	public int armees_restantes;
	public int cases_controlees;

	public Joueur(int id, String pseudo, String pays, int armees, int cases){
		this.id=id;
		this.pseudo=pseudo;
		this.pays=pays;
		this.armees_restantes=armees;
		this.cases_controlees=cases;
	}
}
