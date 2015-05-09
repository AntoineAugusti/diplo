package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class Case {
	private int id;
	private boolean est_libre;
	private int id_joueur;
	private boolean est_occupee;
	private int id_armee;
	private ArrayList<Integer> cases_voisines;

	public Case(int id, boolean est_libre, int id_joueur, boolean
	est_occupee, int id_armee, ArrayList<Integer> voisines) {
		this.id = id;
		this.est_libre = est_libre;
		this.id_joueur = id_joueur;
		this.est_occupee = est_occupee;
		this.id_armee = id_armee;
		this.cases_voisines = voisines;
	}

	public int getID() {
		return this.id;
	}

	public int getIdJoueur() {
		return this.id_joueur;
	}

	public int getIdArmee() {
		return this.id_armee;
	}

	public ArrayList<Integer> getCasesVoisines() {
		return this.cases_voisines;
	}

	public boolean getEstLibre() {
		return this.est_libre;
	}

	public boolean getEstOccupee() {
		return this.est_occupee;
	}
}
