<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nivelAcesso extends Model
{
    protected $table = 'nivel_acessos';
    protected $primaryKey ="pk_nivelAcesso";
    public $nivelAcesso = 'nivelAcesso';
}
