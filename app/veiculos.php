<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class veiculos extends Model
{ protected $connection = 'geraltg';
    protected $table = 'veiculos';
    protected $primaryKey ="pk_veiculo";
    public $veiculo = 'veiculo';
}
