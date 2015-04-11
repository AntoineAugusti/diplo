package fr.insarouen.asi.diplo.MoteurJeu;

public class Case{
	public int id;
	public boolean est_libre;
	public int id_joueur;
	public boolean est_occupee;
	public int id_armee;

	public Case(int id, boolean est_libre, int id_joueur, boolean est_occupee, int id_armee){
		this.id = id;
		this.est_libre = est_libre;
		this.id_joueur = id_joueur;
		this.est_occupee = est_occupee;
		this.id_armee = id_armee;
	}
}