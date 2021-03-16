<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacoes extends Model
{
    protected $primaryKey ="pk_notificacao";
    public $notificacoes = 'notificacoes';
    protected $table = 'notificacoes';
}
