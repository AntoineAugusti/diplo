package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class CaseComparator implements Comparator<Case> {
	public int compare(Case case1, Case case2) {
		if (case1.id < case2.id) return -1;
		if (case1.id == case2.id) return 0;

		return 1;
	}
}
