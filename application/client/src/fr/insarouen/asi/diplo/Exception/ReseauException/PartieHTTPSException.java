package fr.insarouen.asi.diplo.Exception.ReseauException;

public class PartieHTTPSException extends ReseauException {
	public int error;
	public String mess;

	public PartieHTTPSException(int responseCode, String serveurMessage) {
		super(serveurMessage);
		this.error = responseCode;
		this.mess = serveurMessage;
	}
}
