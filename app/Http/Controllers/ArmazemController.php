<?php

namespace App\Http\Controllers;

use App\armazem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ArmazemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $armazem= armazem::get();
        return view('mostrar/armazem', compact('armazem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/armazem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $armazem= new Armazem;
        $armazem->nome=$request->nome;
        $armazem->localizacao=$request->localizacao;
        $armazem->save();
        \Session::flash('success', 'O Armazem '. $armazem->nome.' foi criado com sucesso');
    
        // escrever log 
        return Redirect::to('/armazens');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\armazem  $armazem
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $armazem= armazem::find($request->id);
       return view('editar/armazem', compact('armazem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $armazem= armazem::find($request->id);
        $armazem->nome=$request->nome;
        $armazem->localizacao=$request->localizacao;
        $armazem->save();
        \Session::flash('success', 'O Armazem '. $armazem->nome.' foi editado com sucesso');
    
        // escrever log 
        return Redirect::to('/armazens');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\armazem  $armazem
     * @return \Illuminate\Http\Response
     */
    public function destroy(armazem $armazem)
    {
        //
    }
}
