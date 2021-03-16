<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'despesa';
    protected $primaryKey ="pk_despesa";
    public $despesa = 'despesa';
}
