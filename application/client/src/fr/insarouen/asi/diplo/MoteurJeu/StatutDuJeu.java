package fr.insarouen.asi.diplo.MoteurJeu;

public class StatutDuJeu {
    private String	statut;
    private String	message;

    public StatutDuJeu(String statut, String message) {
	this.statut = statut;
	this.message = message;
    }

    public String getMessage() {
	return message;
    }

    public boolean setMessage(String nouveauMessage) {
	this.message = nouveauMessage;
	return true;
    }

    public String getStatutDuJeu() {
	return statut;
    }

    public boolean setStatutDuJeu(String nouveauStatut) {
	this.statut = nouveauStatut;
	return true;
    }
}
