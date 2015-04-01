echo '----- Compilation du Jeu -----'
echo 'Compilation de la base';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/*.java
echo 'Compilation des elements';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/*.java
echo 'Compilation des objets';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/objets/*.java
echo 'Compilation des structures';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/structure/*.java
echo 'Compilation de la serrurerie';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/objets/serrurerie/*.java
echo 'Compilation des vivants';
javac -sourcepath src -d classes src/fr/insarouen/asi/prog/asiaventure/elements/vivants/*.java

echo '----- Compilation des TU -----';
echo 'Compilation du TestMonde';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/TestDeMonde.java
echo 'Compilation du TestEntite';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/TestDeEntite.java
echo 'Compilation du TestPiedDeBiche';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/TestPiedDeBiche.java
echo 'Compilation du TestPiece';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/structure/TestDePiece.java
echo 'Compilation du TestVivant';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/vivants/TestVivant.java
echo 'Compilation du TestPorte';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/structure/TestDePorte.java
echo 'Compilation du TestMonstre';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/vivants/TestMonstre.java
echo 'Compilation du TestSerrure';
#javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit4-4.10.jar:/usr/share/java/hamcrest-core-1.1.jar:/usr/share/java/hamcrest-library-1.1.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/serrurerie/TestSerrure.java
echo 'Compilation du TestCoffre';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest -encoding ISO-8859-1 ./testsrc/fr/insarouen/asi/prog/asiaventure/elements/objets/TestDeCoffre.java
echo 'Compilation de la fin des TU';
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/testsasiaventure.java
javac -sourcepath ./testsrc -cp classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar -d ./classestest ./testsrc/fr/insarouen/asi/prog/asiaventure/AllTests.java


echo 'Fin de la compilation';
