<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $primaryKey ="pk_log";
    public $log = 'log';
    protected $table = 'logs';
}
