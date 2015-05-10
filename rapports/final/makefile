all: rapport

rapport:
	plantuml diagrammes/php-export-cut/*.plantuml
	plantuml diagrammes/*.plantuml
	pdflatex -shell-escape rapport.tex
	pdflatex -shell-escape rapport.tex
	pdflatex -shell-escape rapport.tex
	rm -rf *.aux *.log *.out *.pyg *.toc

clean:
	rm -rf *.pdf *.out *.log diagrammes/php-export-cut/*.png diagrammes/*.png
