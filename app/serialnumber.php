<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class serialnumber extends Model
{
        
    protected $connection = 'licenciamento';
    protected $table = 'serial';
    protected $primaryKey ="pk_serial";
    public $serial = 'serial';
}
