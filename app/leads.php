<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leads extends Model
{
    protected $table = 'leads';
    protected $primaryKey ="pk_lead";
    public $lead = 'lead';
}
