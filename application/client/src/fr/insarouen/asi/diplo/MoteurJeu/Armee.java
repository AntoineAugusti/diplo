package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class Armee {
    public int	id;
    public int	id_joueur;
    public int	id_case_courante;

    public Armee(int id, int joueur, int id_case) {
	this.id = id;
	this.id_joueur = joueur;
	this.id_case_courante = id_case;
    }
}
