<?php

namespace App\Http\Controllers;

use App\orc_Tipo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class OrcTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo=orc_tipo::get();
        return view('mostrar/orc_tipo', compact('tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/orc_tipo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $versejaexiste=orc_tipo::where('tipoOrcamento',$request->tipo)->get();
    if (count($versejaexiste)>0) {
        return Redirect::back()->with('warning', 'Tipo já existente.')->withInput($request->all()) ;

    }
    $tipo= new orc_tipo;
    $tipo->tipoOrcamento= $request->tipo;
    $tipo->abreviatura= strtoupper($request->abreviatura);
    $tipo->save();
    return Redirect::to('/tiposorcamento')->with('success', 'Tipo Criado!')->withInput();   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orc_Tipo  $orcTipo
     * @return \Illuminate\Http\Response
     */
    public function show(orcTipo $orcTipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orc_Tipo  $orcTipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tipo = orc_tipo::find($request->id);
       return view('editar/orc_tipo', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orcTipo  $orcTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tipo = orc_tipo::find($request->id);
        $tipo->tipoOrcamento= $request->tipo;
        $tipo->abreviatura= $request->abreviatura;
       
        $tipo->save();
        return Redirect::to('/tiposorcamento')->with('success', 'Tipo Editado!')->withInput();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orcTipo  $orcTipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(orcTipo $orcTipo)
    {
        //
    }
}
