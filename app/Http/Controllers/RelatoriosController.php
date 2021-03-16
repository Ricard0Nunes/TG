<?php

namespace App\Http\Controllers;

use App\relatorios;
use App\Alert;
use App\Departamento;
use App\Cargo;
use App\user;
use App\Ponto;
use App\Ausencias;
use Carbon\Carbon;
use App\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event; 
use App\Projeto;
use App\Cliente;
use App\usersComuns;

class RelatoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->dia==null){
            $dia= carbon::now()->format('Y-m-d');
        }else {
            $dia= $request->dia;
        }
        $presenca='';
     $haponto=userscomuns::join('registopontos','bi','ccuser')->join('tipopicagens', 'fk_tipo', 'pk_tipopicagem')->where('data',  $dia)->get();
     $users = user::where('id','>',1)->where('visivel',1)->get();

        
     
        $noticias=alert::where('de','<=',$dia)->where('a','>=',$dia)->get();
        $agenda= event::where('start_date','like',$dia. '%' )->get();
        $ausencias= ausencias::where('estado',1)->leftjoin('justificacoes','pk_justificacao','fk_justificacao')->Where(function ($query) use ($dia) {
            $query->whereDate('start', '<=', $dia.'%')
                ->whereDate('end','>=', $dia.'%');
        })->orderBy('start')->get();
        $projetosaterminar= projeto::where('fk_estadoproj','<',4)->leftjoin('users','id','fk_responsavel')->orderBy('dataPrevistaFim')->take(5)->get();
        $etapasaterminar= task::where('tipo',1)->leftjoin('users','users.id','fk_tecnico')->orderBy('horaFimPrev','asc')->take(5)->get();
        $clientesultimos=cliente::orderBy('created_at','desc')->take(5)->get();
        $projetos= projeto::whereIn('fk_estadoproj',array(1,3))->leftjoin('users','id','fk_responsavel')->get();

        
        $tasksdia= task::where('tipo',2)->where('start_date','like',$dia.'%' )->get();
        $tasksdiaconcluidas= task::where('tipo',2)->where('start_date','like',$dia.'%' )->where('fechado',0)->where('fk_estadoIntervencao',3)->get();
        $ponto= ponto::where('data',  $dia)->get();   
     return view(' ver/dashboard', compact('users','tasksdia','tasksdiaconcluidas','ponto','dia','agenda','ausencias','noticias','projetosaterminar','etapasaterminar','clientesultimos','projetos','haponto'));  
    }


    public function show(Request $request)
    {
  
        $users = user::find($request->fk_tecnico);
        
        $departamento=departamento::find($users->fk_departamento);
        $cargo=cargo::find($users->fk_cargo);
        $tasksdia= task::where('tipo',2)->where('start_date','like',$request->dia.'%' )->where('fk_tecnico',$request->fk_tecnico)->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('estadointervencoes','pk_estadoIntervencoes','fk_estadoIntervencao')->orderBy('start_date')->get();
        $dia=$request->dia;
        $i=1;
        $j=1;
         $ontem=carbon::parse($dia)->subDay($i);
      while ($ontem->isWeekend()) {
        $ontem=carbon::parse($dia)->subDay($i);
        $i++;
      }
      $amanha=carbon::parse($dia)->addDay($j);
      while ($amanha->isWeekend()) {
        $amanha=carbon::parse($dia)->addDay($j);
        $j++;
      }
        
      $ontem=carbon::parse($ontem)->format('Y-m-d');
      $amanha=carbon::parse($amanha)->format('Y-m-d');
     
     $tasksontem= task::where('tipo',2)->where('start_date','like',$ontem.'%' )->where('fk_tecnico',$request->fk_tecnico)->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('estadointervencoes','pk_estadoIntervencoes','fk_estadoIntervencao')->orderBy('start_date')->get();
     $tasksamanha= task::where('tipo',2)->where('start_date','like',$amanha.'%' )->where('fk_tecnico',$request->fk_tecnico)->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('estadointervencoes','pk_estadoIntervencoes','fk_estadoIntervencao')->orderBy('start_date')->get();


        $ponto= ponto::where('data',  $request->dia)->where('ccuser',$users->bi)->get(); 
        $pontoamanha= ponto::where('data',  $amanha)->where('ccuser',$users->bi)->get(); 
        $pontoontem= ponto::where('data',  $ontem)->where('ccuser',$users->bi)->get(); 
        $paginarusers= user::where('id','>',1)->where('visivel',1)->orderBy('sigla')->get();
        return view(' ver/relatoriodiario', compact('users','tasksdia','dia','ponto','ontem','amanha','tasksontem','tasksamanha','cargo','departamento','paginarusers','pontoontem','pontoamanha'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\relatorios  $relatorios
     * @return \Illuminate\Http\Response
     */
    public function edit(relatorios $relatorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\relatorios  $relatorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, relatorios $relatorios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\relatorios  $relatorios
     * @return \Illuminate\Http\Response
     */
    public function destroy(relatorios $relatorios)
    {
        //
    }
}
