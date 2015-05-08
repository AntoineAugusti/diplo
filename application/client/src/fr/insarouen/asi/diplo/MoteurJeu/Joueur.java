package fr.insarouen.asi.diplo.MoteurJeu;


public class Joueur {
	private int id;
	private String pseudo;
	private String pays;
	private int armees_restantes;
	private int cases_controlees;
	private int couleur_joueur;

	public Joueur(int id, String pseudo, String pays, int armees, int
	cases) {
		this.id = id;
		this.pseudo = pseudo;
		this.pays = pays;
		this.armees_restantes = armees;
		this.cases_controlees = cases;
	}

	public void setCouleur(int couleur) {
		this.couleur_joueur = couleur;
	}

	public int getId() {
		return this.id;
	}

	public String getPseudo() {
		return this.pseudo;
	}

	public String getPays() {
		return this.pays;
	}

	public void setPseudo(String pseudo) {
		this.pseudo = pseudo;
	}

	public void setPays(String pays) {
		this.pays = pays;
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
}
