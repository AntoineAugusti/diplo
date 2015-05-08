package fr.insarouen.asi.diplo.MoteurJeu.Ordres;

public class Attaquer extends OrdreCible {
	public String ordre = "Attaquer";

	public Attaquer(int id_case, int id_armee) {
		super(id_case, id_armee);
	}
}
