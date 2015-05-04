<?php

namespace Diplo\Cartes;

use Illuminate\Database\Eloquent\Model;

class CaseVoisine extends Model
{
    /**
     * La table associée avec le model.
     *
     * @var string
     */
    protected $table = 'cases_cases';

    /**
     * Les attributs du modèle qui doivent être castés vers des types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'case_parente' => 'integer',
        'case_voisine' => 'integer',
    ];
}
