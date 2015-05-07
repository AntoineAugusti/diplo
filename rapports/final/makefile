all: rapport

rapport:
	pdflatex -shell-escape rapport.tex
	pdflatex -shell-escape rapport.tex
	pdflatex -shell-escape rapport.tex
	rm -rf *.aux *.log *.out *.pyg *.toc

clean:
	rm -rf *.pdf
