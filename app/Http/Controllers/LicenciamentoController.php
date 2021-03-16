<?php

namespace App\Http\Controllers;

use App\Licenciamento;
use App\Empresa;
use App\empresas_licenciamento;
use App\serialnumber;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenciamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    
      $empresa=empresa::find(1);
      $empresalicenciamento=empresas_licenciamento::where('NIF',$empresa->NIF)->get();
        if (count($empresalicenciamento)<1) {
        $empresalicenciamento=new empresas_licenciamento;
        $empresalicenciamento->NIF=$empresa->NIF;
        $empresalicenciamento->nomeCompleto=$empresa->nomeCompleto;
        $empresalicenciamento->nomeAbreviado=$empresa->nomeAbreviado;
        $empresalicenciamento->email=$empresa->email;
        $empresalicenciamento->morada=$empresa->morada;
        $empresalicenciamento->contacto=$empresa->contacto;
        $empresalicenciamento->save();
        }

        $empresalicenciamento=empresas_licenciamento::where('NIF',$empresa->NIF)->get();
        $licenciamento = licenciamento::leftjoin('serial','pk_serial','fk_sn')->get();

     return view('mostrar/licenciamento', compact('empresalicenciamento','licenciamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function introduzirsn(Request $request)
    {
        $empresalicenciamento=empresas_licenciamento::where('NIF',$request->nif)->get();
        $serial=serialnumber::where('sn',$request->sn)->where('ativo',0)->get();
        if (count($serial)<1) {
            return Redirect::to('/licenciamento')->with('warning', 'Atenção, este número de série não está correto! ')->withInput();
        }
        $licenciamento= new licenciamento;
        $licenciamento->dataLicenca=Carbon::now( )->format('Y-m-d');
        $licenciamento->codigoAtivacao=(rand(99999,999999));
        $licenciamento->nUsers=10;
        $licenciamento->visivel=1;
        $licenciamento->fk_sn=$serial[0]->pk_serial;
        $licenciamento->fk_empresa=$empresalicenciamento[0]->pk_empresa;
        $licenciamento->save();
        $serial[0]->ativo=1;
        $serial[0]->save();
        return Redirect::to('/licenciamento')->with('success', 'Nº de série introduzido com sucesso. ')->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
