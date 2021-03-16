<?php

namespace App\Http\Controllers;

use App\Medicina;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class MedicinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicina = medicina::get();
        return view('mostrar/medicina', compact('medicina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('visivel',1)->orderBy('name','ASC')->pluck('name', 'id');
        return view('criar/medicina',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicina = new medicina;
        $medicina->tipoExame = $request->tipoExame;
        $medicina->dataExame = $request->dataExame;
        $medicina->resultado = $request->resultado;
        $medicina->proxExame = $request->proxExame;
        $medicina->bi = user::where('id',$request->fk_tecnico)->value('bi');
        $medicina->save();
        return Redirect::to('/medicina');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicina = medicina::find($id);
        return view('ver/medicina', compact('medicina'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicina $medicina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicina $medicina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicina $medicina)
    {
        //
    }
}
