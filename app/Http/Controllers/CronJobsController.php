<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notificacoes;
use App\Empresa;
use App\Ponto;
use App\User;
use App\Task;
use App\usersComuns;
use Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
use App\Alert;

class CronJobsController extends Controller
{
    public function verificarponto()
    {
      $validadeCCidadao=null;
      $validadeContrato=null;
      $on=1;
      $ontem=carbon::now()->subDay($on);
     

      while ($ontem->isWeekend()) {
        $ontem=carbon::parse($dia)->subDay($on);
        $on++;
      }
      $ontem=carbon::parse($ontem)->format('Y-m-d');
      
      $tasksontem= task::where('tipo',2)->where('start_date','like',$ontem.'%' )->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('estadointervencoes','pk_estadoIntervencoes','fk_estadoIntervencao')->where('fk_estadoIntervencao',5)->orderBy('start_date')->get();
      for ($to=0; $to <count($tasksontem) ; $to++) { 
        $mensagem[$to]='Tem em pausa a tarefa do dia ' .$ontem. ' : '.$tasksontem[$to]->text;
        $notificacoes=notificacoes::where('descricao','like', $mensagem[$to])->where('fk_user', $tasksontem[$to]->fk_tecnico)->get();
        if (count($notificacoes)==0) {

          $notificarto= new notificacoes();
          $notificarto->descricao=  $mensagem[$to];
          $notificarto->fk_tipoNotificacao=1;
          $notificarto->fk_user=$tasksontem[$to]->fk_tecnico;
          $notificarto->save();
        }
      }

    // ver validades
        $user=user::where('visivel',1)->get();
        
        foreach ($user as $user) {
          

                $validadecc=carbon::parse($user->validadecc)->diffInDays(carbon::now());
                $dataFimContrato=carbon::parse($user->dataFimContrato)->diffInDays(carbon::now());
                if ($validadecc<30){
                  $validadeCCidadao=$validadeCCidadao.'O CC de '.$user->name . ' termina a : '.$user->validadecc.' ('.$validadecc.' dias); ';
                }
                if ($dataFimContrato<30){
                  $validadeContrato=$validadeContrato.'O contrato de ' .$user->name . ' termina a : '.$user->dataFimContrato .' ('.$dataFimContrato.' dias); ';
                }
        }
        // notificar rh 
        if ($validadeCCidadao!=null) {
          $idRH=user::where('fk_departamento',3)->where('visivel',1)->get('id');
       
           for ($rh=0; $rh <count($idRH) ; $rh++) { 
            $notificacoes=notificacoes::where('descricao','like',$validadeCCidadao)->where('fk_user',$idRH[$rh]->id)->get();
            if (count($notificacoes)==0) {

              $notificarrh= new notificacoes();
              $notificarrh->descricao= $validadeCCidadao;
              $notificarrh->fk_tipoNotificacao=4;
              $notificarrh->fk_user=$idRH[$rh]->id;
              $notificarrh->save();
            }
          }
        }
        if ($validadeContrato!=null) {
         
            $idRH1=user::where('fk_departamento',3)->where('visivel',1)->get('id');
            for($rh1=0; $rh1 <count($idRH1) ; $rh1++) {
            
              $notificacoes1=notificacoes::where('descricao','like',$validadeContrato)->where('fk_user',$idRH1[$rh1]->id)->get();
              if (count($notificacoes1)==0) {
              $notificarrh1= new notificacoes();
              $notificarrh1->descricao= $validadeContrato;
              $notificarrh1->fk_tipoNotificacao=4;
              $notificarrh1->fk_user=$idRH1[$rh1]->id;
              
              $notificarrh1->save();
              }
            }
        }
    




    // aniversario
                $aniversario=[];
                $mensagem='';
              $aniv=user::where('visivel',1)->get();

                for ($b=0; $b <count($aniv) ; $b++) { 
                  $day=carbon::parse($aniv[$b]->dtnsc)->format('d');
                  $month=carbon::parse($aniv[$b]->dtnsc)->format('m');
                  $year=carbon::parse($aniv[$b]->dtnsc)->format('Y');
                  $born = Carbon::createFromDate( $year,  $month, $day);
              
                  $todayDay=carbon::now()->format('d');
                  $todayMonth=carbon::now()->format('m');
                  $todayYear=carbon::now()->format('Y');
                  $yesCake = Carbon::createFromDate( $todayYear,  $todayMonth, $todayDay);

              
                  if ($born->isBirthday($yesCake)==true) {
                    $aniversario[]=( $aniv[$b]->name) .': '. Carbon::now()->diffInYears(carbon::parse($aniv[$b]->dtnsc)).' anos :) ';
                  }

                }

                if (sizeof ($aniversario)>0) {
                    $mensagem='Turtlegest Informa: Hoje é dia aniversário de :  '.implode("",$aniversario). 'vamos dar os parabéns e comer bolo.';
                    $mens=alert::where('mensagem', 'like', $mensagem)->get();
                  if(count($mens)==0){

                    $alert = new alert;
                    $alert->mensagem = $mensagem;
                    $alert->de = carbon::now()->format('Y-m-d');
                    $alert->a = carbon::now()->format('Y-m-d');
                    $alert->todos = 1;
                    $alert->users = 1;
                    $alert->save();
                  }
                }
      // fim aniversario 
    // pontos e faltas 
                $ontem=  Carbon::yesterday()->format('Y-m-d');
                //  verificar se o dia de ontem nao foi feriado ou fds

          
                if( Carbon::yesterday()->isWeekday()==0 )
                {
                // não marca pontos ao  fds 
                } else
                {
              
                  $users= user::where('id','>',1)->where('visivel',1)->get();
              

                  for ($i=0; $i < count($users) ; $i++) { 
                   $ponto= ponto::where('data', $ontem)->where('ccuser',$users[$i]->bi)->get();
                 
                    if (count($ponto)==0 and $users[$i]->id!=22 and $users[$i]->id!=23 ) {
                     
                      // marcar falta
                            $notificacoes=notificacoes::where('descricao','like','Tem falta marcada no dia'. $ontem)->where('fk_user',user::where('bi',$users[$i]->bi)->value('id'))->get();
                           
                            if (count($notificacoes)==0) {
                              $notificar= new notificacoes();
                              $notificar->descricao='Tem falta marcada no dia  '.  $ontem ;
                              $notificar->fk_tipoNotificacao=2;
                              $notificar->fk_user=$users[$i]->id;
                              $notificar->save();
                            }

                            $registo = new ponto;
                            $registo->dia =Carbon::yesterday()->formatLocalized('%A %d de %B de %Y');
                            $registo->data= $ontem;
                            $registo->entradaManha= '00:00:00';
                            $registo->saidaManha='00:00:00';
                            $registo->entradaTarde='00:00:00';
                            $registo->saidaTarde='00:00:00';
                            $registo->totalDia='00:00:00';
                            $registo->tempoAlmoco='00:00:00';
                            $registo->comentario=null;
                            $registo->fk_justificacao=0;
                            $registo->ccuser =$users[$i]->bi;
                            $registo->empresapicagem =$registo->nifempresa  =empresa::where('visivel',1)->value('nif');
                            $registo->fk_tipo=6; 
                          
                            $registo->save(); 
                        
                    } else 
                    {
                   
                       // ver se ha ponto impar 
                          if( ($ponto[0]->saidaManha ==null) or ($ponto[0]->entradaTarde==null) or ($ponto[0]->saidaTarde==null))
                            {
                              // ver se ja foi notificado
                              $notificacoes=notificacoes::where('descricao','like','Tem ponto por editar no dia '. $ontem)->where('fk_user',user::where('bi',$users[$i]->bi)->value('id'))->get();
                              if (count($notificacoes)==null) {
                                  $notificar= new notificacoes();
                                  $notificar->descricao='Tem ponto por editar no dia '. $ontem ;
                                  $notificar->fk_tipoNotificacao=2;
                                  $notificar->fk_user=$users[$i]->id;
                              $notificar->save();
                              }
                            }
              
                    }
                    
                  }

     
               }

    //  Fim ponto e faltas 
    // tarefas em pausa no dia anterior
     
             
}
}
