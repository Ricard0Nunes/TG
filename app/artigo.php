<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artigo extends Model
{
    protected $table = 'artigos';
    protected $primaryKey ="pk_artigo";
    public $artigo = 'artigo';
}
