<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjDep extends Model
{
    protected $table = 'projdeps';
    protected $primaryKey ="pk_projDep";
    public $projdep = 'projdep';

}
