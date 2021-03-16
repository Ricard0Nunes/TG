<?php

namespace App\Http\Controllers;
use App\Task;
use App\Link;
 
class GanttController extends Controller
{
    public function get(){
        $tasks = new Task();
        $links = new Link();
 
        return response()->json([
            "data" => $tasks->where('fk_projeto', 1)->get(),
            "links" => $links->all()
        ]);
    }
}