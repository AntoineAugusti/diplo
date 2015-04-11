package fr.insarouen.asi.diplo.MoteurJeu;

public class Case{
	public int id;
	public boolean est_libre;
	public boolean a_joueur;
	public int id_joueur;
	public boolean est_occupee;
	public boolean a_armee;
	public int id_armee;

	public Case(int id, boolean est_libre, boolean a_joueur, int id_joueur, boolean est_occupee, boolean a_armee, int id_armee){
		this.id = id;
		this.est_libre = est_libre;
		this.a_joueur = a_joueur;
		this.id_joueur = id_joueur;
		this.est_occupee = est_occupee;
		this.a_armee = a_armee;
		this.id_armee = id_armee;
	}
}