<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crm_campanhas extends Model
{
    protected $primaryKey ="pk_campanha";
    public $campanha = 'campanha';
    protected $table = 'crm_campanhas';
}

