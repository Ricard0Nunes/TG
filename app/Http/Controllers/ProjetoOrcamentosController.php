<?php

namespace App\Http\Controllers;

use App\ProjetoOrcamentos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orcamento;
use App\Area;
use App\Urgencia;
use App\User;
use App\Cliente;
use App\Departamento;





class ProjetoOrcamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novoprojetoorcamento(Request $request)
    {
        $orcamento=orcamento::find($request->id);
        $area = area::pluck('projArea', 'pk_area');
        $urgencia = urgencia::pluck('descricaoUrgencia', 'pk_urgencia');
        $responsavel = user::where('id','>',1)->pluck('name', 'id');

        $cliente = cliente::where('pk_cliente',$orcamento->fk_cliente)->value('nomeCompleto');
        $departamento = departamento::get();
        $areas = area::get();
        $dep='';
    //    return $request[]=['fk_cliente'=>$cliente];

        return view('criar/projetoparaorcamento',compact('area','urgencia','responsavel','cliente', 'areas','departamento','orcamento','dep'));
    
    }
      
    public function projetoorcamento(Request $request){
        // store
        return $request;
        $departamento = count(departamento::get());
        for ($i=1; $i <=$departamento ; $i++) { 

            $valorusers=user::where('fk_departamento',$i)->where('visivel',1)->get();
            $vaalor=0;
            for ($v=0; $v <count($valorusers) ; $v++) { 
                $vaalor=$valorusers[$v]->custoHora+$vaalor;
            }
            $custoMedioDep= $vaalor/count($valorusers) ;
            if ($i!="0") {
                $dep[$i]= $request->$i*$custoMedioDep;
            }
        //    
        }

        // $orcamento=orcamento::find($request->id);
        // $area = area::pluck('projArea', 'pk_area');
        // $urgencia = urgencia::pluck('descricaoUrgencia', 'pk_urgencia');
        // $responsavel = user::where('id','>',1)->pluck('name', 'id');

        // // $cliente = cliente::where('pk_cliente',$orcamento->fk_cliente)->value('nomeCompleto');
        // $departamento = departamento::get();
        // $areas = area::get();
        // $dep='';

        // return view('criar/projetoparaorcamento',compact('area','urgencia','responsavel','cliente', 'areas','departamento','orcamento','dep','request'));

        return $dep;
      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\ProjetoOrcamentos  $projetoOrcamentos
     * @return \Illuminate\Http\Response
     */
    public function show(ProjetoOrcamentos $projetoOrcamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjetoOrcamentos  $projetoOrcamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjetoOrcamentos $projetoOrcamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjetoOrcamentos  $projetoOrcamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjetoOrcamentos $projetoOrcamentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjetoOrcamentos  $projetoOrcamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjetoOrcamentos $projetoOrcamentos)
    {
        //
    }
}
