package fr.insarouen.asi.diplo.Exception.ReseauException;

public class PartieHTTPSException extends Exception {
	public int error;
	public String mess;

	public PartieHTTPSException(int responseCode, String serveurMessage) {
		this.error = responseCode;
		this.mess = serveurMessage;
	}
}
