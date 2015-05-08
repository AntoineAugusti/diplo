package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import fr.insarouen.asi.diplo.MoteurJeu.Jeu;
import fr.insarouen.asi.diplo.MoteurJeu.Negociation.*;
import fr.insarouen.asi.diplo.MoteurJeu.Ordres.*;
import fr.insarouen.asi.diplo.Reseau.CommunicationServeur;
import java.io.*;
import java.io.IOException;
import java.net.MalformedURLException;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.security.cert.Certificate;
import java.util.*;
import javax.net.ssl.HttpsURLConnection;
import javax.net.ssl.SSLPeerUnverifiedException;
import org.json.*;


public class ComTests {
	public static void main(String[] args) throws Throwable {
		CommunicationServeur current = new CommunicationServeur(
			"https://api.diplo-lejeu.fr/");
		Jeu jeu = current.rejoindrePartie(1);

		assert jeu.getID() == 1 : "ID du jeu vaut 1";
		assert jeu.getRequis() == 5 : "5 joueurs requis";
		assert jeu.getInscrits() >= 3 : "Au moins 3 joueurs inscrits";
		System.out.println(jeu.getJoueurs());

		Joueur local = (Joueur)jeu.getJoueurs().values().toArray()[0];

		assert local.pseudo != null : "Le nom est non null";
		assert local.id > 0 : "L'id est non null";
		assert local.pays != null : "Le pays est non null";
		assert local.armees_restantes ==
		0 : "Les armees_restantes est non null";
		assert local.cases_controlees ==
		0 : "Le joueur n'a pas de cases";

		ArrayList<Joueur> joueurs = current.recupererInfosJoueurs(1);
		assert joueurs.size() >= 3 : "Il y a au moins 3 joueurs";
		for (int i = 0; i < joueurs.size(); i++) {
			local = joueurs.get(i);
			assert local.pseudo != null : "Le nom est non null";
			assert local.id > 0 : "L'id est non null";
			assert local.pays != null : "Le pays est non null";
			assert local.armees_restantes ==
			0 : "Les armees_restantes est non null";
			assert local.cases_controlees ==
			0 : "Le joueur n'a pas de cases";
		}

		String reponse = current.recupererInfosPartie(1);

		assert !reponse.equals(
		"En cours"): "L etat de la partie ne vaut pas En cours";

		// Phase phaseCourante = current.recupererInfosPhase(1);
		// assert phaseCourante.getStatutPhaseCourante() != null : "le statut est non null";
		// assert phaseCourante.getChrono() > 0 : "le chrono est non null";

		// Carte carte = current.recupererInfosCarte(1);
		// assert carte instanceof Carte : "On a bien un type carte";
		// for (Case c : carte.getCases()){
		// assert c.id >=0 : "L'id est >=0";
		// assert c.id_joueur >=0 : "L'id du joueur est plus grand ou egal a 0";
		// assert c.id_armee >=0 : "L'id_armee est non nul";
		// }
		// ArrayList<Integer> dest = new ArrayList<Integer>();
		// dest.add(1);
		// dest.add(2);
		// dest.add(3);
		// dest.add(4);
		// dest.add(5);
		// dest.add(6);
		// dest.add(7);
		// dest.add(8);
		// System.out.println(current.conversationToJSON(dest).toString());
		// ArrayList<Integer> dest = new ArrayList<Integer>();
		// dest.add(jeu.getJoueurs().get("Manon").id);
		// current.creerConversation(dest);
	}
}
