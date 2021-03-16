<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crm_tipo_campanhas extends Model
{
    protected $primaryKey ="pk_tipo_campanha";
    public $tipo_campanha = 'tipo_campanha';
    protected $table = 'crm_tipo_campanhas';
}
