<?php

namespace App\Http\Controllers;

use App\Urgencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Support\Facades\Redirect;
class UrgenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urgencia = urgencia::get();
        return view('mostrar/urgencias', compact('urgencia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/urgencia');
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

            'pesoUrgencia' => 'required',
            'descricaoUrgencia' => 'required',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/novaurgencia')->withInput()->withErrors($validator);
            }
            $urgencia = new urgencia;
            $urgencia->pesoUrgencia = $request['pesoUrgencia'];
            $urgencia->descricaoUrgencia = $request['descricaoUrgencia'];
            $urgencia->save();
      
     
            \Session::flash('success', 'A Urgência '. $request->descricaoUrgencia .' foi criada com sucesso');
    
            // escrever log 
            return Redirect::to('/projetourgencia');
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Urgencia  $urgencia
     * @return \Illuminate\Http\Response
     */
    public function show(Urgencia $urgencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Urgencia  $urgencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $urgencia = urgencia::find($id);
        return view('editar/urgencia', compact('urgencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Urgencia  $urgencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 

        $validator =  Validator::make($request->all(), [

            'pesoUrgencia' => 'required',
            'descricaoUrgencia' => 'required',
            'visivel' => 'required',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/editarurgencia/'.$id)->withInput()->withErrors($validator);
            }
            $urgencia = urgencia::find($id);
            $urgencia->pesoUrgencia = $request['pesoUrgencia'];
            $urgencia->descricaoUrgencia = $request['descricaoUrgencia'];
            $urgencia->visivel = $request['visivel'];
            
            $urgencia->save();
      
     
            \Session::flash('success', 'A Urgência '. $request->descricaoUrgencia .' foi editada com sucesso');
    
            // escrever log 
            return Redirect::to('/projetourgencia');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Urgencia  $urgencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Urgencia $urgencia)
    {
        //
    }
}
