<?php namespace Diplo\Http\Controllers;

use Diplo\Armees\ArmeeRepository;
use Diplo\Cartes\CaseRepository;
use Diplo\Ordres\OrdreRepository;

class OrdresController extends Controller
{
    /**
     * @var OrdreRepository
     */
    private $ordreRepository;
    /**
     * @var ArmeeRepository
     */
    private $armeeRepository;
    /**
     * @var CaseRepository
     */
    private $caseRepository;

    /**
     * @param ArmeeRepository $armeeRepository
     * @param CaseRepository $caseRepository
     * @param OrdreRepository $ordreRepository
     */
    function __construct(ArmeeRepository $armeeRepository, CaseRepository $caseRepository, OrdreRepository $ordreRepository)
    {
        $this->ordreRepository = $ordreRepository;
        $this->armeeRepository = $armeeRepository;
        $this->caseRepository = $caseRepository;
    }

    public function postOrdres()
    {
        // Récupération des données
        $idArmee = Input::get('id_armee');
        $typeOrdre = Input::get('ordre', 'Tenir');

        if (Input::has('id_case')) {
            $case = $this->caseRepository->trouverParId(Input::get('id_case'));
        } else {
            $case = null;
        }
        $armee = $this->armeeRepository->trouverParId($idArmee);

        $this->ordreRepository->passerOrdre($armee, $typeOrdre, $case);

        return Response::json([], 202);
    }
}
