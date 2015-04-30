<?php namespace Diplo\Http\Controllers;

use Diplo\Armees\ArmeeRepository;
use Diplo\Cartes\CaseRepository;
use Diplo\Http\Requests\Request;
use Diplo\Ordres\OrdreRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

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
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @param ResponseFactory $responseFactory
     * @param ArmeeRepository $armeeRepository
     * @param CaseRepository $caseRepository
     * @param OrdreRepository $ordreRepository
     */
    function __construct(ResponseFactory $responseFactory, ArmeeRepository $armeeRepository, CaseRepository $caseRepository, OrdreRepository $ordreRepository)
    {
        $this->ordreRepository = $ordreRepository;
        $this->armeeRepository = $armeeRepository;
        $this->caseRepository = $caseRepository;
        $this->responseFactory = $responseFactory;
    }

    public function postOrdres(Request $request)
    {
        // Récupération des données
        $idArmee = $request->get('id_armee');
        $typeOrdre = $request->get('ordre', 'Tenir');

        if ($request->has('id_case')) {
            $case = $this->caseRepository->trouverParId($request->get('id_case'));
        } else {
            $case = null;
        }
        $armee = $this->armeeRepository->trouverParId($idArmee);

        $this->ordreRepository->passerOrdre($armee, $typeOrdre, $case);

        return $this->responseFactory->json([], 202);
    }
}
