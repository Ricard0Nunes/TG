<?php

namespace App\Http\Controllers;

use App\Iva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;  

class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iva = iva::get();
        return view('mostrar/iva', compact('iva'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/iva');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $iva= new iva;
        $iva->descricao_iva=$request->descricao_iva;
        $iva->valor_iva=$request->valor_iva;
        $iva->save();
        \Session::flash('success',  $iva->descricao_iva.' foi criado com sucesso');
    
        // escrever log 
        return Redirect::to('/ivas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Iva  $iva
     * @return \Illuminate\Http\Response
     */
    public function show(Iva $iva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Iva  $iva
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $iva = iva::find($request->id);
        return view('editar/iva', compact('iva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Iva  $iva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Iva $iva)
    {

        $iva= iva::find($request->id);
        $iva->descricao_iva=$request->descricao_iva;
        $iva->valor_iva=$request->valor_iva;

        $iva->save();
        \Session::flash('success',  $iva->descricao_iva.' foi editado com sucesso');
    
        // escrever log 
        return Redirect::to('/ivas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Iva  $iva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iva $iva)
    {
        //
    }
}
