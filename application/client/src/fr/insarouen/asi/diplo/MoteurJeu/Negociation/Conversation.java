package fr.insarouen.asi.diplo.MoteurJeu.Negociation;

import java.util.ArrayList;

public class Conversation {

	public int id_conversation;
	public ArrayList<Integer> id_joueurs;
	public ArrayList<Message> messages;
	
	public Conversation(int id_conversation, ArrayList<Integer> id_joueurs, ArrayList<Message> messages){
		this.id_conversation = id_conversation;
		this.id_joueurs = id_joueurs;
		this.messages = messages;
	}

	public Conversation(int id_conversation, ArrayList<Integer> id_joueurs){
		this(id_conversation, id_joueurs, new ArrayList<Message>());
	}

	public int getID(){
		return this.id_conversation;
	}

	public ArrayList<Integer> getIdJoueurs(){
		return this.id_joueurs;
	}

	public ArrayList<Message> getMessages(){
		return this.messages;
	}

	public void setMessages(ArrayList<Message> messages){
		this.messages = messages;
	}

	public void addMessage(Message message){
		this.messages.add(message);
	}
}