<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paragem extends Model
{protected $connection = 'geraltg';
    protected $table = 'paragens_empresa';
    protected $primaryKey ="pk_paragem";
    public $paragem = 'paragem';
}
