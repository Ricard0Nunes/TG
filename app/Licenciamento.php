<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenciamento extends Model
{
    protected $connection = 'licenciamento';
    protected $primaryKey ="pk_licenciamento";
    public $licenciamento = 'licenciamento';
    protected $table = 'licenciamento';
}
