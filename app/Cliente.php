<?php

namespace App;
use App\PotencialCliente;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey ="pk_cliente";
    public $cliente = 'cliente';
    protected $table = 'clientes';

    public function potencialCliente()
{
    return $this->hasOne(potencialCliente::class, 'foreign_key');
}
}
