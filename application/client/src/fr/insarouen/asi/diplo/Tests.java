package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.Cli;
import java.lang.*;
import java.util.*;
import org.json.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.util.*;
import java.lang.ClassLoader;

public class Tests {

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
		assert infosJoueurs.get(0).id==1 : "L'id du premier joueur vaut 1";
		assert infosJoueurs.get(0).pseudo.equals("Fake") : "Le pseudo du premier joueur vaut Fake";
		assert infosJoueurs.get(0).pays.equals("FRA") : "Le pays du premier joueur vaut FRA";
		assert infosJoueurs.get(0).armees_restantes==10 : "Le nombre d'armees_restantes du premier joueur vaut 10";
		assert infosJoueurs.get(0).cases_controlees==3	 : "Le nombre de cases_controlees du premier joueur vaut 3";
		assert infosJoueurs.get(1).id==2 : "L'id du second joueur vaut 2";
		assert infosJoueurs.get(1).pseudo.equals("Dummy") : "Le pseudo du second joueur vaut Dummy";
		assert infosJoueurs.get(1).pays.equals("GBR") : "Le pays du second joueur vaut GBR";
		assert infosJoueurs.get(1).armees_restantes==5 : "Le nombre d'armees_restantes du second joueur vaut 5";
		assert infosJoueurs.get(1).cases_controlees==2	 : "Le nombre de cases_controlees du second joueur vaut 2";
		
	}
	

}
