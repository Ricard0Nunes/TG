<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urgencia extends Model
{
    protected $table = 'urgencias';
    protected $primaryKey ="pk_urgencia";
    public $urgencia = 'urgencia';
}
