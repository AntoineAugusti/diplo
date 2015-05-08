package fr.insarouen.asi.diplo.Affichage;

import java.io.Console;
import java.io.File;
import java.io.Serializable;
import java.io.StreamTokenizer;
import java.io.StringReader;
import java.lang.*;
import java.lang.Exception;
import java.lang.reflect.*;
import java.util.*;
import java.util.Iterator;
import java.util.List;
import java.util.Set;


public class Cli {
	private String ordre;
	public static final char ESC = 27;

	// constructeur

	/**
	 * Constructeur de la classe Cli,
	 */
	public Cli() {
		this.ordre = null;
	}

	// methodes
	public void setOrdre(String ordre) {
		this.ordre = ordre;
	}

	public void commandeCreerPartie(int nbMinJoueurs) {
		try {
			// appeler méthode pour créer une partie qui affiche l'id de la partie crée
		} catch (Exception e) {
			e.printStackTrace();
			return;
		}
	}

	public void commandeRejoindre(int idPartie) {
		try {
			// appeler méthode permettant de rejoindre une partie
		} catch (Exception e) {
			return;
		}
	}

	public void commandeDonnerOrdre(String unite, String ordre) {
		try {
			// appeler méthode ordre;
		} catch (Exception e) {
			return;
		}
	}

	public void commandeEnvoyerMessage(String message, String pseudos) {
		try {
			// appeler méthode envoyer messages qui va aller chercher l'id associé au pseudo
		} catch (Exception e) {
			return;
		}
	}

	public void commandeListerUnites() {
		try {
			// appeler méthode lister unités
		} catch (Exception e) {
			return;
		}
	}

	public void commandeListerCasesControlees() {
		try {
			// appeler méthode lister cases contrôlées
		} catch (Exception e) {
			return;
		}
	}

	public void commandeAfficherCarte() {
		try {
			// appeler méthode afficher carte
		} catch (Exception e) {
			return;
		}
	}

	public void commandeClear() {
		Console c = System.console();

		if (c == null) {
			System.err.println("no console");
			System.exit(1);
		}

		c.writer().print(ESC + "[2J");
		c.flush();
		c.writer().print(ESC + "[1;1H");
		c.flush();
	}

	public void commandeQuitter() {
		System.exit(0);
	}

	public void commandeAide() {
		String setPlainText = "\033[0;0m";
		String setBoldText = "\033[0;1m";

		System.out.println("Liste des commandes :");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("creerPartie");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println(
		"Permet de créer une partie en spécifiant le nombre minimum de joueurs");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"nbMinJoueurs  Le nombre minimum de joueurs acceptés dans la partie");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("rejoindre");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Rejoindre une partie à partir de son id");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("idPartie  L'id de la partie à rejoindre");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("donnerOrdre");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Donner un ordre à une unité");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("unite  L'unité que l'on veut commander");
		System.out.println("ordre  L'ordre que l'on veut donner");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("envoyerMessage");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Envoyer un message à une liste de joueurs");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"pseudos  La liste de pseudos des joueurs à qui envoyer le message");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("listerUnites");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Lister les unités possédées");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("listerCasesControlees");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Lister les cases contrôlées");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("afficherCarte");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Affiche la carte du jeu");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("quitter");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Quitter le jeu");
	}

	public Method getMethodesOrdre(String[] parametres) {
		Method method = null;
		String commande = parametres[0];

		// À modifier selon le nombre de paramètres en entrées
		try {
			if (parametres.length == 1) {
				method = this.getClass().getMethod("commande" +
					commande.substring(0, 1).toUpperCase() +
					commande.substring(1));
			}
			if (parametres.length == 2) {
				method = this.getClass().getMethod("commande" +
					commande.substring(0, 1).toUpperCase() +
					commande.substring(1), int.class);
			}
			if (parametres.length >= 3) {
				method = this.getClass().getMethod("commande" +
					commande.substring(0, 1).toUpperCase() +
					commande.substring(1), String.class,
					String.class, String.class);
			}
		} catch (NoSuchMethodException e) {
			System.out.println(
			"Commande non reconnue. Veuillez entrer une commande valide.");
		}
		return method;
	}

	public String[] getParametresOrdre(String[] parametres) {
		String[] param = null;
		if (parametres.length == 2) {
			param = new String[1];
			param[0] = parametres[1];
		}
		if (parametres.length == 4) {
			param = new String[3];
			param[0] = parametres[1];
			param[1] = parametres[2];
			param[2] = parametres[3];
		}

		return param;
	}

	public void invocation() {
		String[] parametres = this.ordre.split("\\s+");

		try {
			Method method = getMethodesOrdre(parametres);

			method.invoke(this, (Object[])getParametresOrdre(
			parametres));
		}
		// catch(InvocationTargetException e){
		// throw e.getCause();
		// }
		catch (Exception e) {
			// System.out.println("Erreur");
		}
	}

	public void executer() {
		String s = "";

		while (true) {
			System.out.print("diplo >> ");

			Scanner sc = new Scanner(System.in);

			s = sc.nextLine();
			this.setOrdre(s);
			try {
				this.invocation();
			} catch (IllegalArgumentException e) {
				System.out.println(
				"Veuillez entrer les bons paramètres pour cette commande.\n");
			} catch (StringIndexOutOfBoundsException e) {
				System.out.println(
				"Veuillez entrer une commande.\n");
			}
			// catch (Exception e) {
			// System.out.println("Erreur");
			// }
		}
	}
}
