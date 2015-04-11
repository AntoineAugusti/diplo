package fr.insarouen.asi.diplo.MoteurJeu.Ordres;

public abstract class OrdreCible extends Ordre {

	public int id_case;
	
	public OrdreCible(int id_case){
		this.id_case = id_case;
	}

	public int getCaseCible(){
		return this.id_case;
	}

	public void setCaseCible(int id_case){
		this.id_case = id_case;
	}

	public boolean estOrdreCible(){
		return true;
	}
}