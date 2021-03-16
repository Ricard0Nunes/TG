<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicina extends Model
{
    protected $connection = 'geraltg';
    protected $primaryKey ="pk_medicina";
    public $medicina = 'medicina';
    protected $table = 'medicinas';
}
