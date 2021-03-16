<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use Validator;
use Illuminate\Support\Facades\Redirect;

class cargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargo = cargo::get();
        return view('mostrar/cargo', compact('cargo'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/cargos');
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
            'descricao' => 'required',
            
        ]);
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/novocargo')->withInput()->withErrors($validator);
        }
        $cargo = new cargo;
        $cargo->descricao = $request['descricao'];
 
        $cargo->visivel = $request['visivel'];
       
        $cargo->save();
 
        \Session::flash('success', 'O cargo  '. $request->descricao .' foi criado com sucesso');

        // escrever log 
        return Redirect::to('/cargos');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = cargo::find($id);
        return view('editar/cargo', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [

            'descricao' => 'required',
            'visivel' => 'required',
            // 'permissoes' => 'required',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/editarcargo/'.$id)->withInput()->withErrors($validator);
            }
            $cargo = cargo::find($id);
            $cargo->descricao = $request['descricao'];
            // $cargo->permissoes = $request['permissoes'];
            $cargo->visivel = $request['visivel'];
            
            $cargo->save();
      
     
            \Session::flash('success', 'O Cargo '. $request->descricao .' foi editado com sucesso');
    
            // escrever log 
            return Redirect::to('/cargos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
