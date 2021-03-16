<?php

namespace App\Http\Controllers;

use App\familiaArtigos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class FamiliaArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familiaartigo= familiaArtigos::get();
        return view('mostrar/familiaartigo', compact('familiaartigo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/familiaartigo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $familiaartigos= new familiaArtigos;
        $familiaartigos->descricao=$request->descricao;
        $familiaartigos->save();
        \Session::flash('success',  $familiaartigos->descricao.' foi criado com sucesso');
    
        // escrever log 
        return Redirect::to('/familiaartigo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\familiaArtigos  $familiaArtigos
     * @return \Illuminate\Http\Response
     */
    public function show(familiaArtigos $familiaArtigos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\familiaArtigos  $familiaArtigos
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $familiaartigo= familiaArtigos::find($request->id);
       return view('editar/familiaartigo', compact('familiaartigo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\familiaArtigos  $familiaArtigos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $familiaartigos= familiaArtigos::find($request->id);
        $familiaartigos->descricao=$request->descricao;
        $familiaartigos->save();
        \Session::flash('success',  $familiaartigos->descricao.' foi editado com sucesso');
    
        // escrever log 
        return Redirect::to('/familiaartigo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\familiaArtigos  $familiaArtigos
     * @return \Illuminate\Http\Response
     */
    public function destroy(familiaArtigos $familiaArtigos)
    {
        //
    }
}
