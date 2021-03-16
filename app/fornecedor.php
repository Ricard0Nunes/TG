<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $primaryKey ="pk_fornecedor";
    public $fornecedor = 'fornecedor';
}
