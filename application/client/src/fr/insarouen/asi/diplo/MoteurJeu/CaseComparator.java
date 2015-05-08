package fr.insarouen.asi.diplo.MoteurJeu;

import java.util.*;

public class CaseComparator implements Comparator<Case> {
	public int compare(Case case1, Case case2) {
		if (case1.getId() < case2.getId()) return -1;
		if (case1.getId() == case2.getId()) return 0;

		return 1;
	}
}
