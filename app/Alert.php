<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $table = 'alerts';
    protected $primaryKey ="pk_alerta";
    public $alert = 'alert';
}
