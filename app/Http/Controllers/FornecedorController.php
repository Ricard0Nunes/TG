<?php

namespace App\Http\Controllers;

use App\fornecedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\compra;
use Validator;


class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedor= fornecedor::get();
        return view('mostrar/fornecedor', compact('fornecedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/fornecedor');
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

            'email' => 'required|email',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados corretamente.');
                return Redirect::to('/novofornecedor')->withInput()->withErrors($validator);
            }


        $fornecedor = new fornecedor;
        $fornecedor->NIF = $request['NIF'];
        $fornecedor->nomeCompleto = $request['nomeCompleto'];
        $fornecedor->nomeAbreviado = $request['nomeAbreviado'];
        $fornecedor->morada = $request['morada'];
        $fornecedor->email = $request['email'];
        $fornecedor->contacto = $request['contacto'];
        $fornecedor->avaliacao = $request['avaliacao'];
        $fornecedor->observacoes = $request['observacoes'];
        if($request->hasFile('logo'))
            
        {
 
         $fornecedor->logo= $request->file('logo')->store('fornecedor','public');
        }
        else{
        $fornecedor->logo="cliente/clientedefeito.png";
    }
        $fornecedor ->save();
        \Session::flash('success', 'O Fornecedor '. $fornecedor->nomeCompleto.' foi criado com sucesso');
    
        // escrever log 
        return Redirect::to('/fornecedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $fornecedor= fornecedor::find($request->id);
        $compras= compra::where('fk_fornecedor',$request->id)->leftjoin('users','id','fk_responsavel')->get();
        return view('ver/fornecedor', compact('fornecedor','compras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $fornecedor= fornecedor::find($request->id);
        $contacto[]=null;
     
        return view('editar/fornecedor', compact('fornecedor','contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $fornecedor= fornecedor::find($request->id);
        $fornecedor->NIF = $request['NIF'];
        $fornecedor->nomeCompleto = $request['nomeCompleto'];
        $fornecedor->nomeAbreviado = $request['nomeAbreviado'];
        $fornecedor->morada = $request['morada'];
        $fornecedor->email = $request['email'];
        $fornecedor->contacto = $request['contacto'];
        $fornecedor->observacoes = $request['observacoes'];
        $fornecedor->avaliacao = $request['avaliacao'];
        $fornecedor->visivel = $request['visivel'];
        $fornecedor ->save();
        \Session::flash('success', 'O Fornecedor '. $fornecedor->nomeCompleto.' foi editado com sucesso');
    
        // escrever log 
        return Redirect::to('/fornecedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(fornecedor $fornecedor)
    {
        //
    }
}
