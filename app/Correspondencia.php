<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correspondencia extends Model
{
    protected $primaryKey ="pk_correspondencia";
    public $correspondencia = 'correspondencia';
    protected $table = 'correspondencias';
}
