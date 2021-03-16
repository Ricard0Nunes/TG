<?php

namespace App\Http\Controllers;

use App\tipoContactos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class tipoContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoContacto = tipoContactos::get();
        return view('mostrar/tipo_contacto', compact('tipoContacto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/tipo_contacto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
    $tipoContacto = new tipoContactos;
    $tipoContacto->tipoContacto = $request->tipoContacto;

    $tipoContacto->save();


    return Redirect::to('/tipocontacto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoContactos  $tipoContactos
     * @return \Illuminate\Http\Response
     */
    public function show(tipoContactos $tipoContactos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoContactos  $tipoContactos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tipoContacto = tipoContactos::find($request->id);
        return view('editar/tipo_contacto', compact('tipoContacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoContactos  $tipoContactos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tipoContacto = tipoContactos::find($request->id);
        $tipoContacto->tipoContacto = $request->tipoContacto;
    
        $tipoContacto->save();
    
    
        return Redirect::to('/tipocontacto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoContactos  $tipoContactos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tipoContactos $tipoContactos)
    {
        //
    }
}
