package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class Armee {
	private int id;
	private int id_joueur;
	private int id_case_courante;

	public Armee(int id, int joueur, int id_case) {
		this.id = id;
		this.id_joueur = joueur;
		this.id_case_courante = id_case;
	}

	public int getID() {
		return this.id;
	}

	public int getJoueur() {
		return this.id_joueur;
	}

	public int getIdCaseCourante() {
		return this.id_case_courante;
	}

}
