<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustosExtraProjeto extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'custos_extra_projetos';
    protected $primaryKey ="pk_custoextra";
    public $custoextraprojeto = 'custoextraprojeto';
}
