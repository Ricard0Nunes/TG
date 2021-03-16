<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artigo_venda extends Model
{
    protected $table = 'artigos_venda';
    protected $primaryKey ="pk_artigovenda";
    public $artigovenda = 'artigovenda';
}
