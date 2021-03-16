<?php

namespace App\Http\Controllers;

use App\salas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class SalasController extends Controller
{
    public function index()
    {
        $sala = salas::get();
        return view('mostrar/sala', compact('sala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('criar/sala');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $sala = new salas;  
        $sala->nome = $request->nome;
        $sala->lotacao = $request->lotacao;
        $sala->local = $request->local; 
        $sala->custo = $request->custo;
 
        if(!is_numeric($sala->custo) ){   
            \Session::flash('warning','Por favor, é necessário introduzir um custo com valores numéricos! ');
            return Redirect::to('/novasala')->withInput(); 

        } 

        if(!is_numeric($sala->lotacao)) {   
            \Session::flash('warning','Por favor, é necessário introduzir uma lotação com valores numéricos! ');
            return Redirect::to('/novasala')->withInput(); 
        } 

        $sala->save();
        \Session::flash('success', 'A sala '. $request->nome.' foi criada com sucesso.');
        return Redirect::to('/salas');  
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       
        $sala = salas::find($id);
        return view('editar/sala', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
         $sala = salas::find($id);   
         
        $sala->nome = $request['nome'];
         $sala->local =  $request['local'];
         $sala->lotacao = $request['lotacao'];
         $sala->custo = $request['custo'];  
         if(!is_numeric($sala->custo) ){   
            \Session::flash('warning','Por favor, é necessário introduzir um custo com valores numéricos! ');
           return Redirect::to('/editarsala/'.$id)->withInput();
        }  
        if(!is_numeric($sala->lotacao)) {   
            \Session::flash('warning','Por favor, é necessário introduzir uma lotação com valores numéricos! ');
            return Redirect::to('/editarsala/'.$id)->withInput();
        }    
        $sala->save(); 
        \Session::flash('success', 'A sala '. $request->nome.' foi editada com sucesso.');
        return Redirect::to('/salas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\salas  $salas
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    { 
        $sala = salas::find($request->id);   
        $sala->delete();
        \Session::flash('success', 'A sala '. $request->nome.' foi apagada com sucesso.');
        return Redirect::to('/salas');
    }
}
