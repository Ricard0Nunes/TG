<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class armazem extends Model
{
    protected $table = 'armazens';
    protected $primaryKey ="pk_armazem";
    public $armazem = 'armazem';
}
