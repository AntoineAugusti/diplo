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

	private String getRequete(String uri) throws PartieHTTPSException{
		String line ="";
		String reponse="";
		try{
			URL url = new URL(serveurURL+uri);
			HttpsURLConnection httpsConnection = (HttpsURLConnection) url.openConnection();
			httpsConnection.setRequestMethod("GET");
			httpsConnection.setRequestProperty("User-Agent", "Diplo/1.0");
			httpsConnection.setRequestProperty("Content-Type","application/json");
			BufferedReader br = new BufferedReader(new InputStreamReader((httpsConnection.getInputStream())));
			int responseCode=httpsConnection.getResponseCode();
			if (responseCode != 200 && responseCode != 201){
			 	throw new PartieHTTPSException(responseCode);
			}
			while ((line=br.readLine()) != null){
			reponse +=line;
			}
			httpsConnection.disconnect();

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
		return reponse;
	} 

	private String postRequete(String uri, String postData) throws PartieHTTPSException{
		  String response="";
		  try{
		  	  URL url=new URL(serveurURL+uri);
			  HttpsURLConnection httpsConnection=(HttpsURLConnection)url.openConnection();
			  httpsConnection.setRequestMethod("POST");
			  httpsConnection.setDoInput(true);
			  httpsConnection.setDoOutput(true);
			  httpsConnection.setUseCaches(false);
			  httpsConnection.setRequestProperty("User-Agent", "Diplo/1.0");
			  httpsConnection.setRequestProperty("Content-Type","application/json");
			  DataOutputStream postOut=new DataOutputStream(httpsConnection.getOutputStream());
			  postOut.writeBytes(postData);
			  postOut.flush();
			  postOut.close();
			  int responseCode=httpsConnection.getResponseCode();
			  if (responseCode != 200 && responseCode != 201){
			  	throw new PartieHTTPSException(responseCode);
			  }
			  String line;
			  BufferedReader br=new BufferedReader(new InputStreamReader(httpsConnection.getInputStream()));
			  while ((line=br.readLine()) != null) {
			  	      response+=line;
			  }
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
		  return response;
			
	}
	private Jeu parserJSONRejoindre(String fichier){
		JSONObject obj = new JSONObject(fichier);
		JSONObject partie = obj.getJSONObject("partie");
		Jeu jeuCourant = new Jeu(partie.getInt("id"),partie.getInt("nb_joueurs_requis"),partie.getInt("nb_joueurs_inscrits"));
		JSONObject joueurJSON = obj.getJSONObject("joueur");
		Joueur joueurCourant = new Joueur(joueurJSON.getInt("id"),joueurJSON.getString("pseudo"),joueurJSON.getString("pays"),0,0);
		jeuCourant.miseAJourJoueur(joueurCourant);
		return jeuCourant;
	}

	private ArrayList<Joueur> parserJSONInfosJoueurs(String fichier){
		ArrayList<Joueur> liste = new ArrayList<Joueur>();
		JSONObject obj = new JSONObject(fichier);
		JSONArray listeJoueurs = obj.getJSONArray("joueurs");
		for(int i=0; i<listeJoueurs.length();i++){
			liste.add(new Joueur(listeJoueurs.getJSONObject(i).getInt("id"),listeJoueurs.getJSONObject(i).getString("pseudo"),listeJoueurs.getJSONObject(i).getString("pays"),listeJoueurs.getJSONObject(i).getInt("armees_restantes"),listeJoueurs.getJSONObject(i).getInt("cases_controlees")));
		}
		return liste;
	}

	private String parserJSONInfosPartie(String fichier){
		String etat;
		JSONObject message = new JSONObject(fichier);
		etat=message.getString("message");
		return etat;
	}

	private Phase parserJSONInfosPhase(String fichier){
		Phase phaseCourante = null;
		JSONObject message = new JSONObject(fichier);
		switch(message.getString("phase")){
			case "NEGOCIATION" : phaseCourante = new Phase(Phase.Statut.NEGOCIATION,message.getInt("chrono"));break;
			case "COMBAT" : phaseCourante = new Phase(Phase.Statut.COMBAT,message.getInt("chrono"));break;
			default : phaseCourante = new Phase(Phase.Statut.INACTIF,1);
		}
		return phaseCourante;
	}

	private Carte parserJSONInfosCarte(String fichier){
		Carte carteCourante=null;
		JSONObject obj = new JSONObject(fichier);
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
			carteCourante.ajouterCase(new Case(listeCase.getJSONObject(i).getInt("id"),listeCase.getJSONObject(i).getBoolean("est_libre"),joueur_val,listeCase.getJSONObject(i).getBoolean("est_occupee"),armee_val));
		}
		return carteCourante;
	}
	public Jeu rejoindrePartie(int partieID) throws RuntimeException, PartieIntrouvableException, PartiePleineException{
		Jeu jeuCourant=null;
		String reponse="";
		try{
			reponse = postRequete("parties/1/rejoindre","");
			jeuCourant = parserJSONRejoindre(reponse);
		}
		catch(PartieHTTPSException e){
			if (e.error == 400){
				throw new PartiePleineException(e.getMessage());
			}
			else{
				throw new PartieIntrouvableException(e.getMessage());
			}
		}
		return jeuCourant;
	}
	// Renvoi un tableau de joueurs.
	public ArrayList<Joueur> recupererInfosJoueurs(int partieID) throws PartieIntrouvableException, RuntimeException{
		ArrayList<Joueur> liste = new ArrayList<Joueur>();
		String reponse;
		try{
			reponse = getRequete("parties/"+partieID+"/joueurs");
			liste = parserJSONInfosJoueurs(reponse);

		}
		catch(PartieHTTPSException e){
			if (e.error == 404){
				throw new PartieIntrouvableException(e.getMessage());
			}
		}
		return liste;
	}
	// Renvoi une chaîne de caractères décrivant l'état de la partie
	public String recupererInfosPartie(int partieID) throws PartieIntrouvableException, RuntimeException{
		String etat="En cours";
		String reponse = "";
		try{
			reponse = getRequete("parties/"+partieID+"/statut");
			etat = parserJSONInfosPartie(reponse);

		}
		catch(PartieHTTPSException e){
			if (e.error == 404){
				throw new PartieIntrouvableException(e.getMessage());
			}
		}
		return etat;
	}

	public Phase recupererInfosPhase(int partieID) throws PartieIntrouvableException, PartieInvalideException, RuntimeException{
		Phase phaseCourante = null;
		String reponse = "";
		try{
			reponse =getRequete("parties/"+partieID+"/phase");
			phaseCourante = parserJSONInfosPhase(reponse);
			
		}
		catch(PartieHTTPSException e){
			if (e.error == 404){
				throw new PartieIntrouvableException(e.getMessage());
			}
		}
		return phaseCourante;
	}

	public Carte recupererInfosCarte(int partieID) throws PartieIntrouvableException, RuntimeException{
		Carte carte = null;
		String reponse = "";
		try{
			reponse = getRequete("parties/"+partieID+"/carte");
			carte = parserJSONInfosCarte(reponse);
		}
		catch(PartieHTTPSException e){
			if (e.error == 404){
				throw new PartieIntrouvableException(e.getMessage());
			}
		}
		return carte;
	}
}