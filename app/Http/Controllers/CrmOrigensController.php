<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\crm_origens;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class CrmOrigensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $crm_origem = crm_origens::get();
        return view('mostrar/crm_origem', compact('crm_origem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $crm_origem = crm_origens::find($request->pk_origem);
        return view('criar/crm_origem', compact('crm_origem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $crm_origem = new crm_origens;

        $crm_origem->descricao = $request['descricao'];
        $crm_origem->save();
        return Redirect::to('/origem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\crm_origens  $crm_origens
     * @return \Illuminate\Http\Response
     */
    public function show(crm_origens $crm_origens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\crm_origens  $crm_origens
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, crm_origens $crm_origens)
    {
        $crm_origem = crm_origens::find($request->id);
    
      
        return view('editar/crm_origens', compact('crm_origem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crm_origens  $crm_origens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     
        $crm_origem = crm_origens::find($request->pk_origem);
        $crm_origem->descricao = $request['descricao'];

        // $crm_origem = crm_origens::find($request->id);
        
        // $crm_origem->avaliacao_user = $request->avaliacao_user;

        $crm_origem->save();
        return Redirect::to('/origem');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crm_origens  $crm_origens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,crm_origens $crm_origens)
    {
        
      $crm_origem = crm_origens::find($request->id);

      
        
    

            $crm_origem->delete();
            \Session::flash('danger', 'Origem eliminada!!');

            return Redirect::to('/origem');
    }
}
