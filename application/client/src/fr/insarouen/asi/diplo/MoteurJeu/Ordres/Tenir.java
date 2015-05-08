package fr.insarouen.asi.diplo.MoteurJeu.Ordres;

public class Tenir extends Ordre {
	public String ordre = "Tenir";
	public int id_armee;

	public Tenir(int id_armee) {
		this.id_armee = id_armee;
	}
}
