<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caixaGrupo extends Model
{
    protected $table = 'caixamsggrupo';
    protected $primaryKey ="pk_caixaEntradaGrupo";
    public $caixaEntradaGrupo = 'caixaEntradaGrupo';
}
