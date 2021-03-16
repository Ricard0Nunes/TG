<?php

namespace App\Http\Controllers;

use App\RequisicaoSala;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use DB;
use App\Salas;
use App\usersComuns;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;



class RequisicaoSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requisicoessala()
    {
        $requisicaosala = RequisicaoSala::get();
        $user = user::where('id','>',1)->pluck('name','id');
        $sala = Salas::pluck('nome','pk_sala');
        return view('mostrar/requisicaosala', compact('requisicaosala','user','sala'));
    }

    public function createRequisicaoSala()
    {
        // $user = user::where('id','>',1)->pluck('name','id');
        $user = userscomuns::where('visivel',1)->orderby('nome')->pluck('nome','BI');
        $sala = salas::pluck('nome','pk_sala');
        return view('criar/requisicaosala', compact('user','sala'));
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
    public function storeRequisicaoSala(Request $request)
    {

        $inicio=Carbon::parse($request->horaInicio)->diffInSeconds(Carbon::parse('00:00:00'));
        $fim=Carbon::parse($request->horaFim)->diffInSeconds(Carbon::parse('00:00:00'));
        if($inicio>$fim){
          return Redirect::back()->with('warning', 'Hora de início tem de ser superior à hora de fim.')->withInput();
        }

        // $req=RequisicaoSala::where('fk_sala',$request->fk_sala)->where('data', $request->data)->get();
        // if(count($req)>0){

        //      $fim=carbon::parse($req[0]->horaFim)->diffInSeconds(Carbon::parse('00:00:00')); 
        //      $inicio=carbon::parse($request->horaInicio)->diffInSeconds(Carbon::parse('00:00:00'));

        //      $iniciooutro=carbon::parse($req[0]->horaInicio)->diffInSeconds(Carbon::parse('00:00:00')); 
        //      $fimoutro=carbon::parse($request->horaFim)->diffInSeconds(Carbon::parse('00:00:00'));

 
        //      if ($fim> ($inicio)) {

        //         if($fimoutro<= ($iniciooutro)){

        //              return "siga";

        //         }else{

        //             return "hora de fim da nova reuniao superior ao inicio da velha";
        //         }

        //         return "hora de inicio da nova inferior a velha";

        //     }
        //     return "siga gazada";

        // }

        
         $req=RequisicaoSala::where('fk_sala',$request->fk_sala)->where('data', $request->data)->get();
        if(count($req)>0){

            
            $chegadaRequisicaoA=carbon::parse($req[0]->horaFim)->diffInSeconds(Carbon::parse('00:00:00')); 
            $partidaRequisicaoN=carbon::parse($request->horaInicio)->diffInSeconds(Carbon::parse('00:00:00'));

            $chegadaRequisicaoAA=carbon::parse($req[0]->horaInicio)->diffInSeconds(Carbon::parse('00:00:00')); 
            $partidaRequisicaoNN=carbon::parse($request->horaFim)->diffInSeconds(Carbon::parse('00:00:00'));


                    if ($chegadaRequisicaoA>= ($partidaRequisicaoN)) {

                        if($chegadaRequisicaoAA<= ($partidaRequisicaoNN)){

             return Redirect::back()->with('warning', 'Existe uma requisição para a data:  '. $request->data. ' | Hora: '. $req[0]->horaInicio.' - '. $req[0]->horaFim. ' | Requisitante: '. userscomuns::where('BI',$req[0]->requisitadoPor)->value('nome'))->withInput();

                            // return Redirect::back()->with('warning', 'Existe uma requisição para a data: '. $request->data)->withInput();
                }
                    
                  
                    }

        }
      

    //      if($req=RequisicaoSala::where('fk_sala',$request->fk_sala)->where('data', $request->data)->exists()){

    //          return Redirect::back()->with('warning', 'Existe uma requisição para a data: '. $request->data)->withInput();
                    
    // }


   
    
        // $userscomuns=userscomuns::where('BI',$request->requisitadoPor)->get();
        $requisicaosala = new RequisicaoSala;
       
        $requisicaosala->observacoes = $request->observacoes;
        $requisicaosala->data = $request->data;

        $requisicaosala->horaInicio = $request->horaInicio;
        $requisicaosala->horaFim = $request->horaFim;
        $requisicaosala->requisitadoPor = $request->requisitadoPor;
        $requisicaosala->fk_sala = $request->fk_sala;
        $requisicaosala->save();

       

        \Session::flash('success', 'A '. DB::connection('geraltg')->table('salas')->where('pk_sala',$requisicaosala->fk_sala)->value('nome') .' foi requisitada com sucesso');
        return Redirect::to('/requisicoessala')->withInput();
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequisicaoSala  $requisicaoSala
     * @return \Illuminate\Http\Response
     */
    public function show(RequisicaoSala $requisicaoSala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequisicaoSala  $requisicaoSala
     * @return \Illuminate\Http\Response
     */
    public function edit(RequisicaoSala $requisicaoSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequisicaoSala  $requisicaoSala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequisicaoSala $requisicaoSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequisicaoSala  $requisicaoSala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $requisicaosala = RequisicaoSala::find($request->id);

        
        $requisicaosala->delete();

        \Session::flash('danger', 'A Requisicao da '. DB::connection('geraltg')->table('salas')->where('pk_sala',$requisicaosala->fk_sala)->value('nome') .' para o dia '.$requisicaosala->data.' no horário '.$requisicaosala->horaInicio.' - '.$requisicaosala->horaFim.' foi eliminada!');


        return Redirect::to('/requisicoessala');

        
       
    }
}
