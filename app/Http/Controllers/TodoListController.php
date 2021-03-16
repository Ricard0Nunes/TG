<?php

namespace App\Http\Controllers;

use App\todoList;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator =  Validator::make($request->all(), [

            'label' => 'required',
            'descricao' => 'required',
           
            ]);
            if($validator->fails()){
                return  Redirect::back()->with('warning', 'Nota não criado')->withInput()->withErrors($validator);
            }

            $todolist = new todolist();
            $todolist->label = $request->label;
            $todolist->descricao = $request->descricao;
            $todolist->fk_user = Auth::id();
         $todolist->save();
         return Redirect::back()->with('success', 'Nota Criada')->withInput();
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(todoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(todoList $todoList)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function feitotodo(Request $request)
    {
     $todolist= todolist::find($request->id);
     $todolist->feito=1;
        $todolist->save();
        return Redirect::back()->with('Success', 'Nota Atualizada')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function apagartodo(Request $request)
    {$task = todolist::find($request->id);
        $task->delete();
        
        return Redirect::back()->with('Success', 'Nota Apagada')->withInput();
        //
    }
}
