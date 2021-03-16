<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresasComuns extends Model

    {
        protected $connection = 'geraltg';
        protected $table = 'empresascomuns';
        protected $primaryKey ="pk_empresa";
        public $empresascomum = 'empresascomum';
    }

