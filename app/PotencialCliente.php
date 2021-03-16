<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class PotencialCliente extends Model
{
    protected $primaryKey ="pk_potencialCliente";
    public $potencialCliente = 'potencialCliente';
    protected $table = 'potencialclientes';

public function user()
{
    return $this->hasOne(user::class, 'foreign_key');
}
}