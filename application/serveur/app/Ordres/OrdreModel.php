<?php

namespace Diplo\Ordres;

use Diplo\Armees\Armee;
use Diplo\Cartes\CaseClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdreModel extends Model
{
    /**
     * La table associée avec le modèle.
     *
     * @var string
     */
    protected $table = 'ordres';

    protected $fillable = ['type', 'id_armee', 'id_case'];

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'execute' => 'boolean',
    ];

    /**
     * @var Ordre
     */
    protected $ordre = null;

    /**
     * Définit la relation avec une armée.
     *
     * @return BelongsTo
     */
    public function armee()
    {
        return $this->belongsTo(Armee::class, 'id_armee', 'id');
    }

    /**
     * Définit la relation avec une case cible.
     *
     * @return BelongsTo
     */
    public function caseCible()
    {
        return $this->belongsTo(CaseClass::class, 'id_case', 'id');
    }

    /**
     * @return Ordre
     */
    public function getOrdre()
    {
        if (is_null($this->ordre)) {
            $this->recreerOrdre();
        }

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
     */
    protected function recreerOrdre()
    {
        switch ($this->type) {
            case 'Attaquer':
                $ordre = new Attaquer();
                break;
            case 'SoutienOffensif':
                $ordre = new SoutienOffensif();
                break;
            case 'SoutienDefensif':
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

    /**
     * Marque l'ordre modèle comme exécuté.
     */
    public function executer()
    {
        $this->execute = true;
        $this->save();
    }
}
