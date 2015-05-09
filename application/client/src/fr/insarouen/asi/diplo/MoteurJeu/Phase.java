package fr.insarouen.asi.diplo.MoteurJeu;


public class Phase {
	public enum Statut {
		NEGOCIATION, COMBAT, INACTIF
	}

	private Statut statut;

	private int chrono;

	public Phase() {
		this.statut = Phase.Statut.INACTIF;
		this.chrono = 0;
	}

	public Phase(Statut statut, int chrono) {
		this.statut = statut;
		this.chrono = chrono;
	}

	public int getChrono() {
		return chrono;
	}

	public boolean setChrono(int nouveauChrono) {
		this.chrono = nouveauChrono;
		return true;
	}

	public Statut getStatutPhaseCourante() {
		return statut;
	}

	public boolean setStatutPhaseCourante(Statut nouveauStatut) {
		boolean set = false;

		if (nouveauStatut != Phase.Statut.INACTIF) {
			this.statut = nouveauStatut;
			set = true;
		}

		return set;
	}
}
