<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscricao extends Model
{
    protected $primaryKey ="pk_inscricao";
    public $inscricao = 'inscricao';
    protected $table = 'inscricaos';
}
