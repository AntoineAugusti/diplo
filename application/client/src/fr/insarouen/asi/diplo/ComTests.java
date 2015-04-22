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

	public static String postHttpsContent(String urlString) throws IOException {
	  String response="";
	  URL url=new URL(urlString);
	  HttpsURLConnection httpsConnection=(HttpsURLConnection)url.openConnection();
	  httpsConnection.setRequestMethod("POST");
	  httpsConnection.setDoInput(true);
	  httpsConnection.setDoOutput(true);
	  httpsConnection.setUseCaches(false);
	  httpsConnection.setRequestProperty("Host","api.diplo-lejeu.fr");
	  //httpsConnection.setRequestProperty("Content-Type","application/x-www-form-urlencoded");
	  // String postData="";
	  // DataOutputStream postOut=new DataOutputStream(httpsConnection.getOutputStream());
	  // postOut.writeBytes(postData);
	  // postOut.flush();
	  // postOut.close();
	  int responseCode=httpsConnection.getResponseCode();
	  System.out.println(responseCode);
	  if (responseCode == HttpsURLConnection.HTTP_OK) {
	    String line;
	    BufferedReader br=new BufferedReader(new InputStreamReader(httpsConnection.getInputStream()));
	    while ((line=br.readLine()) != null) {
	      response+=line;
	    }
	  }
	  return response;
	}
	public static void main(String[] args) throws Throwable {
		CommunicationServeur current = new CommunicationServeur("https://api.diplo-lejeu.fr/");
		//current.recupererInfosJoueurs(1);
		// Jeu nouveau = current.rejoindrePartie(1);
		//System.out.println(postHttpsContent("https://api.diplo-lejeu.fr/parties/1/rejoindre"));
	}
}