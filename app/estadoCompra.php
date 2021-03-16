<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadoCompra extends Model
{
    protected $table = 'estado_compra';
    protected $primaryKey ="pk_estadocompra";
    public $estadoCompra = 'estadoCompra';
}
