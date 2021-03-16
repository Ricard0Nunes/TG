<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class familiaArtigos extends Model
{
    protected $table = 'familia_artigos';
    protected $primaryKey ="pk_familiaartigos";
    public $familiaartigo = 'familiaartigo';
}
