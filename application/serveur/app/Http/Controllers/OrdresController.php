<?php

namespace Diplo\Http\Controllers;

use Diplo\Armees\ArmeeRepository;
use Diplo\Cartes\CaseRepository;
use Diplo\Exceptions\ArmeeNonExistanteException;
use Diplo\Exceptions\CaseNonExistanteException;
use Diplo\Exceptions\OrdreNonExistantException;
use Diplo\Ordres\Ordre;
use Diplo\Ordres\OrdreRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

    /**
     * Donne un ordre à exécuter à une armée.
     *
     * @param Request $request La requête HTTP
     *
     * @throws OrdreNonExistantException  Le type d'ordre donné n'est pas supporté
     * @throws CaseNonExistanteException  La case ciblée n'existe pas
     * @throws ArmeeNonExistanteException L'armée ciblée n'existe pas
     *
     * @return ResponseFactory
     */
    public function postOrdre(Request $request)
    {
        // Récupération des données
        $typeOrdre = $request->get('ordre', 'Tenir');

        // Vérifie que l'ordre est supporté
        if (!in_array($typeOrdre, Ordre::$typeAcceptes)) {
            throw new OrdreNonExistantException($typeOrdre);
        }

        // Si l'ordre a une case cible
        $case = $this->recupererCase($request);

        // On récupère l'armée
        $armee = $this->recupererArmee($request);

        $this->ordreRepository->passerOrdre($armee, $typeOrdre, $case);

        return $this->responseFactory->json([], 202);
    }

    /**
     * Récupère la case cible dans une requête si celle-ci est présente.
     *
     * @param Request $request
     *
     * @throws CaseNonExistanteException La case ciblée n'existe pas
     *
     * @return null|\Diplo\Cases\CaseInterface
     */
    private function recupererCase(Request $request)
    {
        $case = null;
        if ($request->has('id_case')) {
            try {
                $case = $this->caseRepository->trouverParId($request->get('id_case'));
            } catch (ModelNotFoundException $e) {
                throw new CaseNonExistanteException($request->get('id_case'));
            }
        }

        return $case;
    }

    /**
     * Récupère l'armée passée dans une requête.
     *
     * @param Request $request
     *
     * @throws ArmeeNonExistanteException L'armée n'existe pas
     *
     * @return null|\Diplo\Armees\Armee
     */
    private function recupererArmee(Request $request)
    {
        $idArmee = $request->get('id_armee');

        try {
            $armee = $this->armeeRepository->trouverParId($idArmee);
        } catch (ModelNotFoundException $e) {
            throw new ArmeeNonExistanteException($idArmee);
        }

        return $armee;
    }
}
