<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicaoEquipamento extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'requisicao_equipamentos';
    protected $primaryKey ="pk_requisicaoequipamento";
    public $requisicaoequipamento = 'requisicaoequipamento';
}
