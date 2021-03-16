<?php

namespace App\Http\Controllers;

use App\crm_tipo_campanhas;
use App\crm_campanhas;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\carbon;

class CrmCampanhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        
        $tipo_campanha = crm_tipo_campanhas::get();
        $campanha = crm_campanhas::get();

        return view('mostrar/campanha', compact('campanha', 'tipo_campanha','users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        $tipo_campanha = crm_tipo_campanhas::pluck('tipoCampanha','pk_tipo_campanha');
        return view('criar/campanha', compact('users','tipo_campanha'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $first = carbon::parse($request->dataInicio);
        $second = carbon::parse($request->dataFim);
        if ($first->greaterThan($second))
        {
            return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
                ->withInput();

        }

        $campanha = new crm_campanhas;
        $campanha->fk_tipo_campanha = $request['fk_tipo_campanha'];
        $campanha->fk_responsavel = $request['fk_responsavel'];
        $campanha->dataInicio = $request['dataInicio'];
        $campanha->dataFim = $request['dataFim'];
        $campanha->observacoes = $request['observacoes'];
        $campanha->eficacia = $request['eficacia'];
   
        $campanha->save();
 
        \Session::flash('success', 'A campanha foi criada com sucesso');

        // escrever log 
        return Redirect::to('/campanha');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\crm_campanhas  $crm_campanhas
     * @return \Illuminate\Http\Response
     */
    public function show(crm_campanhas $crm_campanhas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\crm_campanhas  $crm_campanhas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $campanha = crm_campanhas::find($request->id);
        $users = user::where('visivel', 1)->pluck('name', 'id');
        $tipo_campanha = crm_tipo_campanhas::pluck('tipoCampanha','pk_tipo_campanha');


        return view('editar/campanha', compact('campanha','users','tipo_campanha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crm_campanhas  $crm_campanhas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $campanha = crm_campanhas::find($request->id);
        // return $request; 
      
        $campanha->fk_tipo_campanha = $request['fk_tipo_campanha'];
        $campanha->fk_responsavel = $request['fk_responsavel'];
        $campanha->dataInicio = $request['dataInicio'];
        $campanha->dataFim = $request['dataFim'];
        $campanha->observacoes = $request['observacoes'];
        $campanha->eficacia = $request['eficacia'];
   
        $campanha->save();
        return Redirect::to('/campanha'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crm_campanhas  $crm_campanhas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $campanha = crm_campanhas::find($request->id);
        $campanha-> delete(); 
        \Session::flash('success', 'A campanha foi apagada com sucesso');

        // escrever log 
        return Redirect::to('/campanha');

    }
}
