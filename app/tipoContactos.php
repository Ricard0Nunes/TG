<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoContactos extends Model
{
    protected $table = 'tipo_contactos';
    protected $primaryKey ="pk_tipo_contacto";
    public $tipocontacto = 'tipocontacto';
}
