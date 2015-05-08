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

import fr.insarouen.asi.diplo.MoteurJeu.*;
import fr.insarouen.asi.diplo.Reseau.*;
import fr.insarouen.asi.diplo.Exception.ReseauException.*;
import fr.insarouen.asi.diplo.Exception.OrdresException.*;
import fr.insarouen.asi.diplo.MoteurJeu.Negociation.*;
import fr.insarouen.asi.diplo.MoteurJeu.Ordres.*;

public class Cli {
	private String ordre;
	private Jeu partie;
	private Moteur moteur;
	private Joueur joueur;
	public static final char ESC = 27;

	// constructeur

	/**
	 * Constructeur de la classe Cli,
	 */
	public Cli() {
		this.ordre = null;
		this.partie = null;
		this.moteur = new Moteur();
	}

	// methodes
	public void setOrdre(String ordre) {
		this.ordre = ordre;
	}

	public void commandeRejoindre(String idPartie) {
		try {
			this.partie = moteur.rejoindrePartie(Integer.parseInt(
				idPartie));
			System.out.println(this.partie);
			HashMap<String, Joueur> listeJoueurs =
			partie.getJoueurs();
			System.out.println(listeJoueurs.size());
			for (Joueur j : listeJoueurs.values()) {
				this.joueur = j;				
				System.out.println("Votre pseudo : "+this.joueur.getPseudo());
				System.out.println("Votre pays : "+this.joueur.getPays());
			}
		} catch (PartieIntrouvableException e) {
			System.out.println(e.getMessage());
		}
		catch (PartiePleineException e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeAttaquer(String numeroCase, String numeroArmee) {
		try {
			int partieID = partie.getID();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.COMBAT) {
				Attaquer ordre = new Attaquer(Integer.parseInt(
					numeroCase), Integer.parseInt(
					numeroArmee));
				moteur.posterOrdre(partieID, ordre);
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de combat.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeSoutienDefensif(String numeroCase, String
	numeroArmee) {
		try {
			int partieID = partie.getID();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.COMBAT) {
				SoutienDefensif ordre = new SoutienDefensif(
					Integer.parseInt(numeroCase),
					Integer.parseInt(numeroArmee));
				moteur.posterOrdre(partieID, ordre);
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de combat.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeSoutienOffensif(String numeroCase, String
	numeroArmee) {
		try {
			int partieID = partie.getID();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.COMBAT) {
				SoutienOffensif ordre = new SoutienOffensif(
					Integer.parseInt(numeroCase),
					Integer.parseInt(numeroArmee));
				moteur.posterOrdre(partieID, ordre);
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de combat.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeTenir(String numeroArmee) {
		try {
			int partieID = partie.getID();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.COMBAT) {
				Tenir ordre = new Tenir(Integer.parseInt(
					numeroArmee));
				moteur.posterOrdre(partieID, ordre);
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de combat.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeCreerConversation(String
	listePseudos) {
		try {
			// int partieID = partie.getID();
			int partieID = 1;
			ArrayList<Integer> destinataires =
			new ArrayList<Integer>();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.NEGOCIATION) {
				String[] pseudos = listePseudos.split(",");
				for (int i = 0; i < pseudos.length; i++)
					destinataires.add(
					partie.getJoueurByPseudo(
					pseudos[i]).getId());
				Conversation conversation =
				moteur.creerConversation(destinataires);
				System.out.println("ID de la conversation avec "+listePseudos+" : "+conversation.getID());
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de négociation.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeEnvoyerMessage(String idConversation, String
	message) {
		try {
			int partieID = partie.getID();
			ArrayList<Integer> destinataires =
			new ArrayList<Integer>();
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.NEGOCIATION) {
				moteur.posterMessage(Integer.parseInt(idConversation),
				this.joueur.getId(), message);
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de négociation.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeInfosConversations() {
		try {
			int partieID = partie.getID();
			ArrayList<Conversation> conversations =
			new ArrayList<Conversation>();
			String listeJoueurs = "";
			ArrayList<Integer> joueurs = new ArrayList<Integer>();

			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.NEGOCIATION) {
				conversations = moteur.recupererInfosConversationSelonJoueur(this.joueur.getId());
				System.out.println("Conversations : ");
				for (Conversation c : conversations) {
					joueurs = c.getIdJoueurs();
					for(Joueur j : joueurs) {
						listeJoueurs = listeJoueurs + j.getPseudo()+", ";
					}
					System.out.println("ID : "+c.getID()+", Joueurs : "+listeJoueurs.substring(0, listeJoueurs.length - 2));
				}
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de négociation.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeHistoriqueConversation(String idConversation) {
		try {
			int partieID = partie.getID();
			String listeJoueurs = "";
			ArrayList<Integer> joueurs = new ArrayList<Integer>();
			ArrayList<Message> messages = new ArrayList<Message>();

			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() ==
			Phase.Statut.NEGOCIATION) {
				Conversation conversation = moteur.recupererInfosConversation(Integer.parseInt(idConversation));
				System.out.println("Conversation : ");
				System.out.println("");
				messages = c.getMessages();
				for(Message m : messages) {
					System.out.println("Joueur : "+partie.getJoueur(m.getIdJoueur()).getPseudo());
					System.out.println("Date : "+m.getDateCreation());
					System.out.println("Texte : "+m.getTexte());
					System.out.println("");
				}
			} else {
				System.out.println(
				"Vous n'êtes pas en phase de négociation.");
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeListerArmees() {
		try {

		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeAfficherParticipants() {
		try {
			if (moteur.recupererInfosPhase(
			partieID).getStatutPhaseCourante() !=
			Phase.Statut.INACTIF) {		
				ArrayList<Joueur> participants = moteur.recupererInfosJoueurs(partie.getID());
				for (Joueur j : participants) {
					System.out.println("Pseudo : "+j.getPseudo()+", Couleur : "+j.getCouleurJoueur());
				}
			} else {
				System.out.println("La partie n'a pas encore commencée.")
			}
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandePhaseCourante() {
		try {	
			Phase phase = moteur.recupererInfosJoueurs(partie.getID());
			System.out.println("Phase : "+phase.getStatutPhaseCourante()+", Temps : "+phase.getChrono());
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeListerCasesControlees() {
		try {
			// appeler méthode lister cases contrôlées
		} catch (Exception e) {
			System.out.println(e.getMessage());
		}
	}

	public void commandeAfficherCarte() {
		try {
			AffichageCarte afficheCarte = new AffichageCarte(
				this.partie);
			afficheCarte.enregistrerCarte(10);
			afficheCarte.lireCarte("carte.sh");
		} catch (Exception e) {
			System.out.println(e.getMessage());
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
		System.out.println("rejoindre");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Rejoindre une partie à partir de son id");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("idPartie  L'id de la partie à rejoindre");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("attaquer");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Lancer une attaque");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"numéro de case  La case que l'on veut attaquer");
		System.out.println(
		"numéro de l'armée  L'armée que l'on veut contrôler");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("soutienDefensif");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Lancer un soutien défensif");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"numéro de case  La case que l'on veut soutenir");
		System.out.println(
		"numéro de l'armée  L'armée que l'on veut contrôler");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("soutienOffensif");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Lancer un soutien offensif");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"numéro de case  La case que l'on veut soutenir");
		System.out.println(
		"numéro de l'armée  L'armée que l'on veut contrôler");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("tenir");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Tenir la case courante");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"numéro de l'armée  L'armée que l'on veut faire tenir");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("creerConversation");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Créer une conversation associée une liste de joueurs");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println(
		"pseudos  La liste de pseudos des joueurs à qui envoyer le message séparé par des virgules");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("envoyerMessage");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Envoyer un message à une liste de joueurs dans une conversation");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("idConversation L'id de la conversation où l'on veut poster le message");
		System.out.println(
		"pseudos  La liste de pseudos des joueurs à qui envoyer le message");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("infosConversations");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Récupère les ids des conversations");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("historiqueConversation");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Affiche l'historique d'une conversation");
		System.out.println(setBoldText + "OPTIONS" + setPlainText);
		System.out.println("idConversation L'id de la conversation à afficher");
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
		System.out.println("afficherParticipants");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Liste les participants de la partie");
		System.out.println("");

		System.out.println(setBoldText + "NOM" + setPlainText);
		System.out.println("phaseCourante");
		System.out.println(setBoldText + "DESCRIPTION" + setPlainText);
		System.out.println("Affiche la phase courante et le temps restant");
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
					commande.substring(1), String.class);
			}
			if (parametres.length >= 3) {
				method = this.getClass().getMethod("commande" +
					commande.substring(0, 1).toUpperCase() +
					commande.substring(1), String.class,
					String.class);
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
		}
	}
}
