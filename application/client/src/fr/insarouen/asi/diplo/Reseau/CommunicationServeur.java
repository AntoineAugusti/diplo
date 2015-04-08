package fr.insarouen.asi.diplo.Reseau;

import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import org.json.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.StringReader;
import java.net.URL;
import java.net.HttpURLConnection;
import java.util.*;
public class CommunicationServeur{
	// Doit être de type http://example.com/, afin que les autres méthodes n'aient plus qu'à ajouter l'URI à la fin. 
	private String serveurURL;

	public CommunicationServeur(String URL){
		this.serveurURL=URL;
	}
	// Créer un objet partie lorsque l'on rejoint une partie avec un id.
	public Jeu rejoindrePartie(int id) throws RuntimeException, PartieIntrouvableException, PartiePleineException{
		Jeu jeuCourant=null;
		try{
			URL url = new URL(serveurURL+"parties/"+id+"/rejoindre");
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setRequestMethod("POST");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 201){
				JSONObject obj = new JSONObject(reponse);
				JSONObject partie = obj.getJSONObject("partie");
				jeuCourant = new Jeu(partie.getInt("id"),partie.getInt("nb_joueurs_requis"),partie.getInt("nb_joueurs_inscrits"));
				//TODO traiter les informations du joueur si elles sont utiles.
			}
			if(conn.getResponseCode() == 400){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartiePleineException(message);			
			}
			if(conn.getResponseCode() == 404){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
			if(conn.getResponseCode() != 404 && conn.getResponseCode() != 400 && conn.getResponseCode() != 201){
				throw new RuntimeException("Echec :" +conn.getResponseCode());
			}
			conn.disconnect();

		}
		catch(Exception e){
			e.printStackTrace();
		}
		return jeuCourant;
	}
	// Renvoi un tableau de joueurs.
	public ArrayList<Joueur> recupererInfosJoueurs(int id) throws PartieIntrouvableException, RuntimeException{
		ArrayList<Joueur> liste = new ArrayList<Joueur>();
		try{
			URL url = new URL(serveurURL+"parties/"+id+"/joueurs");
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setRequestMethod("GET");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 200){
				JSONObject obj = new JSONObject(reponse);
				JSONArray listeJoueurs = obj.getJSONArray("joueurs");
				for(int i=0; i<listeJoueurs.length();i++){
					liste.add(new Joueur(listeJoueurs.getJSONObject(i).getInt("id"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getInt("armees_restantes"),listeJoueurs.getJSONObject(i).getInt("cases_controlees")));
				}
			}
			if(conn.getResponseCode() == 404){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
			if(conn.getResponseCode() != 404 && conn.getResponseCode() != 200){
				throw new RuntimeException("Echec :" +conn.getResponseCode());
			}
			conn.disconnect();

		}
		catch(Exception e){
			e.printStackTrace();
		}
		return liste;
	}
	// Renvoi une chaîne de caractères décrivant l'état de la partie
	public String recupererInfosPartie(int id) throws PartieIntrouvableException, RuntimeException{
		String etat="En cours";
		try{
			URL url = new URL(serveurURL+"parties/"+id+"/statut");
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setRequestMethod("GET");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 200){
				JSONObject message = new JSONObject(reponse);
				etat=message.getString("message");
			}
			if(conn.getResponseCode() == 404){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
			if(conn.getResponseCode() != 404 && conn.getResponseCode() != 200){
				throw new RuntimeException("Echec :" +conn.getResponseCode());
			}
			conn.disconnect();

		}
		catch(Exception e){
			e.printStackTrace();
		}
		return etat;
	}

}
