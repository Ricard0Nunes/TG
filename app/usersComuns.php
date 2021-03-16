<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usersComuns extends Model
{
    protected $connection = 'geraltg';
        protected $table = 'userscomuns';
        protected $primaryKey ="pk_user";
        public $userscomuns = 'userscomuns';
}
