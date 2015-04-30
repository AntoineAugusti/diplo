<?php namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Diplo\Joueurs\Joueur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdreModel extends Model
{
    /**
     * @var Ordre
     */
    protected $ordre = null;

    /**
     * Définit la relation avec une armée.
     *
     * @return HasOne
     */
    public function armee()
    {
        return $this->hasOne(Armee::class, 'id_armee', 'id');
    }

    /**
     * Définit la relation avec une case cible.
     *
     * @return HasOne
     */
    public function caseCible()
    {
        return $this->hasOne(CaseClass::class, 'id_case', 'id');
    }

    /**
     * @return Ordre
     */
    public function getOrdre()
    {
        if (is_null($this->ordre))
            $this->recreerOrdre();

        return $this->ordre;
    }

    /**
     * @param Ordre $ordre
     */
    public function setOrdre(Ordre $ordre)
    {
        $this->ordre = $ordre;
    }

    /**
     * Recrée l'ordre d'après les informations de la base de données.
     *
     * @return void
     */
    protected function recreerOrdre()
    {
        switch ($this->type) {
            case "Attaquer":
                $ordre = new Attaquer();
                break;
            case "SoutienOffensif":
                $ordre = new SoutienOffensif();
                break;
            case "SoutienDefensif":
                $ordre = new SoutienDefensif();
                break;
            default:
                $ordre = new Tenir();
                break;
        }

        $ordre->setArmee($this->armee);
        $ordre->setJoueur($this->armee->getProprietaire());

        if ($ordre instanceof OrdreCible) {
            $ordre->setCase($this->caseCible);
        }

        $this->setOrdre($ordre);
    }
}
