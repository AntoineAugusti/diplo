package fr.insarouen.asi.diplo.MoteurJeu.Ordres;

public abstract class OrdreCible extends Ordre {

	public int id_case;
	public int id_armee;
	
	public OrdreCible(int id_case, int id_armee){
		this.id_case = id_case;
		this.id_armee = id_armee;
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