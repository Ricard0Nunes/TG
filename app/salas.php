<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salas extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'salas';
    protected $primaryKey ="pk_sala";
    public $sala = 'sala';

  
}
