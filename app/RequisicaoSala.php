<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicaoSala extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'requisicao_salas';
    protected $primaryKey ="pk_requisicaosala";
    public $requisicaosala = 'requisicaosala';


}
