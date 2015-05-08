package fr.insarouen.asi.diplo.MoteurJeu.Ordres;

public abstract class Ordre {
	public String ordre;
	public String getOrdre() {
		return this.ordre;
	}

	public boolean estOrdreCible() {
		return false;
	}
}
