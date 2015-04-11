package fr.insarouen.asi.diplo.MoteurJeu;
import java.util.*;

public class Carte{
	private HashMap<Integer,Case> plan;

	public Carte(){
		plan = new HashMap<Integer,Case>();
	}

	public boolean ajouterCase(Case nouvelle){
		boolean ajoute=false;
		if (!plan.containsKey(nouvelle.id)){
			plan.put(nouvelle.id,nouvelle);
			ajoute=true;
		}
		return ajoute;
	}
	public boolean majCase(Case nouvelle){
		plan.put(nouvelle.id,nouvelle);
		return true;
	}
	public Case getCase(int caseID){
		return plan.get(caseID);
	}
	public Collection<Case> getCases(){
		return plan.values();
	}
}