package fr.insarouen.asi.diplo.Reseau;

import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.Exception.OrdresException.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import fr.insarouen.asi.diplo.MoteurJeu.Negociation.*;
import fr.insarouen.asi.diplo.MoteurJeu.Ordres.*;
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
		String response0 = "";
		String line0 = "";
		try{
			URL url = new URL(serveurURL+uri);
			HttpsURLConnection httpsConnection = (HttpsURLConnection) url.openConnection();
			httpsConnection.setRequestMethod("GET");
			httpsConnection.setRequestProperty("User-Agent", "Diplo/1.0");
			httpsConnection.setRequestProperty("Content-Type","application/json");
			int responseCode=httpsConnection.getResponseCode();
			if (responseCode != 200 && responseCode != 201 && responseCode!= 202){
			  	BufferedReader br0=new BufferedReader(new InputStreamReader(httpsConnection.getErrorStream()));
			  	while ((line0=br0.readLine()) != null) {
			  	      response0+=line0;
			  }
			 	throw new PartieHTTPSException(responseCode,response0);
			}
			BufferedReader br = new BufferedReader(new InputStreamReader((httpsConnection.getInputStream())));
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
		  String response0 = "";
		  String line0 = "";
		  String line = "";
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
			  if (responseCode != 200 && responseCode != 201 && responseCode!= 202){
			  	 BufferedReader br0=new BufferedReader(new InputStreamReader(httpsConnection.getErrorStream()));
			  	 while ((line0=br0.readLine()) != null) {
			  	      response0+=line0;
			  	}
			  	throw new PartieHTTPSException(responseCode, response0);
			  }
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

	private JSONObject ordreToJSON(Ordre ordre){
		JSONObject ordreJSON = new JSONObject();
		if (ordre instanceof Attaquer){
			Attaquer ordreCourant = (Attaquer) ordre;
			ordreJSON.put("id_armee",ordreCourant.id_armee);
			ordreJSON.put("ordre",ordreCourant.ordre);
			ordreJSON.put("id_case",ordreCourant.id_case);
		}
		if (ordre instanceof SoutienDefensif){
			SoutienDefensif ordreCourant = (SoutienDefensif) ordre;
			ordreJSON.put("id_armee",ordreCourant.id_armee);
			ordreJSON.put("ordre",ordreCourant.ordre);
			ordreJSON.put("id_case",ordreCourant.id_case);
		}
		if (ordre instanceof SoutienOffensif){
			SoutienOffensif ordreCourant = (SoutienOffensif) ordre;
			ordreJSON.put("id_armee",ordreCourant.id_armee);
			ordreJSON.put("ordre",ordreCourant.ordre);
			ordreJSON.put("id_case",ordreCourant.id_case);
		}
		if (ordre instanceof Tenir){
			Tenir ordreCourant = (Tenir) ordre;
			ordreJSON.put("ordre",ordreCourant.ordre);
			ordreJSON.put("id_armee",ordreCourant.id_armee);
		}
		return ordreJSON;
	}
	public Jeu rejoindrePartie(int partieID) throws RuntimeException, PartieIntrouvableException, PartiePleineException{
		Jeu jeuCourant=null;
		String reponse="";
		try{
			reponse = postRequete("parties/"+partieID+"/rejoindre","");
			jeuCourant = parserJSONRejoindre(reponse);
		}
		catch(PartieHTTPSException e){
			if (e.error == 400){
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartiePleineException(message);
			}
			else{
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieIntrouvableException(message);
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
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieIntrouvableException(message);
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
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieIntrouvableException(message);
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
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
			else{
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieInvalideException(message);
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
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new PartieIntrouvableException(message);
			}
		}
		return carte;
	}

	public Boolean posterOrdre(int partieID, Ordre ordre)throws OrdreInvalideException{
		Boolean execution = false;
		String reponse ="";
		try{
			reponse = postRequete("parties/"+partieID+"/ordre", ordreToJSON(ordre).toString());
			if (reponse.equals(""));
			execution = true;
		}
		catch(PartieHTTPSException e){
			if (e.error == 404){
				JSONObject erreur = new JSONObject(e.mess);
				String message = erreur.getString("erreur");
				throw new OrdreInvalideException(message);
			}
		}
		return execution;
	}
}