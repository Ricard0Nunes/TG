<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $table = 'inventarios';
    protected $primaryKey ="pk_inventario";
    public $inventario = 'inventario';
}
