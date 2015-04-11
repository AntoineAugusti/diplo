package fr.insarouen.asi.diplo.MoteurJeu.Negociation;

import java.util.Date;
import java.text.SimpleDateFormat;
import java.text.ParseException;

public class Message {

	public int id;
	public int id_joueur;
	public String texte;
	public Date date_creation;
	
	public Message(int id, int id_joueur, String texte, Date date_creation){
		this.id = id;
		this.id_joueur = id_joueur;
		this.texte = texte;
		this.date_creation = date_creation;
	}

	public Message(int id, int id_joueur, String texte, String date_creation) throws ParseException{
		this(id, id_joueur, texte, new SimpleDateFormat("yyyy-MM-dd HH:mm:ss.S").parse(date_creation));
	}

	public int getID(){
		return this.id;
	}

	public int getIdJoueur(){
		return this.id_joueur;
	}

	public String getTexte(){
		return this.texte;
	}

	public Date getDateCreation(){
		return this.date_creation;
	}
}