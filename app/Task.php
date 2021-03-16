<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $table = 'tasks';
    // protected $primaryKey ="id";
    //  public $tasks= 'task';

    protected $appends = ["open"]; 
    public function getOpenAttribute(){        return true;    }
}
