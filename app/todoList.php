<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todoList extends Model
{
    protected $table = 'todo_lists';
    protected $primaryKey ="pk_todoList";
    public $todolist = 'todolist';
}
