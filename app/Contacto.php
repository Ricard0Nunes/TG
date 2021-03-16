<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $primaryKey ="pk_contacto";
    public $contacto = 'contacto';
    protected $table = 'contactoClientes';

}
