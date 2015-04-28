package fr.insarouen.asi.diplo.Affichage;

import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.io.*;
import java.util.*;


public class AffichageCarte {
	private Carte carte;
	private static final int LARGEUR_CASE = 18;
	public Jeu jeu;

	public AffichageCarte() {
		jeu = new Jeu(0,0,0);
		carte = new Carte();
	}

	public AffichageCarte(Jeu jeu) {
		this.jeu = jeu;
		this.carte = jeu.getCarte();
	}

	private String pionArmee(int idArmee) {
		String pion = " ";

		switch (idArmee) {
			case 0: pion = " "; break;
			case 1: pion = "*"; break;
			case 2: pion = "#"; break;
			case 3: pion = "$"; break;
			case 4: pion = "%"; break;
			case 5: pion = "@"; break;
		}

		return pion;
	}

	private void construireCases(StringBuilder l1, StringBuilder l2, StringBuilder l3, StringBuilder l4) {
		String limiteGauche = "\u258F";
		String limiteDroite = "\u2595";
		String limiteHaute = "\u2594";
		String limiteHBasse = "\u2581";

		for (Case c : carte.getCases()) {
			int idJoueur = c.id_joueur;
			int idArmee = c.id_armee;
			int couleur = 42;

			if (idJoueur != 0) {
				Joueur joueur = jeu.getJoueur(idJoueur);
				couleur = joueur.couleur_joueur;
			}

			l1.append("\\e["+couleur+"m"+limiteGauche+limiteHaute+limiteHaute+limiteHaute+limiteHaute+limiteHaute+limiteDroite+"\\e[0m");

			if (c.id < 10) {
				l2.append("\\e["+couleur+"m"+limiteGauche+"  "+" "+c.id+" "+limiteDroite+"\\e[0m");
			}
			else {
				if (c.id >= 10 && c.id < 100)
					l2.append("\\e["+couleur+"m"+limiteGauche+" "+" "+c.id+" "+limiteDroite+"\\e[0m");
				else 
					l2.append("\\e["+couleur+"m"+limiteGauche+" "+c.id+" "+limiteDroite+"\\e[0m");

			}

			l3.append("\\e["+couleur+"m"+limiteGauche+" "+" "+" "+pionArmee(idArmee)+" "+limiteDroite+"\\e[0m");
			l4.append("\\e["+couleur+"m"+limiteGauche+limiteHBasse+limiteHBasse+limiteHBasse+limiteHBasse+limiteHBasse+limiteDroite+"\\e[0m");
		}
	}

	private static List<String> partitionner(String chaine, int taillePartition) {
	    List<String> partitions = new ArrayList<String>();
	    int taille = chaine.length();

	    for (int i = 0; i < taille; i = i + taillePartition) {
	        partitions.add(chaine.substring(i, Math.min(taille, i + taillePartition)));
	    }

	    return partitions;
	}

	public void saveToMap(int nbColonnes){
        String fileName = "carte.sh";
        String ligneHaute = "";
        String ligneDuMilieu1 = "";
        String ligneDuMilieu2 = "";
        String ligneBasse = "";
        StringBuilder l1 = new StringBuilder();
        StringBuilder l2 = new StringBuilder();
        StringBuilder l3 = new StringBuilder();
        StringBuilder l4 = new StringBuilder();

        String echo = "echo -e '";

        try {
        	// On ouvre notre fichier en écriture
            FileWriter fileWriter = new FileWriter(fileName);
            BufferedWriter bufferedWriter = new BufferedWriter(fileWriter);

            construireCases(l1, l2, l3, l4);
            ligneHaute = l1.toString();
            ligneDuMilieu1 = l2.toString();
            ligneDuMilieu2 = l3.toString();
            ligneBasse = l4.toString();
            List<String> ligneHauteCoupe = partitionner(ligneHaute, nbColonnes*LARGEUR_CASE);
            List<String> ligneDuMilieu1Coupe = partitionner(ligneDuMilieu1, nbColonnes*LARGEUR_CASE);
            List<String> ligneDuMilieu2Coupe = partitionner(ligneDuMilieu2, nbColonnes*LARGEUR_CASE);
            List<String> ligneBasseCoupe = partitionner(ligneBasse, nbColonnes*LARGEUR_CASE);
            bufferedWriter.write("#! /bin/bash");
	        bufferedWriter.newLine();
            for(int i = 0; i < ligneHauteCoupe.size(); i++){
	            String ligneDeCases = echo + ligneHauteCoupe.get(i) + "'" + "\n" + echo + ligneDuMilieu1Coupe.get(i) + "'" + "\n" + echo + ligneDuMilieu2Coupe.get(i) + "'" + "\n" + echo + ligneBasseCoupe.get(i) + "'";
	            bufferedWriter.write(ligneDeCases);
	            bufferedWriter.newLine();
	        }

            // On ferme notre fichier
            bufferedWriter.close();
        }
        catch(IOException ex) {
            System.out.println("Erreur d'écriture sur le fichier '"+ fileName + "'");
        }
	}

	public void readMap(String fileName) {
        System.out.print(executerCommande("chmod +x "+fileName));
        System.out.print(executerCommande("./"+fileName));
	}

	// Exécution d'une commande bash en java (http://www.mkyong.com/java/how-to-execute-shell-command-from-java/)
	private String executerCommande(String command) {
 
		StringBuffer output = new StringBuffer();
 
		Process p;
		try {
			p = Runtime.getRuntime().exec(command);
			p.waitFor();
			BufferedReader reader = new BufferedReader(new InputStreamReader(p.getInputStream()));
 
            String line = "";			
			while ((line = reader.readLine())!= null) {
				output.append(line + "\n");
			}
 
		} catch (Exception e) {
			e.printStackTrace();
		}
 
		return output.toString();
	}
}