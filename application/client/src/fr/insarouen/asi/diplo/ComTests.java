package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Reseau.CommunicationServeur;
import fr.insarouen.asi.diplo.MoteurJeu.Jeu;
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


public class ComTests{

	public static String requeteGet(){
		String line ="";
		String reponse="";
		try{
			URL url = new URL("https://api.diplo-lejeu.fr/parties/1/joueurs");
			HttpsURLConnection httpsConnection = (HttpsURLConnection) url.openConnection();
			httpsConnection.setRequestMethod("GET");
			httpsConnection.setRequestProperty("User-Agent", "Diplo/1.0");
			httpsConnection.setRequestProperty("Content-Type","application/json");
			
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
	public static String postHttpsContent(String urlString) throws IOException {
	  String response="";
	  URL url=new URL(urlString);
	  HttpsURLConnection httpsConnection=(HttpsURLConnection)url.openConnection();
	  httpsConnection.setRequestMethod("POST");
	  httpsConnection.setDoInput(true);
	  httpsConnection.setDoOutput(true);
	  httpsConnection.setUseCaches(false);
	  httpsConnection.setRequestProperty("User-Agent", "Diplo/1.0");
	  httpsConnection.setRequestProperty("Content-Type","application/json");
	  String postData="";
	  DataOutputStream postOut=new DataOutputStream(httpsConnection.getOutputStream());
	  postOut.writeBytes(postData);
	  postOut.flush();
	  postOut.close();
	  int responseCode=httpsConnection.getResponseCode();
	  System.out.println(responseCode);
	  if (responseCode == 201) {
	    String line;
	    BufferedReader br=new BufferedReader(new InputStreamReader(httpsConnection.getInputStream()));
	    while ((line=br.readLine()) != null) {
	    	System.out.println("new line");
	      response+=line;
	      System.out.println(line);
	    }
	  }
	  return response;
	}
	public static void main(String[] args) throws Throwable {
		CommunicationServeur current = new CommunicationServeur("https://api.diplo-lejeu.fr/");
		Jeu jeu = current.rejoindrePartie(1);
		assert jeu.getID()==1 : "id du jeu";
		assert jeu.getRequis()==5 : "requis";

	}
}