<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requisicaocarro extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'requisicoescarro';
    protected $primaryKey ="pk_requisicao";
    public $requisicaocarro = 'requisicaocarro';
}
