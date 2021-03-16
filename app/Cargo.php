<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $primaryKey ="pk_cargo";
    public $cargo = 'cargo';
    protected $table = 'cargos';

}
