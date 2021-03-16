<?php

namespace App\Http\Controllers;

use App\crm_tipo_campanhas;
use Illuminate\Http\Request;
use Redirect;

class CrmTipoCampanhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $tipo_campanha = crm_tipo_campanhas::get(); 
        return view('mostrar/crm_tipo_campanha', compact('tipo_campanha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('criar/crm_tipo_campanha');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_campanha = new crm_tipo_campanhas; 
        $tipo_campanha->tipoCampanha = $request['tipoCampanha']; 
        $tipo_campanha->save(); 

        \Session::flash('success', 'O tipo de campanha:  ' . $request->tipoCampanha . ' foi criada com sucesso'); 
        return Redirect::to('/tipocampanha');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\crm_tipo_campanhas  $crm_tipo_campanhas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\crm_tipo_campanhas  $crm_tipo_campanhas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
           $tipo_campanha = crm_tipo_campanhas::find($request->id);
        return view('editar/crm_tipo_campanha', compact('tipo_campanha'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crm_tipo_campanhas  $crm_tipo_campanhas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
  
        {
               $tipo_campanha = crm_tipo_campanhas::find($request->id);
               $tipo_campanha->tipoCampanha = $request->tipoCampanha;
               $tipo_campanha->save();
               return Redirect::to('/tipocampanha'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crm_tipo_campanhas  $crm_tipo_campanhas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)   
    {
      
        $tipo_campanha = crm_tipo_campanhas::find($request->id);
        $tipo_campanha->delete();
        \Session::flash('success', 'Tipo de campanha eliminada!!');

        return Redirect::to('/tipocampanha');

    }
}
