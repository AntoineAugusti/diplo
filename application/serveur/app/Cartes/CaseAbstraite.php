<?php

namespace Projets\diplo\application\serveur\app\Cartes;

/**
 * Class CaseAbstraite
 */
abstract class CaseAbstraite
{

    /**
     * ??
     *
     * @var string
     */
    private $nom;

    /**
     * L'armée qui possède cette case
     *
     * @var Armee
     */
    private $armee;

    /**
     * La liste des cases voisines de celle ci
     *
     * @var List<CaseInterface>
     */
    private $voisins;

    /**
     * Le joueur qui possède cette case
     *
     * @var Joueur
     */
    private $proprietaire;

    /**
     * Parametre de la cotiere - itude de cette case
     *
     * @var boolean
     */
    protected $estCotiere;

    /**
     * getNom
     * @return string : Le nom de cette case
     */
    public function getNom()
    {
        return $nom;
    }

    /**
     * getVoisins
     * @return List<CaseInterface>
     */
    public function getVoisins()
    {
        return $voisins;
    }

    /**
     * getArmee
     * @return Armee
     */
    public function getArmee()
    {
        return $armee;
    }

    /**
     * setArmee
     * @return void
     * @author John Doe
     */
    public function setArmee(Armee $armee)
    {
        this.$armee = $armee;
    }

    /**
     * getProprietaire
     * @return void
     */
    public function getProprietaire()
    {
        return $proprietaire;
    }

    /**
     * setProprietaire
     * @return void
     **/
    public function setProprietaire()
    {
        this.$proprietaire = $proprietaire;
    }

    /**
     * estLibre
     * @return boolean
     * @author John Doe
     **/
    public function estLibre()
    {
        return true;
    }

    /**
     * estMaritime
     * @return boolean
     */
    abstract public function estMaritime();

    /**
     * estTerrestre
     * @return boolean
     */
    abstract public function estTerrestre();
}

