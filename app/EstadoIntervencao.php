<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoIntervencao extends Model
{
    protected $table = 'estadointervencoes';
    protected $primaryKey ="pk_estadoIntervencao";
    public $estadointervencao = 'estadointervencao';
}
