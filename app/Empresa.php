<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey ="pk_empresa";
    public $empresa = 'empresa';
    protected $table = 'empresas';
}
