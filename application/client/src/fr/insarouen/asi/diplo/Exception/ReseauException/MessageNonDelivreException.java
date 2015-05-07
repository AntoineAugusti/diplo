package fr.insarouen.asi.diplo.Exception.ReseauException;

public class MessageNonDelivreException extends Exception {
    public MessageNonDelivreException(String message) {
	System.out.println(message);
    }
}
