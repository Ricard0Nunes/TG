<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{ 
    protected $connection = 'geraltg';
    protected $table = 'registopontos';
    protected $primaryKey ="pk_ponto";
    public $ponto = 'ponto';
}
