<?php

namespace App\Http\Controllers;

use App\equipamentos;
use App\Manutencao;
use App\RequisicaoEquipamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\empresasComuns;

class EquipamentosController extends Controller
{
    public function index()
    {
        $equipamento = equipamentos::get();
        return view('mostrar/equipamento', compact('equipamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
         $empresas=empresascomuns::pluck('nomeAbreviado','NIF');

        return view('criar/equipamento',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
    $equipamento = new equipamentos;
    $equipamento->marca = $request->marca;
    $equipamento->modelo = $request->modelo;
    $equipamento->codigo = $request->codigo;
    $equipamento->dataAquisicao = $request->dataAquisicao;
    $equipamento->nifEmpresa = $request->empresa;
    $equipamento->fornecedor = $request->fornecedor;
    $equipamento->SI = $request->si;
    $equipamento->numeroSerie = $request->nSerie;
    $equipamento->fatura = $request->fatura;
    $equipamento->observacoes = $request->observacoes;
    $equipamento->requisitado =0;
    $equipamento->status = $request->status;
  
    $equipamento->save();


    \Session::flash('success', 'O equipamento '. $request->codigo .' foi criada com sucesso');

    // escrever log 
    return Redirect::to('/equipamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\equipamentos  $equipamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $equip=  equipamentos::find($request->id);
        $equipamento = equipamentos::where('pk_equipamento',$request->id)-> leftjoin('empresascomuns', 'nifEmpresa', 'NIF')->get(); 
        $manutencao = Manutencao::where('fk_equipamento',$request->id)->get();#leftjoin('userscomuns','requisitadoPor','BI')->get();
         $requisicaoequipamento= requisicaoequipamento::where('peri', 'like', "%".$equip->codigo."%")->orWhere('cpu', 'like', "%".$equip->codigo."%")->leftjoin('userscomuns','requisitadoPor','BI')->get();


//    manutencao
        return view('ver/equipamento', compact('equipamento', 'manutencao','requisicaoequipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\equipamentos  $equipamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
        $equipamento = equipamentos::find($request->id);
        $empresas=empresascomuns::pluck('nomeAbreviado','NIF');

        return view('editar/equipamento', compact('equipamento','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\equipamentos  $equipamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    return $request;
        $equipamento = equipamentos::find($request->id);
        $equipamento->nome = $request->nome;
        $equipamento->descricao = $request->descricao;
        $equipamento->dataAquisicao = $request->dataAquisicao;
        
        $equipamento->save();
        return Redirect::to('/verequipamento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\equipamentos  $equipamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipamentos $equipamentos)
    {
        //
    }
}
