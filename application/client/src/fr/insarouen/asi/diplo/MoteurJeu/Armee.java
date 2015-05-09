package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class Armee {
	private int id;
	private int id_joueur;
	private int id_case_courante;
	private String pion_armee

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

	public getIdCaseCourante() {
		return this.id_case_courante;
	}

	public void setPion(String pion) {
		this.pion_armee = pion;
	}

	public String getPion() {
		return this.pion_armee;
	}

}
