<?php

namespace App\Http\Controllers;

use App\Correspondencia;
use App\User;
use App\Notificacoes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use auth;
use Illuminate\Support\Facades\Redirect;

class CorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        

        $correspondencia = correspondencia::orderBy('pk_correspondencia','DESC')->get();
     
        return view('mostrar/correspondencia', compact( 'correspondencia'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $users = user::where('id','>',1)-> where('visivel',1)->orderby('name','ASC')->pluck('name','id');
        return view('criar/correspondencia', compact( 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // para o primeiro caso onde não ha nenhuma entradareturn 
        $contador= correspondencia::orderBy('pk_correspondencia','DESC')->value('contador');
      if ($contador==null) {
     $contador=0;
      }
       $anoUltima= correspondencia::orderBy('pk_correspondencia','DESC')->value('ano');
    
      if ($anoUltima[0]==null or intval($anoUltima)!=date('Y')) {
        $contador=0;
         }
     
        $correspondencia= new correspondencia;

        $correspondencia->localRecebimento=$request->local;
        $correspondencia->remetente=$request->remetente;
        if ($request->datarececao!=null) {
            $correspondencia->diaRecebimento=$request->datarececao;
        }else {
            $correspondencia->diaRecebimento=carbon::now()->format('Y-m-d H:i:s');
        }
        $correspondencia->fk_recetor=auth::id();
        
        $correspondencia->comentario=$request->comentario;
        $correspondencia->interna=$request->interno;
        $correspondencia->contador=$contador+1;
        $correspondencia->ano=date('Y');
     
         if ($correspondencia->interna==1) {
            $correspondencia->fk_destinatario=$request->fk_destinatario;
            $notificar= new notificacoes();
            $notificar->descricao='Tem nova correspondência recepcionada por:  '. user::where('id',$correspondencia->fk_recetor)->value('sigla').', por favor aguarde a entrega ou contacte o receptor.';
            $notificar->fk_tipoNotificacao=6;
            $notificar->fk_user=$correspondencia->fk_destinatario;
            $notificar->save();
         }else {
            $correspondencia->fk_destinatario=null;
            $correspondencia->cliente=$request->Cliente;
         }
         $correspondencia-> save();
         
         \Session::flash('success', 'A correspondência foi recepcionada, aguarda-se confirmação entrega da mesma ao destinatário');

         // escrever log 
         return Redirect::to('/correspondencias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Correspondencia  $correspondencia
     * @return \Illuminate\Http\Response
     */
    public function entregar(Request $request)
    {
        
        $correspondencia= correspondencia::find($request->entregar);
        $correspondencia->diaEntrega=carbon::now()->format('Y-m-d H:i:s');
        $correspondencia->entregue=1;
        $correspondencia->save();
        if ($correspondencia->interno==1) {
        $notificar= new notificacoes();
        $notificar->descricao='Recebeu a correspondencia de '. user::where('id',$correspondencia->fk_recetor)->value('sigla').', por favor confirme a recepção da mesma';
        $notificar->fk_tipoNotificacao=6;
        $notificar->fk_user=$correspondencia->fk_destinatario;
        $notificar->save();
        }
        \Session::flash('success', 'A correspondência foi entregue, aguarda-se confirmação de recepção');

        // escrever log 
        return Redirect::to('/correspondencias');
    }

    public function receber(Request $request)
    {
        
        $correspondencia= correspondencia::find($request->receber);
        $correspondencia->diaConfirmacaoEntrega=carbon::now()->format('Y-m-d H:i:s');
        $correspondencia->entregue=2;
        $correspondencia->save();
        if ($correspondencia->interno==1) {
        $notificar= new notificacoes();
        $notificar->descricao='A foi confirmada a recepção da correspondência entregue a '. user::where('id',$correspondencia->fk_remetente)->value('sigla');
        $notificar->fk_tipoNotificacao=6;
        $notificar->fk_user=$correspondencia->fk_recetor;
        $notificar->save();
        }
        \Session::flash('success', 'A correspondência foi confirmada');

        // escrever log 
        return Redirect::to('/correspondencias');
    }

    public function comentar(Request $request)
    {
     
        $correspondencia= correspondencia::find($request->comentar);
        $correspondencia->comentario= $request->comentario;
        $correspondencia->save();
        \Session::flash('success', 'Comentário Introduzido');

        // escrever log 
        return Redirect::to('/correspondencias');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Correspondencia  $correspondencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Correspondencia $correspondencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Correspondencia  $correspondencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Correspondencia $correspondencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Correspondencia  $correspondencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Correspondencia $correspondencia)
    {
        //
    }
}
