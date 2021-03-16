<?php

namespace App\Http\Controllers;

use App\Manutencao;
use App\equipamentos;
use App\empresasComuns;
Use App\User;
Use auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
class ManutencaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manutencao = Manutencao::get();
        return view('mostrar/manutencaoequipamento', compact('manutencao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $equipamento=equipamentos::find($request->id);
            $tipoEqu=0;#variavel para habilitar se é equipamento ou veiculo
            
           $tipo= DB::connection('geraltg')->table('tipo_manutencao')->pluck('descricao','pk_tipo');

            $tecnico=user::where('id',auth::id())->get();
            return view('criar/manutencaoequipamento',compact('equipamento','tecnico','tipoEqu','tipo'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

            $manutencao = new Manutencao;
            $manutencao->dataInicio = $request->dataInicio;
            $manutencao->dataFim = $request->dataFim;
            $manutencao->descricaoProblema = $request->descricaoProblema;
            $manutencao->resolucaoProblema = $request->resolucaoProblema;
            $manutencao->observacoes = $request->observacoes;
            $manutencao->proximaVerificacao = $request->proximaVerificacao;
            $manutencao->tecnico = $request->tecnico;
            if ($request->dataFim=="") {
                $manutencao->concluido = 0;
            }else {
                $manutencao->concluido = 1;
            }
           
            
          
            $manutencao->fk_tipo = $request->fk_tipo;
            $manutencao->fk_equipamento = $request->equipamento;
            $manutencao->fk_veiculo = $request->fk_veiculo;

            $manutencao->save();
        
        
            \Session::flash('success', 'A manutençãos '. $request->descricaoProblema .' foi criada com sucesso');
        
            // escrever log 
            return Redirect::to('/equipamentos');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function show(Manutencao $manutencao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function edit(Manutencao $manutencao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manutencao $manutencao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manutencao  $manutencao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manutencao $manutencao)
    {
        //
    }
}
