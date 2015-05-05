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
        if ($ordre instanceof Attaquer) {
            $caseId = $ordre->getCase()->getId();

            // La case n'est occupée par personne, on peut se déplacer immédiatement
            if (!$ordre->getCase()->estOccupee()) {
                $this->armeeRepository->deplacerArmee($ordre->getArmee(), $caseId);
                // Regardons si on peut se déplacer sur la case qui est occupée
            } else {
                // On compte le nombre de soutiens offensifs et défensifs
                $nbSoutiensOffensifs = $this->calculerSoutiensOffensifs($caseId, $autresOrdres);
                $nbSoutiensDefensifs = $this->calculerSoutiensDefensifs($caseId, $autresOrdres);

                // Si il y a eu plus de soutiens offensifs, on peut exécuter l'ordre
                if ($nbSoutiensOffensifs > $nbSoutiensDefensifs) {
                    $this->deplacerArmeeAleatoirementOuDetruire($ordre->getCase()->getArmee());
                    $this->armeeRepository->deplacerArmee($ordre->getArmee(), $caseId);
                }
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
        $idCasesVoisinesNonOccupees = [];

        // On ne conserve que les cases voisines non occupées
        foreach ($casesVoisines as $caseVoisine) {
            if (!$caseVoisine->estOccupee()) {
                $idCasesVoisinesNonOccupees[] = $caseVoisine->getId();
            }
        }

        // On ne peut se déplacer sur aucune case voisine, on détruit l'armée
        if (empty($idCasesVoisinesNonOccupees)) {
            $this->armeeRepository->detruireArmee($armee);
        // Sinon, on se déplace aléatoirement sur une des cases voisines
        } else {
            $this->armeeRepository->deplacerArmee(
                $armee,
                array_rand($idCasesVoisinesNonOccupees)
            );
        }
    }
}
