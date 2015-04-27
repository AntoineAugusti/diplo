package fr.insarouen.asi.diplo.Exception.ReseauException;

public class PartieHTTPSException extends Exception{
		public int error;
	public PartieHTTPSException(int responseCode){
		this.error = responseCode;	
	}
}
