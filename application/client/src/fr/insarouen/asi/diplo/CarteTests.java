package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.*;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.lang.*;
import java.util.*;

public class CarteTests {
    public static void main(String[] args) throws Throwable {
	Carte	carte = new Carte();
	Random	rand = new Random();
	Couleur couleur = new Couleur();

	int[]	couleurs = couleur.genererPiscineDeCouleur();

	Joueur	joueur1 = new Joueur(1, "pseudo1", "FRA", 4, 4);
	Joueur	joueur2 = new Joueur(2, "pseudo2", "FRA", 4, 4);
	Joueur	joueur3 = new Joueur(3, "pseudo3", "FRA", 4, 4);
	Joueur	joueur4 = new Joueur(4, "pseudo4", "FRA", 4, 4);
	Joueur	joueur5 = new Joueur(5, "pseudo5", "FRA", 4, 4);

	joueur1.setCouleur(couleurs[0]);
	joueur2.setCouleur(couleurs[1]);
	joueur3.setCouleur(couleurs[2]);
	joueur4.setCouleur(couleurs[3]);
	joueur5.setCouleur(couleurs[4]);
	for (int i = 0; i < 100; i++) {
	    boolean	est_libre = false;
	    boolean	est_occupee = false;
	    int		idJoueur = rand.nextInt(6);
	    int		idArmee = rand.nextInt(6);

	    if (idJoueur == 0)
		est_libre = true;
	    if (idArmee == 0)
		est_occupee = true;
	    Case c = new Case(i + 1, est_libre, idJoueur, est_occupee, idArmee,
		null);

	    carte.ajouterCase(c);
	}

	Jeu jeu = new Jeu(1, 5, 5);

	jeu.setCarte(carte);
	jeu.miseAJourJoueur(joueur1);
	jeu.miseAJourJoueur(joueur2);
	jeu.miseAJourJoueur(joueur3);
	jeu.miseAJourJoueur(joueur4);
	jeu.miseAJourJoueur(joueur5);

	AffichageCarte afficheCarte = new AffichageCarte(jeu);

	afficheCarte.saveToMap(10);
	afficheCarte.readMap("carte.sh");
    }
}
