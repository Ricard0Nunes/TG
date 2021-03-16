<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $primaryKey ="pk_orcamento";
    public $orcamento = 'orcamento';
    protected $table = 'orcamentos';
}
