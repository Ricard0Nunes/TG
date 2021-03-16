<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresas_licenciamento extends Model
{
    
        protected $connection = 'licenciamento';
        protected $table = 'empresas_licenciamento';
        protected $primaryKey ="pk_empresa";
        public $empresas_licenciamento = 'empresas_licenciamento';
    
}
