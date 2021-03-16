<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venda extends Model
{
    protected $table = 'vendas';
    protected $primaryKey ="pk_venda";
    public $venda = 'venda';
}
