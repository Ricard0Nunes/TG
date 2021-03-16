<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervencao extends Model
{
    protected $table = 'intervencoes';
    protected $primaryKey ="pk_intervencao";
    public $intervencao = 'intervencao';
}
