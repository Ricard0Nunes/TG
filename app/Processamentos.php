<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Processamentos extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'processamentos';
    protected $primaryKey ="pk_processamento";
    public $Processamentos = 'Processamentos';
}
