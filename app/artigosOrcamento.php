<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artigosOrcamento extends Model
{
    protected $table = 'artigo_orcamento';
    protected $primaryKey ="pk_artigoorcamento";
    public $artigoorcamento = 'artigoorcamento';
}
