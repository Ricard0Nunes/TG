<?php

namespace App;
use App\Empresa;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $primaryKey ="pk_departamento";
    public $departamento = 'departamento';
    protected $table = 'departamentos';

    public function user()
{
    return $this->hasOne(user::class, 'foreign_key');
}   
 public function empresa()
{
    return $this->hasOne(empresa::class, 'foreign_key');
}

}
