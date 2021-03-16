<?php

namespace App\Http\Controllers;

use App\Ponto;
use App\Ausencias;
use App\Task;
use App\Horario;
use App\Paragem;
use App\EdicaoPonto;
use App\Projeto;
use App\User;
use App\Departamento;
use App\Cargo;
use App\Empresa;
use App\Link;
use App\Alert;
use App\todoList;
use App\Notificacoes;
use App\Processamentos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\URL;
use App\usersComuns;
use Session;

// use App\Logs;
use Validator;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Bioudi\LaravelMetaWeatherApi\Weather;
class PontoController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
        $user= user::find(Auth::id());


        if($user->subcontratado==0){
            $ponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->where('nifempresa',empresa::where('pk_empresa',$user->fk_empresa)->value('NIF'))->get();
           }
           else {
              
            $ponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();           
           }


        $cargo = cargo::where('pk_cargo',$user->fk_cargo)->value('descricao');
        $departamento = departamento::where('pk_departamento',$user->fk_departamento)->value('descricao');
  
        $tasks=task::where('tipo','>',1)->where('fk_tecnico',$user->id)->whereDate('start_date', 'like', date('Y-m-d').'%')
                // ->whereDate('horaFimPrev','like', date('Y-m-d').'%')
       ->leftjoin('projetos','fk_projeto','pk_projeto')->leftjoin('clientes','fk_cliente','pk_cliente')->leftjoin('estadointervencoes','fk_estadoIntervencao','pk_estadoIntervencoes')->orderBy('start_date')->groupBy('id')->get();
 
      
    
        // $tasks=task::where('tipo','>',1)->where('fk_tecnico',$user->id)->Where(function ($query) {
        //         $query->whereDate('start_date', 'like', date('Y-m-d').'%')
        //             ->orWhereDate('end_date','like', date('Y-m-d').'%');
        //     })->leftjoin('projetos','fk_projeto','pk_projeto')->leftjoin('clientes','fk_cliente','pk_cliente')->leftjoin('estadointervencoes','fk_estadoIntervencao','pk_estadoIntervencoes')->orderBy('start_date')->get();
        $numerodetarefas=0;   
        $tempotarefas=0; 
            for ($i=0; $i <count($tasks) ; $i++) { 
                if ($tasks[$i]->tipo==2 and ($tasks[$i]->fk_estadoIntervencao==2 or $tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==5 ) ) {
                    $numerodetarefas++;
                    $duracaotarefa[$i]=Carbon::parse($tasks[$i]->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'));
                    $tempotarefas=$duracaotarefa[$i]+$tempotarefas;

                
                }
            }




            if(count($ponto)==0){

                $posicao=0;
            }
            elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha==null ){
                $posicao=1;
            }

            elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde==null ){
                $posicao=2;
            }
            elseif( $ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde==null ){
                $posicao=3;
            }
            elseif( $ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde!=null ){

                $posicao=4;
            }
            elseif( $ponto[0]->entradaManha==null and $ponto[0]->saidaManha==null and $ponto[0]->entradaTarde==null and $ponto[0]->saidaTarde==null and  $ponto[0]->fk_justificacao>0){
                $posicao=0;
            }
            $dia=date('Y-m-d');
            // bloqueio de ponto
            if(1==1)
                // request()->ip() == '195.23.35.164' || request()->ip() == gethostbyname('globalseven.ddns.net')||  request()->ip() == '127.0.0.1' )
            {
                $bloqueio=0;
             }
             else {
                $bloqueio=1;
             }
           
             
            $noticias=alert::where('de','<=',date('Y-m-d'))->where('a','>=',date('Y-m-d'))->get();
            $tasksPendentes=task::where('fk_tecnico',$user->id)->where('tipo',2)->whereIn('fk_estadoIntervencao',array(1,4))->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksEmPausa=task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',5)->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksConcluidas=task::where('fk_tecnico',$user->id)->whereIn('fk_estadoIntervencao',array(3,7))->where('tipo',2)->orderBy('start_date','desc')->get();
            $todolist=todolist:: where('fk_user',$user->id)->get();
            $queryString = $_SERVER['QUERY_STRING'];
            if ($queryString!=null) {
                $active_tab = $queryString;
            }else {
                $active_tab = "RegistoDiario";
            }


             $ausencias=ausencias::where('biuser',$user->bi)->where('comRetribuicao',0)->where('start','<=',date('Y-m-d 00:00:00'))->where('end','<=',date('Y-m-d 23:59:59'))->leftjoin('justificacoes','pk_justificacao','fk_justificacao')->where('duracaoHoras',1)->get();
            $totalAusencias=0;
            for ($b=0; $b <count($ausencias) ; $b++) { 
                
                 $totalAusencias+= Carbon::parse($ausencias[$b]->start_date)->diffInSeconds(Carbon::parse($ausencias[$b]->end_date));
            }
            // $weather = new Weather();
            // return $weather->getByCityName('Setúbal');
            //  return view('registo/registo2',compact('user','weather','totalAusencias','noticias','active_tab','cargo','departamento','tasks','ponto','posicao','dia','bloqueio','tasksPendentes','tasksEmPausa','tasksConcluidas','todolist'));

             return view('registo/registo2',compact('user','tempotarefas','totalAusencias','noticias','active_tab','cargo','departamento','tasks','ponto','posicao','dia','bloqueio','tasksPendentes','tasksEmPausa','tasksConcluidas','todolist'));
        }
    }

    public function registodia(Request $request)
    {
    
        $data= Session::get('dia');
        $id= Session::get('id');
        if ($data==null) {
            $data=$request->dia;
        }
        if ($id==null) {
            $id=$request->id;
        }
       
        $user= user::find($id);


        if($user->subcontratado==0){
            $ponto= ponto::where('ccuser',$user->bi)->where('data', $data)->where('nifempresa',empresa::where('pk_empresa',$user->fk_empresa)->value('NIF'))->get();
             
            $ponto= ponto::where('ccuser','like',$user->bi)->where('data', $data)->get();  
        }
           else {
              
            $ponto= ponto::where('ccuser','like',$user->bi)->where('data', $data)->get();      
     
           }
  
        $cargo = cargo::where('pk_cargo',$user->fk_cargo)->value('descricao');
        $departamento = departamento::where('pk_departamento',$user->fk_departamento)->value('descricao');

  

        
           $tasks=task::where('tipo','>',1)->where('fk_tecnico',$user->id)->whereDate('start_date', 'like', $data.'%')
            //   ->whereDate('horaFimPrev','like', $data.'%')
            // ->orderBy('start_date')->get();
            ->leftjoin('projetos','fk_projeto','pk_projeto')->leftjoin('clientes','fk_cliente','pk_cliente')->leftjoin('estadointervencoes','fk_estadoIntervencao','pk_estadoIntervencoes')->orderBy('start_date')->get();


            $numerodetarefas=0;   
            $tempotarefas=0; 
                for ($i=0; $i <count($tasks) ; $i++) { 
                    if ($tasks[$i]->tipo==2 and ($tasks[$i]->fk_estadoIntervencao==2 or $tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==5 ) ) {
                        $numerodetarefas++;
                        $duracaotarefa[$i]=Carbon::parse($tasks[$i]->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'));
                        $tempotarefas=$duracaotarefa[$i]+$tempotarefas;
                    }
                }




    
            if(count($ponto)==0){
                $posicao=0;
            }
            elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha==null ){
                $posicao=1;
            }

            elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde==null ){
                $posicao=2;
            }
            elseif( $ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde==null ){
                $posicao=3;
            }
            elseif( $ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde!=null ){

                $posicao=4;
            }
            elseif( $ponto[0]->entradaManha==null and $ponto[0]->saidaManha==null and $ponto[0]->entradaTarde==null and $ponto[0]->saidaTarde==null and  $ponto[0]->fk_justificacao>0){
                $posicao=0;
            }

            $dia=$data; 
            if ($dia==date('Y-m-d')) {
                $bloqueio=0;
            }else{
                $bloqueio=1;
            }
           

              
           $noticias=alert::where('de','<=',date('Y-m-d'))->where('a','>=',date('Y-m-d'))->get();
           $tasksPendentes=task::where('fk_tecnico',$user->id)->where('tipo',2)->whereIn('fk_estadoIntervencao',array(1,4))->where('tipo',2)->orderBy('start_date','desc')->get();
           $tasksEmPausa=task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',5)->where('tipo',2)->orderBy('start_date','desc')->get();
           $tasksConcluidas=task::where('fk_tecnico',$user->id)->whereIn('fk_estadoIntervencao',array(3,7))->where('tipo',2)->orderBy('start_date','desc')->get();
            $todolist=todolist:: where('fk_user',$user->id)->get();
            $queryString = $_SERVER['QUERY_STRING'];
            if ($queryString!=null) {
                $active_tab = $queryString;
            }else {
                $active_tab = "RegistoDiario";
            }
            $totalAusencias=0;
            $ausencias=ausencias::where('biuser',$user->bi)->where('comRetribuicao',0)->where('start','<=',date('Y-m-d 00:00:00'))->where('end','<=',date('Y-m-d 23:59:59'))->leftjoin('justificacoes','pk_justificacao','fk_justificacao')->where('duracaoHoras',1)->get();

            for ($b=0; $b <count($ausencias) ; $b++) { 
                
                 $totalAusencias+= Carbon::parse($ausencias[$b]->start_date)->diffInSeconds(Carbon::parse($ausencias[$b]->end_date));
            }
            return view('registo/registo2',compact('user','tempotarefas','totalAusencias','noticias','active_tab','cargo','departamento','tasks','ponto','posicao','dia','bloqueio','tasksPendentes','tasksEmPausa','tasksConcluidas','todolist'));

            // return view('registo/registo',compact('user','noticias','totalausencias','active_tab','cargo','departamento','tasks','ponto','posicao','dia','bloqueio','tasksPendentes','tasksEmPausa','tasksConcluidas','todolist'));
    
        
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


    public function entradamanha(Request $request)
    {
      $user= user::find(Auth::id());
      $hoje= new Carbon();
      $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
      if (count($findponto)>0) {
        return Redirect::to('/registo')->with('Warning', 'Já tem entrada de manhã para o dia de hoje '.$user->name. '!')->withInput();
      } else {
       
      
      $ponto = new ponto;
     
      $ponto->dia =$hoje->formatLocalized('%A %d de %B de %Y');
      $ponto->data= $hoje->formatLocalized('%Y-%m-%d');
      $ponto->entradaManha= $hoje->isoFormat('H:mm:ss');
      $ponto->saidaManha=null;
      $ponto->entradaTarde=null;
      $ponto->saidaTarde=null;
      $ponto->totalDia=0;
      $ponto->tempoAlmoco=0;
      $ponto->comentario=null;
      $ponto->empresapicagem=empresa::where('visivel',1)->value('NIF');
      $ponto->fk_justificacao=0;
       $ponto->ccuser =$user->bi;
  
       if($user->subcontratado==0){
        $ponto->nifempresa= empresa::where('pk_empresa',$user->fk_empresa)->value('NIF');
       }
       else {
        $ponto->nifempresa= $user->nifEmpregador;
       }
   
     $user->status=1;
     $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
     $user->save();
      $ponto->fk_tipo = 1;
      $ponto->save();
     
            // escrever log
            
    // $log=new Logs;
    // $log->descricao='O utilizador deu entrada manha';
    // $log->fk_user=auth::id();
    // $log->fk_tipoLog=1;
    // $log->save();


      return Redirect::to('/registo')->with('Success', 'Bom dia '.$user->name. '!')->withInput();
        
        }
    }

    public function saidamanha(Request $request)
    {   
        $user= user::find(Auth::id());
     
        $horario =horario::where('pk_horario',$user->fk_horario)->value('almocoApartir');
        $horarioseg=Carbon::parse($horario)->diffInSeconds(Carbon::parse('00:00:00'));
        $agoraseg=Carbon::now()->diffInSeconds(Carbon::parse('00:00:00'));
       
       
        if ( $agoraseg< $horarioseg) {
            return Redirect::to('/registo')->with('Warning', 'A hora de almoço é a partir das: ' .$horario.' ! ')->withInput();
        }
     

         $taskEmAndamento= task::where('fk_tecnico',Auth::id())->where('fk_estadoIntervencao',2)->where('tipo',2)->get(); 
         $pontoporeditar= edicaoponto::where('dia',  date('Y-m-d'))->where('ccuser',$user->bi)->where('estado',0)->get();
        $aa= count($taskEmAndamento);
        if ($aa>0) { #countagem de tasks em andamento 
            return Redirect::to('/registo')->with('Warning', 'Primeiro termine ou pause a tarefa '.$taskEmAndamento[0]->text.' que está em curso! ')->withInput();
        } 
        $temtaskhoje= task::where('fk_tecnico',Auth::id())->where('tipo',2)->where('start_date', 'like',date('Y-m-d').'%') ->whereIn('fk_estadoIntervencao',array(3,5,7))->get(); 
        if ( count($temtaskhoje)<1) {
            return Redirect::to('/registo')->with('Warning', 'Não tem tarefas efetuadas no periodo da manhã! ')->withInput();
        }
        if (count($pontoporeditar)>0) { #countagem de tasks em andamento 
            return Redirect::to('/registo')->with('Warning', 'Tem uma edição de ponto por aprovar. Contacte os recursos humanos! ')->withInput();
        }
         $user= user::find(Auth::id());
         $hoje= new Carbon();
         $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
         $tempotrabalhado= Carbon::parse($findponto[0]->entradaManha)->diffInSeconds(Carbon::now());
         $ponto= ponto::find($findponto[0]->pk_ponto);
         $ponto->totalDia=gmdate("H:i:s", $tempotrabalhado);
         $ponto->saidaManha= $hoje->isoFormat('H:mm:ss');
         $ponto->fk_tipo = 2;
         $user->status=0;
         $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
         $user->save();
         $ponto->save();

        $task = new Task();
        $task->text = 'Almoço' ;
        $task->duration=1;
        $task->progress=1;
        $task->parent=0;
        $task->tipo=4;
        $task->start_date =  $task->horaInicioPrev = Carbon::now( )->format('Y-m-d H:i:s');
        $task->end_date = $task->horaFimPrev= Carbon::parse($task->start_date)->addHours(1)->format('Y-m-d H:i:s');
        $task->fk_tecnico=auth::id();
        $task->fk_estadoIntervencao = 2; 
        $task->save();



  
      return Redirect::to('/registo')->with('Success', 'Bom almoço '.$user->name. '!')->withInput();
    }
    public function entradatarde(Request $request)
    {
        $user= user::find(Auth::id());
      $pontoporeditar= edicaoponto::where('dia',  date('Y-m-d'))->where('ccuser',$user->bi)->where('estado',0)->get();
      if (count($pontoporeditar)>0) { #countagem de tasks em andamento 
       return Redirect::to('/registo')->with('Warning', 'Tem uma edição de ponto por aprovar. Contacte os recursos humanos! ')->withInput();
      }
        $hoje= new Carbon();
        $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
        $tempoAlmoco= Carbon::parse($findponto[0]->saidaManha)->diffInSeconds(Carbon::now());
            if ($tempoAlmoco < 1800) {
                // return Redirect::to('/registo')->with('Warning', 'Ainda só passaram  '. gmdate("i", $tempoAlmoco). ' minutos de almoço! Pelo menos precisa de 30 minutos para saborear a refeição!')->withInput();
            }



        $ponto= ponto::find($findponto[0]->pk_ponto);
        $ponto->entradaTarde= $hoje->isoFormat('H:mm:ss');
        $ponto->tempoAlmoco=gmdate("H:i:s", $tempoAlmoco);
        $ponto->fk_tipo = 3;
        $ponto->save();
        $user->status=1;
        $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
        $user->save();

        $task = Task::where('tipo',4)->where('fk_tecnico',auth::id())->whereDate('start_date', 'like', date('Y-m-d').'%')->get();
        $task[0]->end_date = $task->horaFimPrev= Carbon::now( )->format('Y-m-d H:i:s');
        $task[0]->fk_estadoIntervencao = 3; 
        $task[0]->fechado = 1; 
        $task[0]->save();



    
      return Redirect::to('/registo')->with('Success', 'Bem vindo de volta '.$user->name. '!')->withInput();
    }
    public function saida(Request $request)
    
    {  
          $user= user::find(Auth::id());

         $taskEmAndamento= task::where('fk_tecnico',Auth::id())->where('fk_estadoIntervencao',2)->where('tipo',2)->get(); 
         $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
        
       $pontoporeditar= edicaoponto::where('dia',  date('Y-m-d'))->where('ccuser',$user->bi)->where('estado',0)->get();
        $aa= count($taskEmAndamento);
       if ($aa>0) { #countagem de tasks em andamento 
        return Redirect::to('/registo')->with('Warning', 'Primeiro termine ou pause a tarefa '.$taskEmAndamento[0]->text.' que está em curso! ')->withInput();
       } 
       $temtaskhoje= task::where('fk_tecnico',Auth::id())->where('tipo',2)->where('start_date', 'like',date('Y-m-d').'%') ->whereIn('fk_estadoIntervencao',array(3,5,7))->get(); 
       if ( count($temtaskhoje)<1) {
           return Redirect::to('/registo')->with('Warning', 'Não tem tarefas efetuadas no periodo da tarde! ')->withInput();
       }if (count($pontoporeditar)>0) { #countagem de tasks em andamento 
        return Redirect::to('/registo')->with('Warning', 'Tem uma edição de ponto por aprovar. Contacte os recursos humanos! ')->withInput();
       }
     
         $hoje= new Carbon();
         $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();

         $tarde= Carbon::parse($findponto[0]->entradaTarde)->diffInSeconds(Carbon::now());
        
         $manha= Carbon::parse($findponto[0]->saidaManha)->diffInSeconds(Carbon::parse($findponto[0]->entradaManha));
         $ausencias=task::where('tipo',3)->where('start_date','>=',date('Y-m-d 00:00:00'))->where('end_date','<=',date('Y-m-d H:m:i'))->where('fk_tecnico',$user->id)->get();
         $totalAusencias=0;
        //  for ($b=0; $b <count($ausencias) ; $b++) { 
             
        //       $totalAusencias+= Carbon::parse($ausencias[$b]->start_date)->diffInSeconds(Carbon::parse($ausencias[$b]->end_date));
        //  }
       
         
         $horario=horario::where('pk_horario',$user->fk_horario)->value('horasDiarias');
         
         $tempotrabalhado= $manha+$tarde-$totalAusencias ; 
        
         $horariosegundostotalDia=Carbon::parse($horario)->diffInSeconds(Carbon::parse('00:00:00'));

         if ($tempotrabalhado<$horariosegundostotalDia) {
           $userCom= userscomuns::where('BI',$user->bi)->get();
           $userCom[0]->saldo+=  $horariosegundostotalDia-$tempotrabalhado;
           $userCom[0]->save();
           
         }else{
            $userCom= userscomuns::where('BI',$user->bi)->get();
            if ($userCom[0]->saldo>0) {
                // return gmdate("H:i:s", $userCom[0]->saldo);
                $userCom[0]->saldo+=  $horariosegundostotalDia-$tempotrabalhado;
                if ($userCom[0]->saldo <0) {
                    $userCom[0]->saldo=0;
                }
                $userCom[0]->save();
            
            }
            // return 'adiciona se saldo negativo';
         }
   
         $ponto= ponto::find($findponto[0]->pk_ponto);
         $ponto->totalDia=gmdate("H:i:s", $tempotrabalhado);
         $ponto->saidaTarde= $hoje->isoFormat('H:mm:ss');
         $ponto->fk_tipo = 4;
  
         $ponto->save();
         $user->status=0;
         $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
         $user->save();
      return Redirect::to('/registo')->with('Success', 'Obrigado pela sua colaboração '.$user->name. '!')->withInput();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
    public function editarregisto(Request $request){

        $data=  $request->data;
        $user= user::find($request->id);
        $cargo = cargo::where('pk_cargo',$user->fk_cargo)->value('descricao');
        $departamento = departamento::where('pk_departamento',$user->fk_departamento)->value('descricao');
        if($user->subcontratado==0){
            $ponto= ponto::where('ccuser',$user->bi)->where('data',$data )->where('nifempresa',empresa::where('pk_empresa',$user->fk_empresa)->value('NIF'))->get();
           }
           else {
              
            $ponto= ponto::where('ccuser',$user->bi)->where('data',  $data)->get();           
           }
            $justificacoes = DB::connection('geraltg')->table('justificacoes')->pluck('descricao','pk_justificacao');
            $contagemponto=count($ponto);
        return view('registo/editar_registo',compact('user','ponto','justificacoes','cargo','departamento','data','contagemponto'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
   

//log
public function salvarpontoeditado(Request $request){

   $temtaskhoje= task::where('fk_tecnico',Auth::id())->where('tipo',2)->where('start_date', 'like',$request->dia .'%' )->whereIn('fk_estadoIntervencao',array(3,5,7))->get(); 
    if ( count($temtaskhoje)<=0) {
        
        if($request->saidaManha!='' and  $request->entradaManha!=''){
       
        return Redirect::to('/registo')->with('Warning', 'Não tem tarefas executadas no dia: '.$request->dia.'. Introduza tarefas e depois edite o ponto. ')->withInput();
    }}

  
      $ponto = ponto::find($request->ponto);
      
      $user= user::where('bi', $request->Ponto_de)->get();
 
        if($ponto!=null){
             
      $edicaoPonto = new edicaoponto();
      $edicaoPonto->tempoAlmoco='00:00:00';
      $edicaoPonto->totalDia='00:00:00';
    
        $edicaoPonto->entradaManha=$ponto->entradaManha;
        if ($request->entradaManha!=null) {
        $edicaoPonto->entradaManhaNova=Carbon::parse($request->entradaManha)->format('H:i:s');
        }
        $edicaoPonto->saidaManha=$ponto->saidaManha;
        if ($request->saidaManha!=null) {
            $edicaoPonto->saidaManhaNova=Carbon::parse($request->saidaManha)->format('H:i:s');
        }    
        $edicaoPonto->entradaTarde=$ponto->entradaTarde;
        if ($request->entradaTarde!=null) {
            $edicaoPonto->entradaTardeNova=Carbon::parse($request->entradaTarde)->format('H:i:s');
        }            
        $edicaoPonto->saidaTarde=$ponto->saidaTarde;

        if ($request->saidaTarde!=null) {
            $edicaoPonto->saidaTardeNova=Carbon::parse($request->saidaTarde)->format('H:i:s');
        }  
        $edicaoPonto->fk_tipo=5;
        $edicaoPonto->comentario=$request->comentario;

        if ($request->fk_justificacao==null) {
            $edicaoPonto->fk_justificacao=$ponto->fk_justificacao;
        }else {
            $edicaoPonto->fk_justificacao=$request->fk_justificacao;
        }
     
        $edicaoPonto->fk_pontoorigem=$request->ponto;

        if (($request->saidaManha and $request->entradaTarde)!=null) {
            $almoco= Carbon::parse($request->entradaTarde)->diffInSeconds(Carbon::parse($request->saidaManha));
         $edicaoPonto->tempoAlmoco=  gmdate("H:i:s", $almoco);
        }
        if (($request->saidaManha and ($request->entradaManha or $ponto->entradaManha) )!=null) {
            $tempoTrabalhadoM= Carbon::parse($request->entradaManha)->diffInSeconds(Carbon::parse($request->saidaManha));
            $edicaoPonto->totalDia= gmdate("H:i:s", $tempoTrabalhadoM);
        }

        if (($request->saidaManha and $request->entradaTarde and $request->saidaTarde and $request->entradaManha)!=null) {
            $tempoTrabalhadoT= Carbon::parse($request->entradaTarde)->diffInSeconds(Carbon::parse($request->saidaTarde));
        $edicaoPonto->totalDia=Carbon::parse($tempoTrabalhadoM)->addSeconds($tempoTrabalhadoT)->format('H:i:s');
      
        }
        $edicaoPonto->ccuser =$request->Ponto_de;
  
        if($user[0]->subcontratado==0){
         $edicaoPonto->nifempresa= empresa::where('pk_empresa',$user[0]->fk_empresa)->value('NIF');
        }
        else {
         $edicaoPonto->nifempresa=$user[0]->nifEmpregador;
        }
        $edicaoPonto->dia=$ponto->data;

        $edicaoPonto->save();
    
        if ($user[0]->id==auth::id()) {
            $notificar= new notificacoes();
            $notificar->descricao='Ponto por aprovar de '. user::where('id',$user[0]->id)->value('name') ;
            $notificar->fk_tipoNotificacao=2;
            $notificar->fk_user=user::where('fk_departamento',3)->value('id');
        $notificar->save();


        // $log=new Logs;
        // $log->descricao='O utilizador editou o ponto';
        // $log->fk_user=auth::id();
        // $log->fk_tipoLog=5;
        // $log->save();
        return Redirect::to('/registod')->with('Success', 'Pedido de ponto registado, aguarda aprovação!')->with(['dia'=>  $request->dia, 'id'=> auth::id()]);   

        }
        else {
            return Redirect::to('/aprovarpontos')->with('Success', 'Pedido efetuado, aguarda aprovação')->withInput();
        }
       
    }
    else {
  
    

    $edicaoPonto = new edicaoponto();
    $edicaoPonto->tempoAlmoco='00:00:00';
    $edicaoPonto->totalDia='00:00:00';
  
     
        $edicaoPonto->entradaManha=null;
        if ($request->entradaManha!=null) {
        $edicaoPonto->entradaManhaNova=Carbon::parse($request->entradaManha)->format('H:i:s');
        }
        $edicaoPonto->saidaManha=null;
        if ($request->saidaManha!=null) {
            $edicaoPonto->saidaManhaNova=Carbon::parse($request->saidaManha)->format('H:i:s');
        }    
        $edicaoPonto->entradaTarde=null;
        if ($request->entradaTarde!=null) {
            $edicaoPonto->entradaTardeNova=Carbon::parse($request->entradaTarde)->format('H:i:s');
        }            
        $edicaoPonto->saidaTarde=null;
        if ($request->saidaTarde!=null) {
            $edicaoPonto->saidaTardeNova=Carbon::parse($request->saidaTarde)->format('H:i:s');
        }  
        $edicaoPonto->fk_tipo=5;

        if ($request->fk_justificacao==null) {
            $edicaoPonto->fk_justificacao=0;
        }else {
            $edicaoPonto->fk_justificacao=$request->fk_justificacao;
        }
     
        $edicaoPonto->fk_pontoorigem=null;
         $edicaoPonto->comentario=$request->comentario;

        if (($request->saidaManha and $request->entradaTarde)!=null) {
            $almoco= Carbon::parse($request->entradaTarde)->diffInSeconds(Carbon::parse($request->saidaManha));
         $edicaoPonto->tempoAlmoco=  gmdate("H:i:s", $almoco);
        }
        if (($request->saidaManha and $request->entradaManha )!=null) {
            $tempoTrabalhadoM= Carbon::parse($request->entradaManha)->diffInSeconds(Carbon::parse($request->saidaManha));
            $edicaoPonto->totalDia= gmdate("H:i:s", $tempoTrabalhadoM);
        }

        if (($request->saidaManha and $request->entradaTarde and $request->saidaTarde and $request->entradaManha)!=null) {
            $tempoTrabalhadoT= Carbon::parse($request->entradaTarde)->diffInSeconds(Carbon::parse($request->saidaTarde));
        $edicaoPonto->totalDia=Carbon::parse($tempoTrabalhadoM)->addSeconds($tempoTrabalhadoT)->format('H:i:s');
        }
        $edicaoPonto->ccuser =$request->Ponto_de;
  
        if($user[0]->subcontratado==0){
         $edicaoPonto->nifempresa= empresa::where('pk_empresa',$user[0]->fk_empresa)->value('NIF');
        }
        else {
         $edicaoPonto->nifempresa= $user[0]->nifEmpregador;
        }
        $edicaoPonto->dia=$request->dia;
        // return $edicaoPonto;
        $edicaoPonto->save();

        if ($user[0]->id==auth::id()) {
            $notificar= new notificacoes();
            $notificar->descricao='Ponto por aprovar de '. user::where('id',$user[0]->id)->value('name') ;
            $notificar->fk_tipoNotificacao=2;
            $notificar->fk_user=user::where('fk_departamento',3)->value('id');
        $notificar->save();

    //     $log=new Logs;
    // $log->descricao='O utilizador editou o ponto';
    // $log->fk_user=auth::id();
    // $log->fk_tipoLog=5;
    // $log->save();

         
    return Redirect::to('/registod')->with('Success', 'Pedido de ponto registado, aguarda aprovação!')->with(['dia'=>  $request->dia, 'id'=> auth::id()]);   

        }
        else {

            
            return Redirect::to('/aprovarpontos')->with('Success', 'Pedido efetuado, aguarda aprovação')->withInput();
        }


    }

    
}

public function mostrarregistorporaprovar()
    {  
        $registos = edicaoponto::where('estado',0)->orderBy('created_at')->get();
        return view('registo/registoseditar', compact('registos'));
    }
    public function mostrarregistohistorico()
    {  
        $registos = edicaoponto::where('estado',1)->orderBy('created_at')->get();
        return view('registo/registoseditar', compact('registos'));
    }

//log
public function aprovarponto(Request $request)
{
 
    $ponto = edicaoponto::find($request->aprovar);
    
    $user= userscomuns::where('BI',$ponto->ccuser)->get();
    $tecnico=user::where('bi',$ponto->ccuser)->get();

    if ($ponto->fk_pontoorigem!=null) {
        $registos = ponto::where('pk_ponto',$ponto->fk_pontoorigem)->get();
    } else {
        
      $registos= ponto::where('ccuser',$ponto->ccuser)->where('data', $ponto->dia)->get();
    }

   

    if (count($registos)>0) {
 
       
                $registo=ponto::find($registos[0]->pk_ponto);

                if ($ponto->entradaManhaNova!=null) {
                    
                    $registo->entradaManha=$ponto->entradaManhaNova;
                }

                if ($ponto->saidaManhaNova!=null) {
                    $registo->saidaManha=$ponto->saidaManhaNova;
                } 
                if ($ponto->entradaTardeNova!=null) {
                    $registo->entradaTarde=$ponto->entradaTardeNova;
                } 
                if ($ponto->saidaTardeNova!=null) {
                    $registo->saidaTarde=$ponto->saidaTardeNova;
                } 
                if ($ponto->comentario!=null) {
                $registo->comentario=$ponto->comentario;
                } 
                if ( $ponto->fk_justificacao!=null) {
                    $registo->fk_justificacao=$ponto->fk_justificacao;
                }
                if ($ponto->totalDia!='00:00:00' or $ponto->totalDia!=null ) {
                    $registo->totalDia=$ponto->totalDia;
                }
                if ($ponto->saidaManhaNova!=null and $ponto->entradaTardeNova==null) {
              
                    $task = new Task();
                    $task->text = 'Almoço' ;
                    $task->duration=1;
                    $task->progress=1;
                    $task->parent=0;
                    $task->tipo=4;
                    $task->start_date =  $task->horaInicioPrev = Carbon::parse($ponto->dia . $ponto->saidaManhaNova )->format('Y-m-d H:i:s');
                    $task->end_date = $task->horaFimPrev= Carbon::parse($task->start_date)->addHours(1)->format('Y-m-d H:i:s');
                    $task->fk_tecnico=$tecnico[0]->id;
                    $task->fk_estadoIntervencao = 2; 
                    $task->save();
                } 
                if (($ponto->tempoAlmoco!='00:00:00')) {
                    $registo->tempoAlmoco=$ponto->tempoAlmoco;
                     $task = Task::where('tipo',4)->where('fk_tecnico',$tecnico[0]->id)->where('start_date','like', $ponto->dia .' %')->get();
                    if (count($task)>0) {
                     
                        $task[0]->start_date = $task->horaInicioPrev= Carbon::parse($ponto->dia .$ponto->saidaManhaNova )->format('Y-m-d H:i:s');
                        $task[0]->end_date = $task->horaFimPrev= Carbon::parse($ponto->dia .$ponto->entradaTardeNova )->format('Y-m-d H:i:s');
                        $task[0]->fk_estadoIntervencao = 3; 
                        
                        // $task[0]->save();
                    } else {
                       
                        $task = new Task();
                        $task->text = 'Almoço' ;
                        $task->duration=1;
                        $task->progress=1;
                        $task->parent=0;
                        $task->tipo=4;
                        $task->start_date = $task->horaInicioPrev= Carbon::parse($ponto->dia .$ponto->saidaManhaNova )->format('Y-m-d H:i:s');
                        $task->end_date = $task->horaFimPrev= Carbon::parse($ponto->dia .$ponto->entradaTardeNova )->format('Y-m-d H:i:s');
                        $task->fk_tecnico=$tecnico[0]->id;
                        $task->fk_estadoIntervencao = 3; 
                        $task->save();

                    }
                    
                    

                }

               



                if (($registo->saidaManha and $registo->entradaManha )!=null) {
                    $tempoTrabalhadoM= Carbon::parse($registo->entradaManha)->diffInSeconds(Carbon::parse($registo->saidaManha));
                    $registo->totalDia= gmdate("H:i:s", $tempoTrabalhadoM); 
                }
        
                if (($registo->saidaManha and $registo->entradaTarde and $registo->saidaTarde and $registo->entradaManha)!=null) {
                    $tempoTrabalhadoM= Carbon::parse($registo->entradaManha)->diffInSeconds(Carbon::parse($registo->saidaManha));
                    $tempoTrabalhadoT= Carbon::parse($registo->entradaTarde)->diffInSeconds(Carbon::parse($registo->saidaTarde));
                    $registo->totalDia=Carbon::parse($tempoTrabalhadoM)->addSeconds($tempoTrabalhadoT)->format('H:i:s');
                }


                $aprovadopor= user::find(Auth::id());
                $registo->fk_tipo=5;
                
                $registo->save();
                $ponto->aprovadoPor=   $aprovadopor->name;
                $ponto->estado=   1;
                $ponto->save();

//log_feito
                // $log=new Logs;
                // $log->descricao='O utilizador aprovou o ponto';
                // $log->fk_user=auth::id();
                // $log->fk_tipoLog=2;
                // $log->save();

                return Redirect::to('/aprovarpontos')->with('Success', 'Registo Aprovado')->withInput();
                
    } else {

        
        $dia= Carbon::parse($ponto->dia);
        $registo = new ponto;
        $registo->dia =$dia->formatLocalized('%A %d de %B de %Y');
        $registo->data= $dia->formatLocalized('%Y-%m-%d');
        $registo->entradaManha= $ponto->entradaManhaNova;
        $registo->saidaManha=$ponto->saidaManhaNova;
        $registo->entradaTarde=$ponto->entradaTardeNova;
        $registo->saidaTarde=$ponto->saidaTardeNova;
        $registo->totalDia=$ponto->totalDia;
        $registo->tempoAlmoco=$ponto->tempoAlmoco;
        $registo->comentario=$ponto->comentario;
        $registo->fk_justificacao=$ponto->fk_justificacao;
        $registo->ccuser =$user[0]->BI;
        $registo->nifempresa= $user[0]->nifempresa;
        $registo->empresapicagem=empresa::where('visivel',1)->value('NIF');
        $aprovadopor= user::find(Auth::id());
        $registo->fk_tipo=5;
      
    
        $ponto->aprovadoPor=   $aprovadopor->name;
        $ponto->estado=1;

        $tecnico[0]->updated_at=Carbon::now()->format('Y-m-d H:m:s');
       
       
        $tecnico[0]->save();
    //   return $tecnico;
        $registo->save();
        $ponto->save();
        if ($ponto->saidaManhaNova!=null and $ponto->entradaTardeNova==null) {
                
            $task = new Task();
            $task->text = 'Almoço' ;
            $task->duration=1;
            $task->progress=1;
            $task->parent=0;
            $task->tipo=4;
            $task->start_date =  $task->horaInicioPrev = Carbon::parse($ponto->dia .$ponto->saidaManhaNova )->format('Y-m-d H:i:s');
            $task->end_date = $task->horaFimPrev= Carbon::parse($task->start_date)->addHours(1)->format('Y-m-d H:i:s');
            $task->fk_tecnico=$tecnico[0]->id;
            $task->fk_estadoIntervencao = 2; 
            $task->save();
        } 
        if ($ponto->tempoAlmoco!='00:00:00') {
            $registo->tempoAlmoco=$ponto->tempoAlmoco;
             $task = Task::where('tipo',4)->where('fk_tecnico',$tecnico[0]->id)->where('start_date','like', $ponto->dia .' %')->get();
            if (count($task)>0) {
             
                $task[0]->start_date = $task->horaInicioPrev= Carbon::parse($ponto->dia .$ponto->saidaManhaNova )->format('Y-m-d H:i:s');
                $task[0]->end_date = $task->horaFimPrev= Carbon::parse($ponto->dia .$ponto->entradaTardeNova )->format('Y-m-d H:i:s');
                $task[0]->fk_estadoIntervencao = 3; 
                
                // $task[0]->save();
            } else {
                // return 'b';
                $task = new Task();
                $task->text = 'Almoço' ;
                $task->duration=1;
                $task->progress=1;
                $task->parent=0;
                $task->tipo=4;
                $task->start_date = $task->horaInicioPrev= Carbon::parse($ponto->dia .$ponto->saidaManhaNova )->format('Y-m-d H:i:s');
                $task->end_date = $task->horaFimPrev= Carbon::parse($ponto->dia .$ponto->entradaTardeNova )->format('Y-m-d H:i:s');
                $task->fk_tecnico=$tecnico[0]->id;
                $task->fk_estadoIntervencao = 3; 
            
                $task->save();

            }
        }}

    //log_feito
    // $log=new Logs;
    // $log->descricao='O utilizador aprovou o ponto';
    // $log->fk_user=auth::id();
    // $log->fk_tipoLog=2;
    // $log->save();


    return Redirect::to('/aprovarpontos')->with('Success', 'Registo Aprovado')->withInput();
}
//log
public function reprovarponto(Request $request)
{  
    $user= user::find(Auth::id());
    $ponto = edicaoponto::find($request->reprovar);
  $ponto->estado=   2;
  $ponto->aprovadoPor=   $user->name;
  $ponto->save();

  //log_feito
    // $log=new Logs;
    // $log->descricao='O utilizador reprovou o ponto';
    // $log->fk_user=auth::id();
    // $log->fk_tipoLog=3;
    // $log->save();

  return Redirect::to('/aprovarpontos')->with('Success', 'Registo Aprovado')->withInput();
   
}


public function mostrarpontomensal(Request $request){ 

    if($request->id==null){
 
    
      $start= Carbon::parse(date('Y-m').'-01');
      $end= Carbon::parse(date('Y-m-d'));
        $user= user::find(Auth::id());
     }
    else {
        $start= Carbon::parse($request->inicio);
        $end= Carbon::parse($request->fim);
        $user= user::find($request->id);
    }
 
    $diference= $start->diffInDays($end);
    $ponto = ponto::where('ccuser', $user->bi)->whereBetween('data',[$start,$end])->get();
        $faltas= ponto::where('ccuser', $user->bi)->whereBetween('data',[$start,$end])->where('fk_tipo',6)->get();
    $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
        return $date->isWeekend();
    }, $end);
        
    $diasparagem= count(paragem::whereBetween('dia',[$start,$end])->get());

  return view('registo/mostrarpontomensal', compact('ponto','user','diference','start','end','diasFds','faltas','diasparagem'));
}
    
public function editarresgistos(){ 
    $users = user::where('id','>',1)->get(); 
    return view('registo/mostrareditarpontouser', compact('users'));
}






public function pontoedicao(Request $request){ 
   
    $data=$request->dia;

    $user= user::find($request->id);


   
       $cargo = cargo::where('pk_cargo',$user->fk_cargo)->value('descricao');
       $departamento = departamento::where('pk_departamento',$user->fk_departamento)->value('descricao');
       if($user->subcontratado==0){
           $ponto= ponto::where('ccuser',$user->bi)->where('data',$data )->where('nifempresa',empresa::where('pk_empresa',$user->fk_empresa)->value('NIF'))->get();
          }
          else {
             
           $ponto= ponto::where('ccuser',$user->bi)->where('data',  $data)->get();           
          }
          $contagemponto= count($ponto);
         
           $justificacoes = DB::connection('geraltg')->table('justificacoes')->pluck('descricao','pk_justificacao');
       return view('registo/editar_registo',compact('user','ponto','justificacoes','cargo','departamento','contagemponto','data'));

}


public function consultarregistodiario()
{ 
    $users = user::where('id','>',1)->where('visivel',1)->get();
  
    return view('registo/mostrarregistodiario', compact('users'));

}
public function relatorioponto()
{ 
    $users = user::where('id','>',1)->get();
  
    return view('registo/mostrarrelatoriopontousers', compact('users'));

}

//log
public function processar(Request $request){
  
    if($request->user_id==null){
 
    
        $start= Carbon::parse(date('Y-m').'-01');
        $end= Carbon::parse(date('Y-m-d'));
          $user= user::find(Auth::id());
       }
      else {
          $start= Carbon::parse($request->start);
          $end= Carbon::parse($request->end);
          $user= user::find($request->user_id);
      }
     

        $diference= $start->diffInDays($end);
        $faltas= ponto::where('ccuser', $user->bi)->whereBetween('data',[$start,$end])->where('fk_tipo',6)->get();
        $ponto = ponto::where('ccuser', $user->bi)->whereBetween('data',[$start,$end])->get();
                $diacomjustificacao=[];
        $falta=[];
        $diastrabalhados=0;
        $ferias=0;
        $faltasCRet=0;
        $faltasSRet=0;
        $subsidioAlimentacao=0;
        $faltas=[];
        $feriasDia=[];

        for ($i=0; $i <count($ponto) ; $i++) { 
        if($ponto[$i]->fk_justificacao>0){
            $diacomjustificacao[$i]=$ponto[$i];
            $justificacoes[$i] = DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[$i]->fk_justificacao)->value('comRetribuicao');

            if ($justificacoes[$i]>0) {
                if ($ponto[$i]->fk_justificacao==13) {
                    $feriasDia[$i]=$ponto[$i]->data.' , ';
                    $ferias++;
                    
                }elseif ($ponto[$i]->fk_justificacao<13  ) {
                    $faltasCRet++;
                }
            }elseif($ponto[$i]->fk_justificacao<13 and   $justificacoes[$i]==0){
                $faltasSRet++;
        
            }
            //    falta ver dias sem retibuiçao
        }elseif($ponto[$i]->fk_tipo==6){
            $falta[$i]=$ponto[$i]->data .' , ';
        }else{
            $diastrabalhados++;
        }

        //   return $ponto[$i]->totalDia;
        $totaldia=carbon::parse($ponto[$i]->totalDia)->diffInSeconds(Carbon::parse('00:00:00'));
        $valordescontosubsidio=carbon::parse('04:00:00')->diffInSeconds(Carbon::parse('00:00:00'));
        if ($totaldia>$valordescontosubsidio) {
            $subsidioAlimentacao++;
            
        }elseif($totaldia>10) {
        
            $subsidioAlimentacao--;
        }



        }
        // return $faltasSRet;return
        // return
        $diasparagem= count(paragem::whereBetween('dia',[$start,$end])->get());
        $primeiroDia=carbon::parse($end)->format('Y-m'.'-1');
        $ultimoDia=carbon::parse(carbon::parse($end)->format('Y-m').'-'.cal_days_in_month(CAL_GREGORIAN,  carbon::parse($end)->format('m'), carbon::parse($end)->format('Y')))->format('Y-m-d');
         $diasParagemMes=count(paragem::whereBetween('dia',[$primeiroDia,$ultimoDia])->get());
        // return 'Trabalhador: '.$user->name .'  Faltas com ret'.   $faltasCRet. ' dias de ferias'. $ferias. ' faltas: ' . count($falta) .
        //  ' dias trabalhados: '. $diastrabalhados. ' Subsidio alimentaçao '. $subsidioAlimentacao . 
        // ' Dias Uteis:'. (
        // count($ponto)
        // -$diasparagem);

        $processado=Processamentos::where('userBi',$user->bi)->where('mes',$end->formatLocalized('%B %Y'))->get();
        $diasuteilsnew=0;
        for ($i=1; $i <=cal_days_in_month(CAL_GREGORIAN,  carbon::parse($end)->format('m'), carbon::parse($end)->format('Y')) ; $i++) { 
            $dt=carbon::parse(carbon::parse($end)->format('Y-m').'-'.$i);
            if($dt->isWeekday()==1){
                $diasuteilsnew++;

            }
        }
       
         $diasUteis= $diasuteilsnew - $diasParagemMes;# ferias mandatárias são dias de paragem???ver com RH
        if (count($processado)==0) {
            $processar= new Processamentos;
            $processar->userBi=$user->bi;
            $processar->nome=$user->name;
            $processar->nifEmpresa=$user->nifEmpregador;
            $processar->intervaloProcessamento='De:'.$start .' a: '.$end;
            $processar->mes=$end->formatLocalized('%B %Y');
            $processar->diasTrabalhados=$diastrabalhados;
            $processar->diasUteis= $diasUteis;
            $processar->ferias=$ferias;
            $processar->diasSubsidioAlimentacao=$subsidioAlimentacao;
            $processar->diasFaltasInjustificadas=count($falta);
            $processar->diasFaltasComRetribuicao=$faltasCRet;
            $processar->diasFaltasSemRetribuicao=$faltasSRet;
            if (sizeof($feriasDia)>0) {
                $processar->observacoes= 'Férias: '.implode("",$feriasDia);
            }
            if (sizeof($falta)>0) {
                $processar->observacoes= $processar->observacoes.'Faltas:: '.implode("",$falta);
            }
    
    // //    $processar->observacoes= return array('Faltas:'. implode("",$falta) . 'Férias: '.implode("",
    //     $feriasDia));
            $processar->save();
        }else{
            $apagar=Processamentos::find($processado[0]->pk_processamento);
            $apagar->delete();
            $processar= new Processamentos;
            $processar->userBi=$user->bi;
            $processar->nome=$user->name;
            $processar->nifEmpresa=$user->nifEmpregador;
            $processar->intervaloProcessamento='De:'.$start .' a: '.$end;
            $processar->mes=$end->formatLocalized('%B %Y');
            $processar->diasTrabalhados=$diastrabalhados;
            $processar->diasUteis= $diasUteis;
            $processar->ferias=$ferias;
            $processar->diasSubsidioAlimentacao=$subsidioAlimentacao;
            $processar->diasFaltasInjustificadas=count($falta);
            $processar->diasFaltasComRetribuicao=$faltasCRet;
            $processar->diasFaltasSemRetribuicao=$faltasSRet;
            if (sizeof($feriasDia)>0) {
                $processar->observacoes= 'Férias: '.implode("",$feriasDia);
            }
            if (sizeof($falta)>0) {
                $processar->observacoes= $processar->observacoes.'Faltas: '.implode("",$falta);
            }
       
            $processar->save();
        
        }

    $diasuteis=$diasUteis;
    $faltasjustificadas=$faltasCRet+$faltasSRet;
    $faltasinjustificadas= count($falta);
    $alimentacao=$subsidioAlimentacao;
    $mes=$end->formatLocalized('%B %Y');
    $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
        return $date->isWeekend();
    }, $end);
    

//log_feito
// $log=new Logs;
// $log->descricao='O utilizador processou o pdf';
// $log->fk_user=auth::id();
// $log->fk_tipoLog=4;
// $log->save();


    $pdf = PDF::loadView('registo/mostrarpontomensalpdf' ,compact('ponto','mes','diasuteis','ferias','faltasinjustificadas','alimentacao','faltasjustificadas','diastrabalhados','user','diference','start','end','diasFds','diasparagem','faltas'))->setPaper('a4', 'portrait');
    return $pdf->stream();
}
//log processamento pdf 
public function processar2(Request $request){

    $processamento=Processamentos::find($request->id);

    
    $user=user::where('bi',$processamento->userBi)->get();
    $user=user::find($user[0]->id);
        $processamento->intervaloProcessamento; 
            $data=explode('a:', $processamento->intervaloProcessamento);
        $dataDe= explode('De:', $data[0]);
                $start= Carbon::parse($dataDe[1]);
                $end= Carbon::parse($data[1]);
        
            
     

   $diference= $start->diffInDays($end);
   $faltas= ponto::where('ccuser', $processamento->userBi)->whereBetween('data',[$start,$end])->where('fk_tipo',6)->get();
  $ponto = ponto::where('ccuser', $processamento->userBi)->whereBetween('data',[$start,$end])->get();
        $diacomjustificacao=[];
        $falta=[];
        $diastrabalhados=0;
        $ferias=0;
        $faltasCRet=0;
        $faltasSRet=0;
        $subsidioAlimentacao=0;
        $faltas=[];

        for ($i=0; $i <count($ponto) ; $i++) { 
        if($ponto[$i]->fk_justificacao>0){
            $diacomjustificacao[$i]=$ponto[$i];
            $justificacoes[$i] = DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[$i]->fk_justificacao)->value('comRetribuicao');

            if ($justificacoes[$i]>0) {
                if ($ponto[$i]->fk_justificacao==13) {
                    $ferias++;
                    
                }elseif ($ponto[$i]->fk_justificacao<13  ) {
                    $faltasCRet++;
                }
            }elseif($ponto[$i]->fk_justificacao<13 and   $justificacoes[$i]==0){
                $faltasSRet++;
        
            }
            //    falta ver dias sem retibuiçao
        }elseif($ponto[$i]->fk_tipo==6){
            $falta[$i]=$ponto[$i]->data;
        }else{
            $diastrabalhados++;
        }

        //   return $ponto[$i]->totalDia;
        $totaldia=carbon::parse($ponto[$i]->totalDia)->diffInSeconds(Carbon::parse('00:00:00'));
        $valordescontosubsidio=carbon::parse('04:00:00')->diffInSeconds(Carbon::parse('00:00:00'));
        if ($totaldia>$valordescontosubsidio) {
            $subsidioAlimentacao++;
            
        }elseif($totaldia>10) {
        
            $subsidioAlimentacao--;
        }



        }
   
        $diasparagem= count(paragem::whereBetween('dia',[$start,$end])->get());
        $primeiroDia=carbon::parse($end)->format('Y-m'.'-1');
        $ultimoDia=carbon::parse(carbon::parse($end)->format('Y-m').'-'.cal_days_in_month(CAL_GREGORIAN,  carbon::parse($end)->format('m'), carbon::parse($end)->format('Y')))->format('Y-m-d');
         $diasParagemMes=count(paragem::whereBetween('dia',[$primeiroDia,$ultimoDia])->get());
      

        $processado=Processamentos::where('userBi',$user->bi)->where('mes',$end->formatLocalized('%B %Y'))->get();
        $diasuteilsnew=0;
        for ($i=1; $i <=cal_days_in_month(CAL_GREGORIAN,  carbon::parse($end)->format('m'), carbon::parse($end)->format('Y')) ; $i++) { 
            $dt=carbon::parse(carbon::parse($end)->format('Y-m').'-'.$i);
            if($dt->isWeekday()==1){
                $diasuteilsnew++;

            }
        }
         $diasUteis= $diasuteilsnew - $diasParagemMes;# ferias mandatárias são dias de paragem???ver com RH

        $processado=Processamentos::where('userBi',$processamento->userBi)->where('mes',$end->formatLocalized('%B %Y'))->get();

        if (count($processado)==0) {
            // $processar= new Processamentos;
            // $processar->userBi=$user->bi;
            // $processar->nome=$user->name;
            // $processar->nifEmpresa=$user->nifEmpregador;
            // $processar->intervaloProcessamento='De:'.$start .' a: '.$end;
            // $processar->mes=$end->formatLocalized('%B ');
            // $processar->diasTrabalhados=$diastrabalhados;
            // $processar->diasUteis= (count($ponto)-$diasparagem);
            // $processar->ferias=$ferias;
            // $processar->diasSubsidioAlimentacao=$subsidioAlimentacao;
            // $processar->diasFaltasInjustificadas=count($falta);
            // $processar->diasFaltasComRetribuicao=$faltasCRet;
            // $processar->diasFaltasSemRetribuicao=$faltasSRet;
            // $processar->save();
        }else{
            // $apagar=Processamentos::find($processado[0]->pk_processamento);
            // $apagar->delete();
            // $processar= new Processamentos;
            // $processar->userBi=$user->bi;
            // $processar->nome=$user->name;
            // $processar->nifEmpresa=$user->nifEmpregador;
            // $processar->intervaloProcessamento='De:'.$start .' a: '.$end;
            // $processar->mes=$end->formatLocalized('%B ');
            // $processar->diasTrabalhados=$diastrabalhados;
            // $processar->diasUteis= (count($ponto)-$diasparagem);
            // $processar->ferias=$ferias;
            // $processar->diasSubsidioAlimentacao=$subsidioAlimentacao;
            // $processar->diasFaltasInjustificadas=count($falta);
            // $processar->diasFaltasComRetribuicao=$faltasCRet;
            // $processar->diasFaltasSemRetribuicao=$faltasSRet;
            // // return $processar;
            // $processar->save();
        
        }

    
    $diasuteis=$diasUteis;
    $faltasjustificadas=$faltasCRet+$faltasSRet;
    $faltasinjustificadas= count($falta);
    $alimentacao=$subsidioAlimentacao;
    $mes=$end->formatLocalized('%B %Y');
    $diasFds = $start->diffInDaysFiltered(function(Carbon $date) {
        return $date->isWeekend();
    }, $end);
    
    // //log_feito
    // $log=new Logs;
    // $log->descricao='O utilizador processou o pdf';
    // $log->fk_user=auth::id();
    // $log->fk_tipoLog=4;
    // $log->save();

    $pdf = PDF::loadView('registo/mostrarpontomensalpdf' ,compact('ponto','mes','diasuteis','ferias','faltasinjustificadas','alimentacao','faltasjustificadas','diastrabalhados','user','diference','start','end','diasFds','diasparagem','faltas'))->setPaper('a4', 'landscape');
    return $pdf->stream();
}


public function entrar(){
    $empresa=empresa::get();
    return view('registo/pin',compact('empresa'));
}

public function picar(Request $request){
    
    $validator =  Validator::make($request->all(), [
        'pin' => 'required|max:4|min:4',
        
    ]);
    if($validator->fails()){
      
        return Redirect::to('/picar')->with( 'pin','Atenção: O Pin não tem o tamanho correto')->withInput();
    }
    // verificacao de ip
    if(
        request()->ip() == '195.23.35.164' || request()->ip() == gethostbyname('globalseven.ddns.net')||  request()->ip() == '127.0.0.1' ){



    $userid=user::where('pin',$request->pin)->get();

    if (count($userid)==0) {
        return Redirect::to('/picar')->with( 'pin','Atenção: Pin errado')->withInput();
    }else 
    {
        $user=user::find($userid[0]->id);
        $ponto = ponto::where('ccuser',$user->bi)->where('data', date('Y-m-d'))->get();
        if (count($ponto)==0) {
           
            $hoje= new Carbon();
            $ponto = new ponto;
      
            $ponto->dia =$hoje->formatLocalized('%A %d de %B de %Y');
            $ponto->data= $hoje->formatLocalized('%Y-%m-%d');
            $ponto->entradaManha= $hoje->isoFormat('H:mm:ss');
            $ponto->saidaManha=null;
            $ponto->entradaTarde=null;
            $ponto->saidaTarde=null;
            $ponto->totalDia=0;
            $ponto->tempoAlmoco=0;
            $ponto->comentario=null;
            $ponto->empresapicagem=empresa::where('visivel',1)->value('NIF');
            $ponto->fk_justificacao=0;
            $ponto->ccuser =$user->bi;
        
             if($user->subcontratado==0){
              $ponto->nifempresa= empresa::where('pk_empresa',$user->fk_empresa)->value('NIF');
             }
             else {
              $ponto->nifempresa= $user->nifEmpregador;
             }
           $user->status=1;
           $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
           $user->save();
            $ponto->fk_tipo = 1;
            $ponto->save();

        return Redirect::to('/picar')->with( 'success',' Bom dia '.$user->name)->withInput();
        } 
        else {
           if ($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha==null and $ponto[0]->entradaTarde==null and $ponto[0]->saidaTarde==null) {



                $taskEmAndamento= task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',2)->get(); 
                $aa= count($taskEmAndamento);
                if ($aa>0) {
                    
                    return Redirect::to('/picar')->with('pin', 'Primeiro termine ou pause a tarefa '.$taskEmAndamento[0]->text.' que está em curso! ')->withInput();
                }
                
                
                    $hoje= new Carbon();
                    $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
                    $tempotrabalhado= Carbon::parse($findponto[0]->entradaManha)->diffInSeconds(Carbon::now());
                    $ponto= ponto::find($findponto[0]->pk_ponto);
                    $ponto->totalDia=gmdate("H:i:s", $tempotrabalhado);
                    $ponto->saidaManha= $hoje->isoFormat('H:mm:ss');
                    $ponto->fk_tipo = 2;
                    $user->status=0;
                    $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
                    $user->save();
                    $ponto->save();
                    return Redirect::to('/picar')->with( 'success',' Bom Almoço '.$user->name)->withInput(); 
           }
   
           elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde==null and $ponto[0]->saidaTarde==null) { 
           
            $hoje= new Carbon();
            $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
            $ponto= ponto::find($findponto[0]->pk_ponto);
            $tempoAlmoco= Carbon::parse($findponto[0]->saidaManha)->diffInSeconds(Carbon::now());
            $ponto->entradaTarde= $hoje->isoFormat('H:mm:ss');
            $ponto->tempoAlmoco=gmdate("H:i:s", $tempoAlmoco);
            $ponto->fk_tipo = 3;
            $ponto->save();
            $user->status=1;
            $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
            $user->save();
           
           
            return Redirect::to('/picar')->with( 'success',' Bem vindo de volta  '.$user->name .'! Tempo de Almoço : '. $ponto->tempoAlmoco)->withInput(); 
           }


           
           elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde==null)  {
            $taskEmAndamento= task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',2)->get(); 
            $aa= count($taskEmAndamento);
           if ($aa>0) {
            return Redirect::to('/picar')->with('pin', 'Primeiro termine ou pause a tarefa '.$taskEmAndamento[0]->text.' que está em curso! ')->withInput();
           }
    
             $hoje= new Carbon();
            
             $findponto= ponto::where('ccuser',$user->bi)->where('data',  date('Y-m-d'))->get();
    
             $tarde= Carbon::parse($findponto[0]->entradaTarde)->diffInSeconds(Carbon::now());
             $manha= Carbon::parse($findponto[0]->totalDia)->diffInSeconds(Carbon::parse('00:00:00'));
             $tempotrabalhado= $manha+$tarde;
             $ponto= ponto::find($findponto[0]->pk_ponto);
             $ponto->totalDia=gmdate("H:i:s", $tempotrabalhado);
             $ponto->saidaTarde= $hoje->isoFormat('H:mm:ss');
             $ponto->fk_tipo = 4;
             $ponto->save();
             $user->status=0;
             $user->updated_at=Carbon::now()->format('Y-m-d H:m:s');
             $user->save();
      
           
            return Redirect::to('/picar')->with( 'success',' Obrigado pela sua colaboração  '.$user->name .'! Tempo de Trabalhado : '.$ponto->totalDia)->withInput(); 
           }
           elseif($ponto[0]->entradaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->saidaManha!=null and $ponto[0]->entradaTarde!=null and $ponto[0]->saidaTarde!=null)  {
            return Redirect::to('/picar')->with( 'success',' Trabalhou tudo por hoje:  '.$user->name .'! ')->withInput(); 

        }
        }
        
        
    
    }
    
    }else {
        return Redirect::to('/picar')->with( 'pin','Picagem Inválida: fora da zona de trabalho. ')->withInput(); 

    }

}


public function mostrarProcessar(){

     $processar=Processamentos::orderby('intervaloProcessamento')->get();
     
     $mes=Processamentos::distinct()->pluck('mes','mes');

     return view('registo/processamento', compact('processar','mes'));

}

public function processarmensal(Request $request){
    
    $processar=Processamentos::where('mes','like',$request->mes)->orderby('nifEmpresa')->get();
   
    $pdf = PDF::loadView('registo/resumoprocessamentopdf' ,compact('processar'));
    // ->setPaper('a4', 'landscape');
    return $pdf->stream();
}

}
