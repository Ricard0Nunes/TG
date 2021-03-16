<?php

namespace App\Http\Controllers;

use App\mensagens;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Session;
use Carbon\Carbon;
use App\caixaEntrada;
use App\caixaGrupo;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function caixaentrada(Request $request  )
    {
       $id= Session::get('id');
       $grupo=Session::get('grupo');

        $caixaentrada = caixaEntrada::where('proprietario',auth::id())->orWhere('destinatario',auth::id())->orderBy('updated_at','DESC')->get();
        $users=user::where('id','>',1)->where('id','<>',auth::id())->where('visivel',1)->orderBy('name','ASC')->get();
        if ($id==null and $grupo==null) {
            $mensagens=[];
             $caixaentradaselecionada = 0;
            $grupo="";
        } else {
          if ($grupo==0) {
     
            $caixaentradaselecionada = caixaEntrada::where('pk_caixaEntrada',$id)->value('pk_caixaEntrada');
            $mensagens=mensagens::where('caixa', $caixaentradaselecionada)->orderBy('created_at')->get();
           
          } else {
         
            $caixaentradaselecionada = caixaGrupo::where('pk_caixaEntradaGrupo',$id)->value('pk_caixaEntradaGrupo');
            $mensagens=mensagens::where('caixaGrupo', $caixaentradaselecionada)->orderBy('created_at')->get();
            
      
          }

            // $caixaentradaselecionada = caixaEntrada::where('pk_caixaEntrada',$id)->value('pk_caixaEntrada');
            
            //   $mensagens=mensagens::where('caixa', $caixaentradaselecionada)->orderBy('created_at')->get();
             for ($i=0; $i <count($mensagens) ; $i++) { 
          
               if (($mensagens[$i]->remetente)!=(auth::id())) {
                  $mensagens[$i]->lido=1;
                  $mensagens[$i]->save();
               }
              }
        }

          $caixaentradagrupo = caixaGrupo::orWhere('proprietario',auth::id())->orWhereIN('participantes',array(auth::id()))->get();
    

        
   
        return view('ver/chat', compact('caixaentrada','caixaentradagrupo','grupo','users','mensagens', 'caixaentradaselecionada'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarmensagens(Request $request)
    {

    if ($request->grupo==0) {
     
      $caixaentradaselecionada = caixaEntrada::where('pk_caixaEntrada',$request->id)->value('pk_caixaEntrada');
      $mensagens=mensagens::where('caixa', $caixaentradaselecionada)->orderBy('created_at')->get();
      $grupo=$request->grupo;
    } else {
   
      $caixaentradaselecionada = caixaGrupo::where('pk_caixaEntradaGrupo',$request->id)->value('pk_caixaEntradaGrupo');
      $mensagens=mensagens::where('caixaGrupo', $caixaentradaselecionada)->orderBy('created_at')->get();
      $grupo=$request->grupo;

    }
    
     $users=user::where('id','>',1)->where('id','<>',auth::id()) -> where('visivel',1)->orderBy('name','ASC')->get();
      
      
       for ($i=0; $i <count($mensagens) ; $i++) { 
    
         if (($mensagens[$i]->remetente)!=(auth::id())) {
            $mensagens[$i]->lido=1;
            $mensagens[$i]->save();
         }
        }
        $caixaentrada = caixaEntrada::where('proprietario',auth::id())->orWhere('destinatario',auth::id())->orderBy('updated_at','DESC')->get();
        $caixaentradagrupo = caixaGrupo::orWhere('proprietario',auth::id())->orWhereIN('participantes',array(auth::id()))->get();

       return view('ver/chat', compact('caixaentrada','caixaentradagrupo','grupo','users','mensagens', 'caixaentradaselecionada'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviar(Request $request)
    {
    
        $mensagens= new  mensagens();
        $mensagens->remetente=$request->de;
        if ($request->grupo==1) {
          $mensagens->caixaGrupo=$request->caixa;
          $caixaentradaselecionada = caixaGrupo::where('pk_caixaEntradaGrupo',$request->caixa)->value('pk_caixaEntradaGrupo');
          $caixaentrada=  caixaGrupo::where('pk_caixaEntradaGrupo',$caixaentradaselecionada)->get();
          $caixaentrada[0]->updated_at= carbon::now()->format('Y-m-d H:s:i');
          $caixaentrada[0]->save();
        } else {
          $mensagens->caixa=$request->caixa;
          $caixaentradaselecionada = caixaEntrada::where('pk_caixaEntrada',$request->caixa)->value('pk_caixaEntrada');
          $caixaentrada=  caixaEntrada::where('pk_caixaEntrada',$caixaentradaselecionada)->get();
          $caixaentrada[0]->updated_at= carbon::now()->format('Y-m-d H:s:i');
          $caixaentrada[0]->save();
        }
        
       
        $mensagens->mensagem=$request->mensagem;
        $mensagens->lido=0;
        $mensagens->save();
       
       $grupo=$request->grupo;
        return 
        Redirect::to('/chat') ->with(['id'=>$caixaentradaselecionada, 'grupo'=>$grupo]);
       
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function novaconversacao(Request $request)
    {
          
          $caixaentradaselecionada = caixaEntrada::where('destinatario',auth::id())->where('proprietario',$request->id)->value('pk_caixaEntrada');
        if ($caixaentradaselecionada==null){
          $caixaentradaselecionada = caixaEntrada::where('proprietario',auth::id())->where('destinatario',$request->id)->value('pk_caixaEntrada');
        }


        if ($caixaentradaselecionada==null) {
            $caixaentrada = new caixaEntrada();
            $caixaentrada->proprietario=auth::id();
            $caixaentrada->destinatario=$request->id;
            $caixaentrada->save();
            $caixaentradaselecionada= $caixaentrada->pk_caixaEntrada;
            $users=user::where('id','>',1)->where('id','<>',auth::id()) -> where('visivel',1)->get();
            
            $mensagens=mensagens::where('caixa', $caixaentradaselecionada)->orderBy('created_at')->get();
          for ($i=0; $i <count($mensagens) ; $i++) { 

            if (($mensagens[$i]->remetente)!=(auth::id())) {
                $mensagens[$i]->lido=1;
                $mensagens[$i]->save();
            }
            }
        
          $caixaentrada = caixaEntrada::where('proprietario',auth::id())->orWhere('destinatario',auth::id())->get();

        } else {
          

            $users=user::where('id','>',1)->where('id','<>',auth::id()) -> where('visivel',1)->get();
            
              $mensagens=mensagens::where('caixa', $caixaentradaselecionada)->orderBy('created_at')->get();
            for ($i=0; $i <count($mensagens) ; $i++) { 
          
              if (($mensagens[$i]->remetente)!=(auth::id())) {
                  $mensagens[$i]->lido=1;
                  $mensagens[$i]->save();
              }
              }
          
              $caixaentrada = caixaEntrada::where('proprietario',auth::id())->orWhere('destinatario',auth::id())->get();
              
        }
        $caixaentradagrupo = caixaGrupo::orWhere('proprietario',auth::id())->orWhereIN('participantes',array(auth::id()))->get();
      $grupo=$request->grupo;
    return view('ver/chat', compact('caixaentrada','users','mensagens', 'caixaentradaselecionada','caixaentradagrupo','grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(chat $chat)
    {
        //
    }
}
