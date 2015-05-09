package fr.insarouen.asi.diplo.MoteurJeu;

import fr.insarouen.asi.diplo.Exception.OrdresException.*;
import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.MoteurJeu.Negociation.*;
import fr.insarouen.asi.diplo.MoteurJeu.Ordres.*;
import fr.insarouen.asi.diplo.Reseau.CommunicationServeur;
import java.util.ArrayList;

public class Moteur {
	public CommunicationServeur current;
	public Jeu rejoindrePartie(int partieID) throws RuntimeException,
	PartieIntrouvableException, PartiePleineException {
		return current.rejoindrePartie(partieID);
	}

	public ArrayList<Joueur> recupererInfosJoueurs(int partieID) throws
	PartieIntrouvableException, RuntimeException {
		return current.recupererInfosJoueurs(partieID);
	}

	public ArrayList<Armee> recupererInfosArmees(int partieID) throws
	PartieIntrouvableException, RuntimeException {
		return current.recupererInfosArmees(partieID);
	}

	public String recupererInfosPartie(int partieID) throws
	PartieIntrouvableException, RuntimeException {
		return current.recupererInfosPartie(partieID);
	}

	public Phase recupererInfosPhase(int partieID) throws
	PartieIntrouvableException, PartieInvalideException,
	RuntimeException {
		return current.recupererInfosPhase(partieID);
	}

	public Carte recupererInfosCarte(int partieID) throws
	PartieIntrouvableException, RuntimeException {
		return current.recupererInfosCarte(partieID);
	}

	public Boolean posterOrdre(int partieID, Ordre ordre) throws
	OrdreInvalideException {
		return current.posterOrdre(partieID, ordre);
	}

	public Conversation recupererInfosConversation(int
	conversationID) throws PartieIntrouvableException,
	RuntimeException {
		return current.recupererInfosConversation(conversationID);
	}

	public ArrayList<Conversation> recupererInfosConversationSelonJoueur(int
	joueurID) throws PartieIntrouvableException {
		return current.recupererInfosConversationSelonJoueur(joueurID);
	}

	public Conversation creerConversation(
	ArrayList<Integer> destinataires) throws PartieInvalideException {
		return current.creerConversation(destinataires);
	}

	public Message posterMessage(int conversationID, int auteur, String
	texte) throws PartieInvalideException {
		return current.posterMessage(conversationID, auteur, texte);
	}

	public Moteur() {
		current = new CommunicationServeur(
			"https://api.diplo-lejeu.fr/");

		// Phase phase = new Phase();
		// Jeu jeu = rejoindrePartie(1);
		// String etat = recupererInfosPartie(1);

		// if (etat.equals("attente_joueurs")){
		// System.out.println(" Partie en attente de joueurs. Veuillez patienter...");
		// while (etat.equals("attente_joueurs"))
		// etat = recupererInfosPartie(1);
		// }

		// while (etat.equals("en_jeu")){
		// phase = recupererInfosPhase(1);

		// etat = recupererInfosPartie(1);
		// }
	}
}
