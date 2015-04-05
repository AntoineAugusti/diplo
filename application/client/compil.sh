echo '----- Compilation du Jeu -----'
echo 'Compilation du Network';
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/Network/*.java
echo 'Compilation du Display';
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/Display/*.java
echo 'Compilation des Exceptions';
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/Exception/Network/*.java
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/Exception/Orders/*.java
echo 'Compilation du Game';
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/Game/*.java
echo 'Compilation du main';
javac -sourcepath src -d classes src/fr/insarouen/asi/diplo/*.java
echo 'Fin de la compilation';
