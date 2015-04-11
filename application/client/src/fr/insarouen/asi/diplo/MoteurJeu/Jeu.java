package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;


// Il est utile de structurer les informations que l'on reçoit, typiquement une partie.

public class Jeu{
	private int id;
	private int nb_joueurs_requis;
	private int nb_joueurs_inscrits;
	private HashMap<String,Joueur> listeDesJoueurs;
	private Phase phaseCourante;
	private int chrono;
	public Jeu(int id, int requis, int inscrits){
		this.id=id;
		this.nb_joueurs_requis=requis;
		this.nb_joueurs_inscrits=inscrits;
		this.listeDesJoueurs = new HashMap<String,Joueur>();
		this.phaseCourante=NULL;
		this.chrono=0;
	}

	public int getID(){
		return id;
	}	
	public int getRequis(){
		return nb_joueurs_requis;
	}	
	public int getInscrits(){
		return nb_joueurs_inscrits;
	}
	public int getChrono(){
		return chrono;
	}
	public boolean setChrono(int nouveauChrono){
		this.chrono=nouveauChrono;
		return true;
	} 
	public Phase getPhaseCourante(){
		return phaseCourante;
	}
	public boolean setPhaseCourante(Phase nouvellePhase){
		boolean set=false;
		if (nouvellePhase!=NULL){
			this.phaseCourante=nouvellePhase;
			set=true;
		}
		return set;
	}
	public HashMap<String,Joueur> getJoueurs(){
	 	return listeDesJoueurs;
	}
	public boolean miseAJourJoueur(Joueur nouveau){
		listeDesJoueurs.put(nouveau.pseudo,nouveau);
		return true;
	}

}
