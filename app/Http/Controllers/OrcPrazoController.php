<?php

namespace App\Http\Controllers;

use App\orc_Prazo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Redirect;

class OrcPrazoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prazo=orc_prazo::get();
        return view('mostrar/orc_prazo', compact('prazo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/orc_prazo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $versejaexiste=orc_prazo::where('dias',$request->dias)->get();
    if (count($versejaexiste)>0) {
        return Redirect::back()->with('warning', 'Prazo já existente.')->withInput($request->all()) ;

    }
    $prazo= new orc_prazo;
    $prazo->prazo= $request->prazo;
    $prazo->dias= $request->dias;
    $prazo->save();
    return Redirect::to('/prazosorcamento')->with('success', 'Prazo Criado!')->withInput();    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orc_Prazo  $orc_Prazo
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orc_Prazo  $orc_Prazo
     * @return \Illuminate\Http\Response
     */
    public function edit(orc_Prazo $orc_Prazo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orc_Prazo  $orc_Prazo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orc_Prazo $orc_Prazo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orc_Prazo  $orc_Prazo
     * @return \Illuminate\Http\Response
     */
    public function destroy(orc_Prazo $orc_Prazo)
    {
        //
    }
}
