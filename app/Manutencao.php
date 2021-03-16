<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    protected $connection = 'geraltg';
    protected $primaryKey ="pk_manutencao";
    public $manutencao = 'manutencao';
    protected $table = 'manutencaos';
}
