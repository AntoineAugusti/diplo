package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class Couleur {
	public Couleur() {}

	private int[] permutationDeFischerYatts(int[] tableau, int dimension) {
		int resultat[] = new int[dimension];
		Random rand = new Random();
		int indice = 0;
		int max = tableau.length - 1;

		while (indice < resultat.length && max != 0) {
			int ind = rand.nextInt(max);
			int temp = tableau[ind];

			tableau[ind] = tableau[max];
			tableau[max] = temp;
			resultat[indice] = tableau[max];
			max = max - 1;
			indice++;
		}
		resultat[indice] = tableau[max];
		return resultat;
	}

	public int[] genererPiscineDeCouleur() {
		int dimension = 5;
		int couleur[] = new int[dimension];
		int piscineDeCouleur[] = new int[] { 41, 43, 44, 45, 46 };

		couleur = permutationDeFischerYatts(piscineDeCouleur,
			dimension);

		return couleur;
	}
}
