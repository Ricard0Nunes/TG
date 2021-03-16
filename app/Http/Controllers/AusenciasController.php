<?php

namespace App\Http\Controllers;

use App\Ausencias;
use App\Ponto;
use App\User;
use App\Event;
use App\Horario;
use App\Paragem;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Empresa;
use App\Task;
use App\Notificacoes;
use App\usersComuns;



class AusenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function marcarausencia(){ 
        $users = user::where('id','>',1)-> where('visivel',1)->orderby('name','ASC')->pluck('name','id');
        $justificacoes = DB::connection('geraltg')->table('justificacoes')->pluck('descricao','pk_justificacao');
        return view('criar/ausencia', compact('users','justificacoes'));
    }
    public function marcarausenciapropria(){ 
        $users = user::where('id','=',auth::id())->pluck('name','id');
        $justificacoes = DB::connection('geraltg')->table('justificacoes')->pluck('descricao','pk_justificacao');
        return view('criar/ausencia', compact('users','justificacoes'));
    }
    

    public function ausenciastore(Request $request)
    { 
      $first = carbon::parse($request->start_date);
      $second = carbon::parse($request->end_date);
      if ($first->greaterThan($second))
      {
          return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
              ->withInput();

      }

      
     
    //  return$request;
        $users= user::where('id',$request->fk_tecnico)->get();
        $diainteiro=1;
  
        // pedir horas de ausencias marcadas em horas 
           $justificacao=DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$request->fk_ausencia)->get();
         if ($justificacao[0]->duracaoHoras>0 and $request->pediuhoras=="false") {

            return view('criar/ausenciahora', compact('request','users','justificacao'));

       }
       else {
                      
              $usercomum=userscomuns::where('BI',$users[0]->bi)->get();
              // return $justificacao[0]->pk_justificacao;

              if ($justificacao[0]->pk_justificacao==13) {
                    if ($usercomum[0]->anoAnt==0) {

                    if ($usercomum[0]->ano==0) {
                      if ($usercomum[0]->anoProx<=-22) {
                        return Redirect::back()->with('warning', 'Não dispõe de saldo de férias.')->withInput();
                      }
                    }
                    }

                    $numerodias=Carbon::parse($request->start_date)-> diffInDays(Carbon::parse($request->end_date));

                    $start= Carbon::parse($request->start_date);
                    $end= Carbon::parse($request->end_date);
                    $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
                      return $date->isWeekend();
                  }, $end);
              $paragens=paragem::whereBetween('dia', [$start, $end])->where('fk_justificacao','<>',13)->get();
              // return count($paragens);
              // return $numerodias;

              $diaferiado=0;
              for ($f=0; $f <count($paragens) ; $f++) { 
              $feriado[$f]=carbon::parse($paragens[$f]->dia);
              if ($feriado[$f]->isWeekend()) {
                $diaferiado++;
              }
              }

                

              $diascorretos= ($numerodias+1 -$diasFds -  count($paragens)+$diaferiado);
                

      $numferias=$usercomum[0]->anoAnt+$usercomum[0]->ano+$usercomum[0]->anoProx;
      if ($diascorretos>$numferias) {
            
        return Redirect::back()->with('warning', 'O numero de dias: '.$diascorretos. '  excede o seu saldo de férias: '.$numferias)->withInput();
       
      
      }
      

}

///////VERIFICAR horas
        
      // $horainicio =Carbon::parse($request->start_date)->diffInSeconds(Carbon::parse('00:00:00'));
      // $horafim=Carbon::parse($request->end_date)->diffInSeconds(Carbon::parse('00:00:00'));
      // if($horainicio<$horafim){
        
      //  return Redirect::back()->with('warning', 'A hora de início tem de ser inferior a hora de fim')->withInput();

      // }
        
  // criar ausencia na tabela
  $ausencia1= new ausencias();
  $ausencia1->biuser=$users[0]->bi;
  $ausencia1->start=Carbon::parse($request->start_date .' ' .$request['time_start'])->format('Y-m-d H:i:s');
  $ausencia1->end =  Carbon::parse($request['end_date'].' ' .$request['time_end'])->format('Y-m-d H:i:s');
  $ausencia1->fk_justificacao=$request->fk_ausencia;
  $ausencia1->save();
 
  $notificacoes=notificacoes::where('descricao','like','Ausência de:  '.  $request->start_date .' a : '.  $request->end_date .' aguarda aprovação')->where('fk_user',user::where('bi',$users[0]->bi)->value('id'))->get();
           
  if (count($notificacoes)==0) {
    $notificar= new notificacoes();
    $notificar->descricao='Ausência de:  '.  $request->start_date .' a : '.  $request->end_date .' aguarda aprovação';
    $notificar->fk_tipoNotificacao=3;
    $notificar->fk_user=$users[0]->id;
    $notificar->save();


    $notificarrh= new notificacoes();
    $notificarrh->descricao='Ausência '.$users[0]->name. ' de:  '.  $request->start_date .' a : '.  $request->end_date .' aguarda aprovação';
    $notificarrh->fk_tipoNotificacao=3;
    $notificarrh->fk_user=user::where('fk_departamento',3)->value('id');
    $notificarrh->save();
  }

  return Redirect::to('/registo')->with('Success', 'Ausência Registada')->withInput();
     
        }
    }
    
    public function mostrarausencias(){
      $ausenciasf = ausencias::get();
      $ausencias=[];
      for ($i=0; $i <count($ausenciasf) ; $i++) { 
          $users=user::get();
          for ($a=0; $a <count($users) ; $a++) { 
            

        if ($users[$a]->bi==$ausenciasf[$i]->ccuser) {
          $ausencias[]=$ausenciasf[$i];
        }

          }
      }

      return view('registo/mostrarausencias',compact('ausencias'));
    }



    public function ferias(){
      $ausenciasf = ausencias::where('fk_justificacao',13)->get();
      $ausencias=[];
      for ($i=0; $i <count($ausenciasf) ; $i++) { 
          $users=user::get();
          for ($a=0; $a <count($users) ; $a++) { 
            

        if ($users[$a]->bi==$ausenciasf[$i]->ccuser) {
          $ausencias[]=$ausenciasf[$i];
        }

          }
      }

      return view('registo/mostrarausencias',compact('ausencias'));
    }

    
public function ausenciasapagar(Request $request){

   $ausencias = ausencias::find($request->apagar);
  $users= user::where('BI',$ausencias->biuser)->get();
  
   $events=event::where('fk_tecnico',$users[0]->bi)->where('start_date',$ausencias->start)->where('end_date',$ausencias->end)->get();
  for ($e=0; $e < count($events); $e++) { 
    

      $events[$e]->delete();
  }
   $numerodias=Carbon::parse($ausencias->start)-> diffInDays(Carbon::parse($ausencias->end)) ;
  //  $numerodias=Carbon::parse($request->start_date)-> diffInDays(Carbon::parse($request->end_date));

              




      if ($ausencias->fk_justificacao==13) {
        $usercomum=userscomuns::where('BI',$users[0]->bi)->get();
      
        $start= Carbon::parse($ausencias->start);
        $end= Carbon::parse($ausencias->end);
        $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
          return $date->isWeekend();
      }, $end);
      $paragens=paragem::whereBetween('dia', [$start, $end])->where('fk_justificacao','<>',13)->get();
      // return count($paragens);
      // return $numerodias;

      $diaferiado=0;
      for ($f=0; $f <count($paragens) ; $f++) { 
      $feriado[$f]=carbon::parse($paragens[$f]->dia);
      if ($feriado[$f]->isWeekend()) {
      $diaferiado++;
      }
      }



       $diascorretos= ($numerodias+1 -$diasFds -  count($paragens)+$diaferiado);


          

    for ($d=0; $d <$diascorretos ; $d++) { 
   
      if ($usercomum[0]->ano<22) {
             $usercomum[0]->ano++;
      }elseif (($usercomum[0]->anoProx)<0 and $usercomum[0]->ano>=22) {
          
          $usercomum[0]->anoProx++;
         }elseif ($usercomum[0]->anoAnt>=0) {
            
            $usercomum[0]->anoAnt++;
          }
         
        }
       
        $usercomum[0]->save();
      }

     

  for ($i=0; $i <=$numerodias ; $i++) { 
 
    $dia[$i]= Carbon::parse($ausencias->start)->addDays($i) ->format('Y-m-d');
  
      $ponto= ponto::where('data',  $dia[$i])->where('ccuser',$ausencias->biuser)->get();
     $task = Task::where('fk_tecnico',$users[0]->id)->where('tipo',3)->where('start_date','like',$dia[$i].' %')->get();
    if(count($task)>0){
     if($task[0]->end_date==$dia[$i].' 23:59:59'){
      $ponto[0]->delete();
    
      for ($t=0; $t < count($task); $t++) { 
      
        $task[$t]->delete();
      }


   

     }
    
    }
   
      
     
  }


    $ausencias->delete();
    return Redirect::to('/mostrarausencias')->with('Success', 'Ausência Apagada')->withInput();
}
    
public function ausenciaaprovar(Request $request){
    $diascorretos=0;
      $ausencia = ausencias::find($request->aprovar);
    
    $horatermina=carbon::parse($ausencia->end)->format('H:i:s');
  if ($horatermina=='00:00:00') {
    
  $ausencia->end=carbon::parse($ausencia->end)->format('Y-m-d'). ' 23:59:59';
  }

  $users= user::where('BI',$ausencia->biuser)->get();
    
  $horario=horario::find($users[0]->fk_horario);
    $horasdiarias=carbon::parse($horario->horasDiarias)->diffInSeconds(Carbon::parse('00:00:00'));

      $justificacao=DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->get();
      
      $numerodias=Carbon::parse($ausencia->start)-> diffInDays(Carbon::parse($ausencia->end));
      









    if ($ausencia->fk_justificacao==13) {

              $start= Carbon::parse($ausencia->start);
              $end= Carbon::parse($ausencia->end);
              $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
                return $date->isWeekend();
            }, $end);
        $paragens=paragem::whereBetween('dia', [$start, $end])->where('fk_justificacao','<>',13)->get();
        // return count($paragens);
        $diaferiado=0;
        for ($f=0; $f <count($paragens) ; $f++) { 
        $feriado[$f]=carbon::parse($paragens[$f]->dia);
        if ($feriado[$f]->isWeekend()) {
          $diaferiado++;
        }
      }

      

        $diascorretos= ($numerodias+1 -$diasFds -  count($paragens)+$diaferiado);

      

          

    }





      $usercomum=userscomuns::where('BI',$users[0]->bi)->get();
       $numerodias=$numerodias+1;
       for ($d=0; $d <$diascorretos ; $d++) { 
  
          if ($usercomum[0]->anoAnt>0) {
                $usercomum[0]->anoAnt=$usercomum[0]->anoAnt-1;
             }elseif (($usercomum[0]->ano)>0) {
            
                  $usercomum[0]->ano= $usercomum[0]->ano-1;
        
             }elseif ($usercomum[0]->anoProx>-22 ) {
              
              $usercomum[0]->anoProx =$usercomum[0]->anoProx -1;
     
            }
           
          }
         
          $usercomum[0]->save();
        
    

    


    for ($i=1; $i <=$numerodias ; $i++) { 
        $dia[$i]= Carbon::parse($ausencia->start)->addDays($i-1) ->format('Y-m-d');
         $ponto= ponto::where('data',  $dia[$i])->where('ccuser',$ausencia->biuser)->get();

       //   variavel para ver se é dia de semana e marcar ponto 
         $dt = Carbon::parse($ausencia->start)->addDays($i-1);
         
           //   ver se marca é dia completo para marcar ponto 
           if($i==$numerodias and $justificacao[0]->duracaoHoras>0){
            
                    $horasaida=DB::table('horarios')->where('pk_horario',$users[0]->fk_horario)->value('horaSaida');

                   $horasaidaSeg=(Carbon::parse($dia[$i]. ' ' .$horasaida)->diffInSeconds(Carbon::parse('00:00:00')->format('H:i:s'))); 
                       $horasFimSeg=(Carbon::parse($ausencia->end)->diffInSeconds(Carbon::parse('00:00:00')->format('H:i:s')));

                   if ($horasFimSeg <=$horasaidaSeg) {

                  $diainteiro=0;
                

                   }
                   else {
                    
                       $diainteiro=1;
                   }

                   }else {
                
                    $diainteiro=1;
                   }
                 
             
           if($dt->isWeekday()==1 and $diainteiro==1){
      
               if (count($ponto)>0) {
               $ponto1=ponto::find($ponto[0]->pk_ponto);
                   $ponto1->delete();
                   }
              
                 $registo = new ponto;
                 $registo->dia =Carbon::parse($dia[$i])->formatLocalized('%A %d de %B de %Y');
                 $registo->data=  $dia[$i];
                 $registo->entradaManha= '00:00:00';
                 $registo->saidaManha='00:00:00';
                 $registo->entradaTarde='00:00:00';
                 $registo->saidaTarde='00:00:00';
                 $registo->totalDia='00:00:00';
                 $registo->tempoAlmoco='00:00:00';
                 $registo->comentario=null;
                 $registo->fk_justificacao=$ausencia->fk_justificacao;
                 $registo->ccuser =$users[0]->bi;
                 $registo->empresapicagem =$registo->nifempresa  =empresa::where('visivel',1)->value('nif');
                 $registo->fk_tipo=7; 

                 $registo->save(); 
   
             

                            
                $task = new Task();
                $task->text = DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->value('descricao') .': '. DB::connection('geraltg')->table('userscomuns')->where('BI',$ausencia->biuser)->value('nome') ;
                $task->duration=1;
                $task->progress=1;
                $task->parent=0;
                $task->tipo=3;
                $task->start_date =  $task->horaInicioPrev = Carbon::parse( $dia[$i].'00:00:00')->format('Y-m-d H:i:s');
                $task->end_date = $task->horaFimPrev= Carbon::parse($dia[$i].'23:59:59')->format('Y-m-d H:i:s');
                $task->fk_tecnico=$users[0]->id;
                $task->fk_estadoIntervencao = 1; 
                $task->save();
        
             }
            
   
      elseif (($dt->isWeekday()==1 and $diainteiro==0)) {
  
      
              $task = new Task();
              $task->text = DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->value('descricao') .': '. DB::connection('geraltg')->table('userscomuns')->where('BI',$ausencia->biuser)->value('nome') ;
              $task->duration=1;
              $task->progress=1;
              $task->parent=0;
              $task->tipo=3;
              $task->start_date =  $task->horaInicioPrev = Carbon::parse($ausencia->start)->format('Y-m-d H:i:s');
              $task->end_date = $task->horaFimPrev= Carbon::parse($ausencia->end)->format('Y-m-d H:i:s');
              $task->fk_tecnico=$users[0]->id;
              $task->fk_estadoIntervencao = 1; 
              $task->save();
     
        if (count($ponto)>0) {
            $ponto1=ponto::find($ponto[0]->pk_ponto);
            $comentario= DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->value('descricao') .': '. user::where('BI',$ausencia->biuser)->value('name') ;
            $ponto1->comentario=$comentario;
            $ponto1->fk_tipo=7; 
                $ponto1->save();
                }else {
                   
                    // $registo = new ponto;
                    // $registo->dia =Carbon::parse($dia[$i])->formatLocalized('%A %d de %B de %Y');
                    // $registo->data=  $dia[$i];
                    // $registo->comentario=DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->value('descricao') .': '. DB::connection('geraltg')->table('userscomuns')->where('BI',$ausencia->biuser)->value('nome') ;
                    // $registo->fk_justificacao=$ausencia->fk_justificacao;
                    // $registo->ccuser =$users[0]->bi;
                    // $registo->empresapicagem =$registo->nifempresa  =empresa::where('visivel',1)->value('nif');
                   
                    // $registo->fk_tipo=7; 
                   
                    // $registo->save();
                }

       
      
       }
    }

    //    fim de marcacao de ponto 
   
    // aprovar


 



    $event=new Event();
    $event->text =$users[0]->sigla.'->'. strip_tags(  DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencia->fk_justificacao)->value('descricao') );
    $event->start_date =    $ausencia->start;
    $event->end_date = carbon::parse($ausencia->end)->format('Y-m-d H:i:s');
    if ($ausencia->fk_justificacao==13) {
      $event->subject = 1;
    } elseif($ausencia->fk_justificacao>0 and $ausencia->fk_justificacao!=13  and $ausencia->fk_justificacao<13) {
      $event->subject = 2;
    } elseif($ausencia->fk_justificacao==17){
      $event->subject = 5;
    }
   elseif($ausencia->fk_justificacao>17){
    $event->subject = 9;
  }

    else{
      $event->subject = 8;
    }
    
    
    $event->fk_tecnico=$users[0]->bi;
    $event->obs = null;
    $event->localizacao = null;
    
 $event->save();
  

    $notificacoes=notificacoes::where('descricao','like','Ausência de:  '.  $ausencia->start .' a : '.  $ausencia->end .'aprovada')->where('fk_user',user::where('bi',$users[0]->bi)->value('id'))->get();
           
    if (count($notificacoes)==0) {
      $notificar= new notificacoes();
      $notificar->descricao='Ausência de:  '.  $ausencia->start  .' a : '.  $ausencia->end .' aprovada';
      $notificar->fk_tipoNotificacao=3;
      $notificar->fk_user=$users[0]->id;
      $notificar->save();
  
    }
    $ausencia->estado=1;
    $ausencia->aprovadoPor=user::where('id',auth::id())->value('name');
    $ausencia->save();
 
    return Redirect::to('/mostrarausencias')->with('Success', 'Ausência Criada')->withInput();
}
public function ausenciareprovar(Request $request){

   $ausencia = ausencias::find($request->reprovar);
   $users= user::where('BI',$ausencia->biuser)->get();
   $ausencia->estado=2;
   $ausencia->aprovadoPor=user::where('id',auth::id())->value('name');
   $notificacoes=notificacoes::where('descricao','like','Ausência de:  '.  $ausencia->start .' a : '.  $ausencia->end .' reprovada')->where('fk_user',user::where('bi',$users[0]->bi)->value('id'))->get();
           
   if (count($notificacoes)==0) {
     $notificar= new notificacoes();
     $notificar->descricao='Ausência de:  '.  $ausencia->start .' a : '.  $ausencia->end .' reprovada';
     $notificar->fk_tipoNotificacao=3;
     $notificar->fk_user=$users[0]->id;
     $notificar->save(); 
   }
   $ausencia->save();
    return Redirect::to('/mostrarausencias')->with('Success', 'Ausência Apagada')->withInput();
}



}
