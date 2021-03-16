<?php

namespace App;
use App\lead;

use Illuminate\Database\Eloquent\Model;

class contactoscomclientes extends Model
{
    //
    protected $primaryKey ="pk_contactoscomclientes";
    public $contacto = 'contacto';
    protected $table = 'contactoscomclientes';
    public function lead()
    {
        return $this->hasOne(lead::class, 'foreign_key');
    }
}

