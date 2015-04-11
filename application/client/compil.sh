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
# echo 'Compilation des vivants';
# javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/vivants/*.java

# echo '----- Compilation des TU -----';
# echo 'Compilation du TestMonde';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/TestDeMonde.java
# echo 'Compilation du TestEntite';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/TestDeEntite.java
# echo 'Compilation du TestPiedDeBiche';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/TestPiedDeBiche.java
# echo 'Compilation du TestPiece';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/structure/TestDePiece.java
# echo 'Compilation du TestVivant';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/vivants/TestVivant.java
# echo 'Compilation du TestPorte';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/structure/TestDePorte.java
# echo 'Compilation du TestMonstre';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/vivants/TestMonstre.java
# echo 'Compilation du TestSerrure';
# #javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit4-4.10.jar:/usr/share/java/hamcrest-core-1.1.jar:/usr/share/java/hamcrest-library-1.1.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/serrurerie/TestSerrure.java
# echo 'Compilation du TestCoffre';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest -encoding ISO-8859-1 ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/TestDeCoffre.java
# echo 'Compilation de la fin des TU';
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/testsasiaventure.java
# javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/AllTests.java
echo 'Fin de la compilation';
