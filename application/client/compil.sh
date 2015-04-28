echo '----- Compilation du Jeu -----'
echo 'Compilation du Reseau';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/Reseau/*.java
echo 'Compilation de l Affichage';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/Affichage/*.java
echo 'Compilation des Exceptions';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/Exception/ReseauException/*.java
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/Exception/OrdresException/*.java
echo 'Compilation de Negociation';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/MoteurJeu/Negociation/*.java
echo 'Compilation de Ordres';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/MoteurJeu/Ordres/*.java
echo 'Compilation du Moteur de jeu';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/MoteurJeu/*.java
echo 'Compilation du main';
javac -sourcepath src -d classes -cp lib/json-20140107.jar src/fr/insarouen/asi/diplo/*.java

# Exemple de compilation de TU
# echo '----- Compilation des TU -----';
# echo 'Compilation du TestMonde';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/TestDeMonde.java
echo 'Fin de la compilation';
