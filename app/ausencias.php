<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ausencias extends Model
{
    protected $connection = 'geraltg';
    protected $table = 'ausencias';
    protected $primaryKey ="pk_ausencia";
    public $ausencias = 'ausencias';
}
