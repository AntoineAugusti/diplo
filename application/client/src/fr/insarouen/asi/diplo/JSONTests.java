package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.Cli;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.lang.*;
import java.util.*;
import java.util.*;
import org.json.*;

public class JSONTests {
	public static Jeu parsageJSONRejoindrePartie() {
		String jsonFile =
		"{\n \"partie\":{\n \"id\":1,\n \"nb_joueurs_requis\":5,\n \"nb_joueurs_inscrits\":3\n },\n \"joueur\":{\n \"id\":2,\n \"pseudo\":\"Blah\",\n \"pays\":\"FRA\"\n }\n}";
		JSONObject obj = new JSONObject(jsonFile);
		JSONObject partie = obj.getJSONObject("partie");
		Jeu jeuCourant = new Jeu(partie.getInt("id"), partie.getInt(
			"nb_joueurs_requis"), partie.getInt(
			"nb_joueurs_inscrits"));
		JSONObject joueurJSON = obj.getJSONObject("joueur");
		Joueur joueurCourant = new Joueur(joueurJSON.getInt("id"),
			joueurJSON.getString("pseudo"), joueurJSON.getString(
			"pays"), 0, 0);

		jeuCourant.miseAJourJoueur(joueurCourant);
		return jeuCourant;
	}

	public static ArrayList<Joueur> parsageJSONInfosJoueurs() {
		ArrayList<Joueur> liste = new ArrayList<Joueur>();

		String jsonFile =
		"{ \n\"joueurs\":[\n {\n \"id\":1,\n \"pseudo\":\"Fake\",\n \"pays\":\"FRA\",\n \"armees_restantes\":10,\n \"cases_controlees\":3 },\n {\n \"id\":2,\n \"pseudo\":\"Dummy\",\n \"pays\":\"GBR\",\n \"armees_restantes\":5,\n \"cases_controlees\":2 }\n ],\n \"nb_joueurs\":2\n }";
		JSONObject obj = new JSONObject(jsonFile);
		JSONArray listeJoueurs = obj.getJSONArray("joueurs");

		for (int i = 0; i < listeJoueurs.length(); i++)
			liste.add(new Joueur(listeJoueurs.getJSONObject(
			i).getInt("id"), listeJoueurs.getJSONObject(
			i).getString("pseudo"), listeJoueurs.getJSONObject(
			i).getString("pays"), listeJoueurs.getJSONObject(
			i).getInt("armees_restantes"),
			listeJoueurs.getJSONObject(i).getInt(
			"cases_controlees")));
		return liste;
	}

	public static Carte parsageJSONInfosCarte() {
		Carte carte = new Carte();
		String jsonFile =
		"{ \"cases\": [\n {\n \"id\":1,\n \"est_libre\":false,\n \"id_joueur\":1,\n \"est_occupee\":false,\n \"id_armee\":null\n }, {\n \"id\":2,\n \"est_libre\": true,\n \"id_joueur\":null,\n \"est_occupee\":true,\n \"id_armee\":1\n }\n ],\n \"nb_cases\":2\n }";
		JSONObject obj = new JSONObject(jsonFile);
		JSONArray listeCase = obj.getJSONArray("cases");

		for (int i = 0; i < listeCase.length(); i++) {
			int joueur_val, armee_val;

			if (!listeCase.getJSONObject(i).getBoolean(
			"est_occupee"))
				armee_val = 0;
			else
				armee_val = listeCase.getJSONObject(i).getInt(
					"id_armee");
			if (listeCase.getJSONObject(i).getBoolean("est_libre"))
				joueur_val = 0;
			else
				joueur_val = listeCase.getJSONObject(i).getInt(
					"id_joueur");

			carte.ajouterCase(new Case(listeCase.getJSONObject(
			i).getInt("id"), listeCase.getJSONObject(
			i).getBoolean("est_libre"), joueur_val,
			listeCase.getJSONObject(i).getBoolean(
			"est_occupee"), armee_val, null));
		}
		return carte;
	}

	public static Phase parsageJSONInfosPhase() {
		Phase phase = new Phase();
		String jsonFile =
		"{ \"phase\": \"NEGOCIATION\",\n \"chrono\":42\n }";
		JSONObject obj = new JSONObject(jsonFile);

		Phase.Statut statut = Phase.Statut.valueOf(obj.getString(
			"phase"));

		phase.setStatutPhaseCourante(statut);
		phase.setChrono(obj.getInt("chrono"));
		return phase;
	}

	public static StatutDuJeu parsageJSONInfosStatut() {
		String jsonFile =
		"{ \"statut\": \"attente_joueurs\",\n \"message\":\"Il n'y a pas assez de joueurs pour démarrer la partie\"\n }";
		JSONObject obj = new JSONObject(jsonFile);
		StatutDuJeu statut = new StatutDuJeu(obj.getString("statut"),
			obj.getString("message"));

		return statut;
	}

	public static void main(String[] args) throws Throwable {
		ArrayList<Joueur> infosJoueurs = parsageJSONInfosJoueurs();
		assert infosJoueurs.get(0).getID() ==
		1 : "L'id du premier joueur vaut " + infosJoueurs.get(
		0).getID();
		assert infosJoueurs.get(0).getPseudo().equals(
		"Fake"): "Le pseudo du premier joueur vaut " +
			 infosJoueurs.get(0).getPseudo();
		assert infosJoueurs.get(0).getPays().equals(
		"FRA"): "Le pays du premier joueur vaut " +
			infosJoueurs.get(0).getPays();
		assert infosJoueurs.get(0).getArmeesRestantes() ==
		10 : "Le nombre d'armees_restantes du premier joueur vaut "
		+ infosJoueurs.get(0).getArmeesRestantes();
		assert infosJoueurs.get(0).getCasesControlees() ==
		3   : "Le nombre de cases_controlees du premier joueur vaut "
		+ infosJoueurs.get(0).getCasesControlees();
		assert infosJoueurs.get(1).getID() ==
		2 : "L'id du second joueur vaut " + infosJoueurs.get(
		1).getID();
		assert infosJoueurs.get(1).getPseudo().equals(
		"Dummy"): "Le pseudo du second joueur vaut " +
			  infosJoueurs.get(1).getPseudo();
		assert infosJoueurs.get(1).getPays().equals(
		"GBR"): "Le pays du second joueur vaut GBR" +
			infosJoueurs.get(1).getPays();
		assert infosJoueurs.get(1).getArmeesRestantes() ==
		5 : "Le nombre d'armees_restantes du second joueur vaut " +
		infosJoueurs.get(1).getArmeesRestantes();
		assert infosJoueurs.get(1).getCasesControlees() ==
		2   : "Le nombre de cases_controlees du second joueur vaut "
		+ infosJoueurs.get(1).getCasesControlees();

		Jeu partieRejointe = parsageJSONRejoindrePartie();

		assert partieRejointe.getID() == 1 : "Le jeu a un ID de " +
		partieRejointe.getID();
		assert partieRejointe.getRequis() ==
		5 : "Le jeu a un requis de " + partieRejointe.getRequis();
		assert partieRejointe.getInscrits() ==
		3 : "Le jeu a un inscrits de 3" +
		partieRejointe.getInscrits();
		HashMap<String, Joueur> joueurs = partieRejointe.getJoueurs();
		assert joueurs.containsKey(
		"Blah"): "Le joueur est dans la hashmap ?";
		assert joueurs.get("Blah").getID() ==
		2 : "Le joueur Blah a un id de " + joueurs.get(
		"Blah").getID();
		assert joueurs.get("Blah").getPays().equals(
		"FRA"): "Le joueur Blah a FRA en pays " + joueurs.get(
			"Blah").getPays();
		assert joueurs.get("Blah").getPseudo().equals(
		"Blah"): "Le joueur Blah a en pseudo " + joueurs.get(
			 "Blah").getPseudo();
		assert joueurs.get("Blah").getArmeesRestantes() ==
		0 : "Le joueur Blah a 0 armees_restantes " + joueurs.get(
		"Blah").getArmeesRestantes();
		assert joueurs.get("Blah").getCasesControlees() ==
		0 : "Le joueur Blah a 0 cases_controlees " + joueurs.get(
		"Blah").getCasesControlees();

		Carte carte = parsageJSONInfosCarte();

		assert carte.getCase(1).getID() == 1 : "La case 1 a pour id " +
		carte.getCase(1).getID();
		assert carte.getCase(1).getEstLibre() ==
	    false: "La case 1 a pour est_libre " + carte.getCase(
		1).getEstLibre();
		assert carte.getCase(1).getIdJoueur() ==
		1 : "La case 1 a pour id_joueur " + carte.getCase(
		1).getIdJoueur();
		assert carte.getCase(1).getEstOccupee() ==
	    false: "La case 1 a pour est_occupee " + carte.getCase(
		1).getEstOccupee();
		assert carte.getCase(1).getIdArmee() ==
		0 : "La case 1 a pour id_armee " + carte.getCase(
		1).getIdArmee();
		assert carte.getCase(2).getID() == 2 : "La case 2 a pour id " +
		carte.getCase(2).getID();
		assert carte.getCase(2).getEstLibre() ==
	    true: "La case 2 a pour est_libre " + carte.getCase(
		2).getEstLibre();
		assert carte.getCase(2).getIdJoueur() ==
		0 : "La case 2 a pour id_joueur " + carte.getCase(
		2).getIdJoueur();
		assert carte.getCase(2).getEstOccupee() ==
	    true: "La case 2 a pour est_occupee " + carte.getCase(
		2).getEstOccupee();
		assert carte.getCase(2).getIdArmee() ==
		1 : "La case 2 a pour id_armee " + carte.getCase(
		2).getIdArmee();

		Phase phase = parsageJSONInfosPhase();

		assert phase.getChrono() == 42 : "Le chrono vaut " +
		phase.getChrono();
		assert phase.getStatutPhaseCourante().equals(
		Phase.Statut.NEGOCIATION): "Le statut de la phase est " +
					   phase.getStatutPhaseCourante();

		StatutDuJeu statut = parsageJSONInfosStatut();

		assert statut.getStatutDuJeu().equals(
		"attente_joueurs"): "Le statut de la partie courante est " +
				    statut.getStatutDuJeu();
		assert statut.getMessage().equals(
		"Il n'y a pas assez de joueurs pour démarrer la partie"):
			"Le message associé au statut est : " +
			statut.getMessage();
	}
}
