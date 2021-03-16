<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EdicaoPonto extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'pedidoalteracaoponto';
    protected $primaryKey ="pk_pedidoAlteracaoPonto";
    public $edicaoponto = 'edicaoponto';
}
