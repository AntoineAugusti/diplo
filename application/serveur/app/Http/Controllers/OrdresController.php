<?php

namespace Diplo\Http\Controllers;

use Diplo\Armees\ArmeeRepository;
use Diplo\Cartes\CaseRepository;
use Diplo\Http\Requests\Request;
use Diplo\Ordres\Ordre;
use Diplo\Ordres\OrdreRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param CaseRepository  $caseRepository
     * @param OrdreRepository $ordreRepository
     */
    public function __construct(ResponseFactory $responseFactory, ArmeeRepository $armeeRepository, CaseRepository $caseRepository, OrdreRepository $ordreRepository)
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

        if (!in_array($typeOrdre, Ordre::$typeAcceptes)) {
            return $this->responseFactory->json([
                'statut' => 'ordre_inconnu',
                'erreur' => "L'ordre $typeOrdre n'existe pas. Valeurs possibles : Tenir, Attaquer, SoutienDefensif ou SoutienOffensif",
            ], 404);
        }

        if ($request->has('id_case')) {
            try {
                $case = $this->caseRepository->trouverParId($request->get('id_case'));
            } catch (ModelNotFoundException $e) {
                return $this->responseFactory->json([
                    'statut' => 'case_non_trouvee',
                    'erreur' => 'La case '.$request->get('id_case')." n'existe pas",
                ], 404);
            }
        } else {
            $case = null;
        }

        try {
            $armee = $this->armeeRepository->trouverParId($idArmee);
        } catch (ModelNotFoundException $e) {
            return $this->responseFactory->json([
                'statut' => 'armee_non_trouvee',
                'erreur' => "L'armée $idArmee n'existe pas",
            ], 404);
        }

        $this->ordreRepository->passerOrdre($armee, $typeOrdre, $case);

        return $this->responseFactory->json([], 202);
    }
}
