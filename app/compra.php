<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    protected $primaryKey ="pk_compra";
    public $compra = 'compra';
    protected $table = 'compras';
}
