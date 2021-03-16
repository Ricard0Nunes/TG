<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    protected $table = 'ivas';
    protected $primaryKey ="pk_iva";
    public $iva = 'iva';
}
