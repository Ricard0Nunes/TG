<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipamentos extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'equipamentos';
    protected $primaryKey ="pk_equipamento";
    public $equipamento = 'equipamento';
}
