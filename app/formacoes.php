<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formacoes extends Model
{
    protected $primaryKey ="pk_formacao";
    public $formacao = 'formacao';
    protected $table = 'formacoes';
}
