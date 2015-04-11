package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.Cli;
import java.lang.*;
import java.util.*;
import org.json.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.util.*;


public class Tests {

	

	public static void main(String[] args) throws Throwable {


		System.out.println("Test de parsage JSON");
		ArrayList<Joueur> liste = new ArrayList<Joueur>();
		String jsonFile = "{ \n\"joueurs\":[\n {\n \"id\":1,\n \"pseudo\":\"Fake\",\n \"pays\":\"FRA\",\n \"armees_restantes\":10,\n \"cases_controlees\":3 },\n {\n \"id\":2,\n \"pseudo\":\"Dummy\",\n \"pays\":\"GBR\",\n \"armees_restantes\":5,\n \"cases_controlees\":2 }\n ],\n \"nb_joueurs\":2\n }";
		JSONObject obj = new JSONObject(jsonFile);
				JSONArray listeJoueurs = obj.getJSONArray("joueurs");
				for(int i=0; i<listeJoueurs.length();i++){
					System.out.println("Test du joueur "+i);
					System.out.println("ID du joueur :"+listeJoueurs.getJSONObject(i).getInt("id")+"\n");
					System.out.println("Pseudo du joueur: "+listeJoueurs.getJSONObject(i).getString("pseudo")+"\n");
					System.out.println("armees_restantes du joueur: "+listeJoueurs.getJSONObject(i).getInt("armees_restantes")+"\n");
					System.out.println("cases_controlees du joueur: "+listeJoueurs.getJSONObject(i).getInt("cases_controlees")+"\n");
					liste.add(new Joueur(listeJoueurs.getJSONObject(i).getInt("id"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getInt("armees_restantes"),listeJoueurs.getJSONObject(i).getInt("cases_controlees")));
				}
	}

}
