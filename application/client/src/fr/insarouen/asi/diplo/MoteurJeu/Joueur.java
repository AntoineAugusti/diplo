package fr.insarouen.asi.diplo.MoteurJeu;


public class Joueur {
	private int id;
	private String pseudo;
	private String pays;
	private int armees_restantes;
	private int cases_controlees;
	private int couleur_joueur;
	private String pion_armee;

	public Joueur(int id, String pseudo, String pays, int armees, int
	cases) {
		this.id = id;
		this.pseudo = pseudo;
		this.pays = pays;
		this.armees_restantes = armees;
		this.cases_controlees = cases;
		this.couleur_joueur = 0;
		this.pion_armee = " ";
	}

	public void setCouleur(int couleur) {
		this.couleur_joueur = couleur;
	}

	public int getID() {
		return this.id;
	}

	public String getPseudo() {
		return this.pseudo;
	}

	public String getPays() {
		return this.pays;
	}

	public int getArmeesRestantes() {
		return this.armees_restantes;
	}

	public int getCasesControlees() {
		return this.cases_controlees;
	}

	public int getCouleurJoueur() {
		return this.couleur_joueur;
	}

	public void setPion(String pion) {
		this.pion_armee = pion;
	}

	public String getPion() {
		return this.pion_armee;
	}
}
