package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.Cli;
import java.lang.*;
import java.util.*;
import org.json.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.util.*;
import java.lang.ClassLoader;

public class Tests {

	public static Jeu parsageJSONRejoindrePartie(){
				String jsonFile="{\n \"partie\":{\n \"id\":1,\n \"nb_joueurs_requis\":5,\n \"nb_joueurs_inscrits\":3\n },\n \"joueur\":{\n \"id\":2,\n \"pseudo\":\"Blah\",\n \"pays\":\"FRA\"\n }\n}";
				JSONObject obj = new JSONObject(jsonFile);
				JSONObject partie = obj.getJSONObject("partie");
				Jeu jeuCourant = new Jeu(partie.getInt("id"),partie.getInt("nb_joueurs_requis"),partie.getInt("nb_joueurs_inscrits"));
				JSONObject joueurJSON = obj.getJSONObject("joueur");
				Joueur joueurCourant = new Joueur(joueurJSON.getInt("id"),joueurJSON.getString("pseudo"),joueurJSON.getString("pays"),0,0);
				jeuCourant.miseAJourJoueur(joueurCourant);
				return jeuCourant;
	} 
	public static ArrayList<Joueur> parsageJSONInfosJoueurs(){
				ArrayList<Joueur> liste = new ArrayList<Joueur>();
				String jsonFile = "{ \n\"joueurs\":[\n {\n \"id\":1,\n \"pseudo\":\"Fake\",\n \"pays\":\"FRA\",\n \"armees_restantes\":10,\n \"cases_controlees\":3 },\n {\n \"id\":2,\n \"pseudo\":\"Dummy\",\n \"pays\":\"GBR\",\n \"armees_restantes\":5,\n \"cases_controlees\":2 }\n ],\n \"nb_joueurs\":2\n }";
				JSONObject obj = new JSONObject(jsonFile);
				JSONArray listeJoueurs = obj.getJSONArray("joueurs");
				for(int i=0; i<listeJoueurs.length();i++){
					liste.add(new Joueur(listeJoueurs.getJSONObject(i).getInt("id"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getString("pays"),listeJoueurs.getJSONObject(i).getInt("armees_restantes"),listeJoueurs.getJSONObject(i).getInt("cases_controlees")));
				}
				return liste;

	}

	public static void main(String[] args) throws Throwable {

		ArrayList<Joueur> infosJoueurs = parsageJSONInfosJoueurs();
		assert infosJoueurs.get(0).id==1 : "L'id du premier joueur vaut "+infosJoueurs.get(0).id;
		assert infosJoueurs.get(0).pseudo.equals("Fake") : "Le pseudo du premier joueur vaut "+infosJoueurs.get(0).pseudo;
		assert infosJoueurs.get(0).pays.equals("FRA") : "Le pays du premier joueur vaut "+infosJoueurs.get(0).pays;
		assert infosJoueurs.get(0).armees_restantes==10 : "Le nombre d'armees_restantes du premier joueur vaut "+infosJoueurs.get(0).armees_restantes;
		assert infosJoueurs.get(0).cases_controlees==3	 : "Le nombre de cases_controlees du premier joueur vaut "+infosJoueurs.get(0).cases_controlees;
		assert infosJoueurs.get(1).id==2 : "L'id du second joueur vaut "+infosJoueurs.get(1).id;
		assert infosJoueurs.get(1).pseudo.equals("Dummy") : "Le pseudo du second joueur vaut "+infosJoueurs.get(1).pseudo;
		assert infosJoueurs.get(1).pays.equals("GBR") : "Le pays du second joueur vaut GBR"+infosJoueurs.get(1).pays;
		assert infosJoueurs.get(1).armees_restantes==5 : "Le nombre d'armees_restantes du second joueur vaut "+infosJoueurs.get(1).armees_restantes;
		assert infosJoueurs.get(1).cases_controlees==2	 : "Le nombre de cases_controlees du second joueur vaut "+infosJoueurs.get(1).cases_controlees;
		
		Jeu partieRejointe = parsageJSONRejoindrePartie();
		assert partieRejointe.getID()==1: "Le jeu a un ID de "+partieRejointe.getID() ;
		assert partieRejointe.getRequis()==5: "Le jeu a un requis de "+partieRejointe.getRequis();
		assert partieRejointe.getInscrits()==3: "Le jeu a un inscrits de 3"+partieRejointe.getInscrits();
		HashMap<String,Joueur> joueurs = partieRejointe.getJoueurs();
		assert joueurs.containsKey("Blah") : "Le joueur est dans la hashmap ?";
		assert joueurs.get("Blah").id==2: "Le joueur Blah a un id de "+joueurs.get("Blah").id;
		assert joueurs.get("Blah").pays.equals("FRA"): "Le joueur Blah a FRA en pays "+joueurs.get("Blah").pays;
		assert joueurs.get("Blah").pseudo.equals("Blah"): "Le joueur Blah a en pseudo "+joueurs.get("Blah").pseudo;
		assert joueurs.get("Blah").armees_restantes==0: "Le joueur Blah a 0 armees_restantes "+joueurs.get("Blah").armees_restantes;
		assert joueurs.get("Blah").cases_controlees==0: "Le joueur Blah a 0 cases_controlees "+joueurs.get("Blah").cases_controlees;
	}
	

}
