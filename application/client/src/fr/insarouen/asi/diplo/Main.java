package fr.insarouen.asi.diplo;

import fr.insarouen.asi.diplo.Affichage.Cli;
import fr.insarouen.asi.diplo.MoteurJeu.*;
import java.lang.*;
import java.util.*;
import org.json.*;


public class Main {
	public static Cli cli = new Cli();

	public static void main(String[] args) throws Throwable {
		System.out.println("");
		System.out.println(
		"    ____  _       __                      __  _    ");
		System.out.println(
		"   / __ \\(_)___  / /___  ____ ___  ____ _/ /_(_)__ ");
		System.out.println(
		"  / / / / / __ \\/ / __ \\/ __ `__ \\/ __ `/ __/ / _ \\");
		System.out.println(
		" / /_/ / / /_/ / / /_/ / / / / / / /_/ / /_/ /  __/");
		System.out.println(
		"/_____/_/ .___/_/\\____/_/ /_/ /_/\\__,_/\\__/_/\\___/ ");
		System.out.println(
		"       /_/                                         ");
		System.out.println("");
		System.out.println("");
		System.out.println("Bienvenue !");
		System.out.println("");

		System.out.println("");
		System.out.println(
		"Si c'est votre première visite, n'hésitez pas à jetter un coup d'oeil à l'Aide (aide).");
		cli.executer();
	}
}
