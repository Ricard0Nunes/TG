<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mensagens extends Model
{
    protected $table = 'mensagens';
    protected $primaryKey ="pk_mensagem";
    public $mensagens = 'mensagens';
    
}
