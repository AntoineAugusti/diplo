<?php

namespace Diplo\Ordres;

use Closure;
use Diplo\Armees\Armee;
use Diplo\Armees\ArmeeRepository;

class AttaquerExecuteur extends OrdreCibleExecuteur
{
    /**
     * @var ArmeeRepository
     */
    protected $armeeRepository;

    /**
     * @param ArmeeRepository $armeeRepository
     */
    public function __construct(ArmeeRepository $armeeRepository)
    {
        $this->armeeRepository = $armeeRepository;
    }

    /**
     * Exécute l'ordre.
     *
     * @param Ordre   $ordre
     * @param Ordre[] $autresOrdres
     */
    public function executer(Ordre $ordre, array $autresOrdres)
    {
        // Nécessaire pour avoir l'autocompletion de l'IDE.
        if (!($ordre instanceof Attaquer)) {
            return;
        }

        $caseId = $ordre->getCase()->getId();

        if (is_null($ordre->getCase()->getArmee())) {
            $this->armeeRepository->deplacerArmee($ordre->getArmee(), $caseId);
        } else {
            $soutiensOffensifs = $this->calculerSoutiensOffensifs($caseId, $autresOrdres);
            $soutiensDefensifs = $this->calculerSoutiensDefensifs($caseId, $autresOrdres);

            if ($soutiensOffensifs > $soutiensDefensifs) {
                $this->deplacerArmeeAleatoirementOuDetruire($ordre->getCase()->getArmee());
                $this->armeeRepository->deplacerArmee($ordre->getArmee(), $caseId);
            }
        }
    }

    /**
     * Vérifie si l'ordre est possible.
     *
     * @param Ordre $ordre
     *
     * @return bool
     */
    public function verifierOrdre(Ordre $ordre)
    {
        if (!($ordre instanceof Attaquer)) {
            return false;
        }

        return $this->verifierSiCaseCibleEstCaseVoisine($ordre);
    }

    /**
     * Calcule le nombre de soutiens pour une case.
     *
     * @param Closure $estBonTypeSoutien
     * @param int     $caseId
     * @param array   $ordres
     *
     * @return int
     */
    protected function calculerSoutiens(Closure $estBonTypeSoutien, $caseId, array $ordres)
    {
        $nombreSoutiens = 0;

        foreach ($ordres as $ordre) {
            if ($estBonTypeSoutien($ordre) and $ordre->getCase()->getId() == $caseId) {
                $nombreSoutiens++;
            }
        }

        return $nombreSoutiens;
    }

    /**
     * Calcule le nombre de soutiens offensifs pour une case.
     *
     * @param int     $caseId
     * @param Ordre[] $ordres
     *
     * @return int
     */
    protected function calculerSoutiensOffensifs($caseId, array $ordres)
    {
        return $this->calculerSoutiens(function ($ordre) {
            return $ordre instanceof SoutienOffensif;
        }, $caseId, $ordres);
    }

    /**
     * Calcule le nombre de soutiens défensifs pour une case.
     *
     * @param int     $caseId
     * @param Ordre[] $ordres
     *
     * @return int
     */
    protected function calculerSoutiensDefensifs($caseId, array $ordres)
    {
        return $this->calculerSoutiens(function ($ordre) {
            return $ordre instanceof SoutienDefensif;
        }, $caseId, $ordres);
    }

    /**
     * Déplace une armée aléatoirement ou détruit l'armée.
     *
     * @param Armee $armee
     */
    protected function deplacerArmeeAleatoirementOuDetruire(Armee $armee)
    {
        $casesVoisines = $armee->getCase()->getCasesVoisines();
        $idCasesVoisinesLibres = [];

        foreach ($casesVoisines as $caseVoisine) {
            if (is_null($caseVoisine->getArmee())) {
                $idCasesVoisinesLibres[] = $caseVoisine->getId();
            }
        }

        if (empty($idCasesVoisinesLibres)) {
            $this->armeeRepository->detruireArmee($armee);
        } else {
            $this->armeeRepository->deplacerArmee(
                $armee,
                array_rand($idCasesVoisinesLibres)
            );
        }
    }
}
