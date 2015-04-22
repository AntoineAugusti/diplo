package fr.insarouen.asi.diplo.Reseau;

import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import org.json.*;
import java.net.MalformedURLException;
import java.net.URL;
import java.security.cert.Certificate;
import java.io.*;
import javax.net.ssl.HttpsURLConnection;
import javax.net.ssl.SSLPeerUnverifiedException;
import java.util.*;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.io.IOException;

public class CommunicationServeur{
	// Doit être de type http://example.com/, afin que les autres méthodes n'aient plus qu'à ajouter l'URI à la fin. 
	private String serveurURL;

	public CommunicationServeur(String URL){
		this.serveurURL=URL;
	}
	// Créer un objet partie lorsque l'on rejoint une partie avec un id.
	public Jeu rejoindrePartie(int partieID) throws RuntimeException, PartieIntrouvableException, PartiePleineException{
		Jeu jeuCourant=null;
		try{
			URL url = new URL(serveurURL+"parties/"+partieID+"/rejoindre");
			HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
			conn.setRequestMethod("POST");
			conn.setRequestProperty("Accept", "application/json");
			conn.setDoOutput(true);
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 201){
				JSONObject obj = new JSONObject(reponse);
				JSONObject partie = obj.getJSONObject("partie");
				jeuCourant = new Jeu(partie.getInt("id"),partie.getInt("nb_joueurs_requis"),partie.getInt("nb_joueurs_inscrits"));
				JSONObject joueurJSON = obj.getJSONObject("joueur");
				Joueur joueurCourant = new Joueur(joueurJSON.getInt("id"),joueurJSON.getString("pseudo"),joueurJSON.getString("pays"),0,0);
				jeuCourant.miseAJourJoueur(joueurCourant);
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
		catch(MalformedURLException e){
			System.out.println(" L URL du serveur est invalide :"+e.getMessage());
		}
		catch(ProtocolException e){
			System.out.println(" Le protocole utilisé est invalide :"+e.getMessage());
		}
		catch(IOException e){
			System.out.println(" Problème d'E/S :"+e.getMessage());
		}
		return jeuCourant;
	}
	// Renvoi un tableau de joueurs.
	public ArrayList<Joueur> recupererInfosJoueurs(int partieID) throws PartieIntrouvableException, RuntimeException{
		ArrayList<Joueur> liste = new ArrayList<Joueur>();
		try{
			URL url = new URL(serveurURL+"parties/"+partieID+"/joueurs");
			HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
			conn.setRequestMethod("GET");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 200){
				JSONObject obj = new JSONObject(reponse);
				JSONArray listeJoueurs = obj.getJSONArray("joueurs");
				for(int i=0; i<listeJoueurs.length();i++){
					liste.add(new Joueur(listeJoueurs.getJSONObject(i).getInt("id"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getString("pays"),listeJoueurs.getJSONObject(i).getInt("armees_restantes"),listeJoueurs.getJSONObject(i).getInt("cases_controlees")));
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
		catch(MalformedURLException e){
			System.out.println(" L URL du serveur est invalide :"+e.getMessage());
		}
		catch(ProtocolException e){
			System.out.println(" Le protocole utilisé est invalide :"+e.getMessage());
		}
		catch(IOException e){
			System.out.println(" Problème d'E/S :"+e.getMessage());
		}
		return liste;
	}
	// Renvoi une chaîne de caractères décrivant l'état de la partie
	public String recupererInfosPartie(int partieID) throws PartieIntrouvableException, RuntimeException{
		String etat="En cours";
		try{
			URL url = new URL(serveurURL+"parties/"+partieID+"/statut");
			HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
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
		catch(MalformedURLException e){
			System.out.println(" L URL du serveur est invalide :"+e.getMessage());
		}
		catch(ProtocolException e){
			System.out.println(" Le protocole utilisé est invalide :"+e.getMessage());
		}
		catch(IOException e){
			System.out.println(" Problème d'E/S :"+e.getMessage());
		}
		return etat;
	}

	public Phase recupererInfosPhase(int partieID) throws PartieIntrouvableException, PartieInvalideException, RuntimeException{
		Phase phaseCourante = null;
		try{
			URL url = new URL(serveurURL+"parties/"+partieID+"/phase");
			HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
			conn.setRequestMethod("GET");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 200){
				JSONObject message = new JSONObject(reponse);
				switch(message.getString("phase")){
					case "NEGOCIATION" : phaseCourante = new Phase(Phase.Statut.NEGOCIATION,message.getInt("chrono"));break;
					case "COMBAT" : phaseCourante = new Phase(Phase.Statut.COMBAT,message.getInt("chrono"));break;
					default : phaseCourante = new Phase(Phase.Statut.INACTIF,1);
				}
			}
			if(conn.getResponseCode() == 404){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
			if(conn.getResponseCode() == 405){
				JSONObject obj = new JSONObject(reponse);
				String message = obj.getString("erreur");
				throw new PartieInvalideException(message);
			}
			if(conn.getResponseCode() != 404 && conn.getResponseCode() != 405  && conn.getResponseCode() != 200){
				throw new RuntimeException("Echec :" +conn.getResponseCode());
			}
			conn.disconnect();
		}
		catch(MalformedURLException e){
			System.out.println(" L URL du serveur est invalide :"+e.getMessage());
		}
		catch(ProtocolException e){
			System.out.println(" Le protocole utilisé est invalide :"+e.getMessage());
		}
		catch(IOException e){
			System.out.println(" Problème d'E/S :"+e.getMessage());
		}
		return phaseCourante;
	}
	public Carte recupererInfosCarte(int partieID) throws PartieIntrouvableException, RuntimeException{
		Carte carte = new Carte();
		try{
			URL url = new URL(serveurURL+"parties/"+partieID+"/carte");
			HttpsURLConnection conn = (HttpsURLConnection) url.openConnection();
			conn.setRequestMethod("GET");
			conn.setRequestProperty("Accept", "text/plain");
			
			BufferedReader br = new BufferedReader(new InputStreamReader((conn.getInputStream())));
			String reponse = br.readLine();
			if(conn.getResponseCode() == 200){
				JSONObject obj = new JSONObject(reponse);
				JSONArray listeCase = obj.getJSONArray("cases");
				for(int i=0; i<listeCase.length();i++){
					int joueur_val,armee_val;
					if (!listeCase.getJSONObject(i).getBoolean("est_occupee")){
						armee_val=0;
					}
					else{
						armee_val=listeCase.getJSONObject(i).getInt("id_armee");
					}
					if (listeCase.getJSONObject(i).getBoolean("est_libre")){
						joueur_val=0;
					}
					else{
						joueur_val=listeCase.getJSONObject(i).getInt("id_joueur");
					}
					carte.ajouterCase(new Case(listeCase.getJSONObject(i).getInt("id"),listeCase.getJSONObject(i).getBoolean("est_libre"),joueur_val,listeCase.getJSONObject(i).getBoolean("est_occupee"),armee_val));
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
		catch(MalformedURLException e){
			System.out.println(" L URL du serveur est invalide :"+e.getMessage());
		}
		catch(ProtocolException e){
			System.out.println(" Le protocole utilisé est invalide :"+e.getMessage());
		}
		catch(IOException e){
			System.out.println(" Problème d'E/S :"+e.getMessage());
		}
		return carte;
	}
}
;