echo '------ Lancement de l execution des suites de TU -----'
# java -cp /usr/share/java/junit-4.11.jar:classestest:classes org.junit.runner.JUnitCore fr.insarouen.asi.prog.asiaventure.AllTests
java -cp classestest:classes:/usr/share/java/junit-4.11.jar:/usr/share/java/hamcrest-core-1.3.jar:/usr/share/java/hamcrest-library-1.3.jar org.junit.runner.JUnitCore fr.insarouen.asi.prog.asiaventure.AllTests
