<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\User;
use Khill\Lavacharts\Lavacharts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Projeto;
use App\Departamento;
use App\Cargo;
use App\Empresa;
use App\Link;
use App\ProjDep;
use App\Event;
use DB;
use App\Cliente;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Session;

 
class TasksController extends Controller
{
  public function newTaskProjetoAjax() {
    
      $user=user::where('id',auth::id())->get();
      $pk_cliente = request()->input('pk_cliente');
      $projeto = Projeto::WhereIn('fk_estadoproj',array(1,3))->leftjoin('projdeps','pk_projeto','fk_projeto')->where('fk_departamento',$user[0]->fk_departamento)->where('fk_cliente', '=', $pk_cliente)->get();
      
      return response()->json($projeto);

  }
  public function newTaskEtapasAjax() {
      $user=user::where('id',auth::id())->get();

      $pk_task = request()->input('pk_projeto');
      $task = task::where('tipo',1)->where('fechado',0)->where('fk_departamento',$user[0]->fk_departamento)->where('fk_projeto', '=', $pk_task)->get();
      return response()->json($task);

  }

  public function newTaskUsersAjax() {   
    $pk_task=request()->input('pk_projeto');
      $users=user::where('users.visivel',1)->where('users.id','!=', auth::id())->leftjoin('projdeps','projdeps.fk_departamento','users.fk_departamento')->where('fk_projeto',$pk_task)->get();
      return response()->json($users);
  }
  public function editarTarefa(request $request){   
    $task = Task::find($request->id); 
    $etapa=Task::find($task->parent);
    $projeto= projeto::where('pk_projeto',$task->fk_projeto)->leftjoin('clientes','fk_cliente','pk_cliente')->get();
     $estadointervencao= DB::table('estadointervencoes')->pluck('descricao','pk_estadoIntervencoes');
   
   $tecnico=user::find($task->fk_tecnico);
      return view('editar/tarefa', compact('task','estadointervencao','tecnico','projeto','etapa'));
  }
  public function updateTarefa(Request $request){
    
    $taskantiga = Task::find($request->id_task); 
    $projeto= Projeto::find($request->fk_projeto);
    $projeto->custoReal=$projeto->custoReal-$taskantiga->custoReal;
    $segundosduracao= Carbon::parse($taskantiga->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'));
    $projeto->horasGastas=$projeto->horasGastas-$segundosduracao;
    $projeto->save();

    $etapa=Task::find($request->fk_etapa);
    $etapa->custoReal=$etapa->custoReal-$taskantiga->custoReal;
    $etapa->duracaoHorasReal=Carbon::parse(  Carbon::parse($etapa->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'))-$segundosduracao)->format('H:i:s');
    $etapa->save();

    $task= Task::find($request->id_task); 
    $task->text = "Tarefa: ". $request->descricao;
    $task->start_date =$task->horaInicioPrev= $request->diaInicio. ' '.$request->horaInicio.':00';
    $task->end_date =  $task->horaFimPrev= $request->diaFim. ' '.$request->horaFim.':00';
    $segundosduracao= Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->horaFimPrev));
    $task->duration = intval($segundosduracao/3600);
    $custoHora=user::where('id',$task->fk_tecnico)->value('custoHora')/3600;
    $task->duracaoHorasEstimado=Carbon::parse($segundosduracao)->format('H:i:s');
    $task->custoPrevisto= $custoHora* $segundosduracao;
    $task->relatorio=$request->relatorio;
    $task->save();
    return Redirect::to('/registo')->with('Success', 'Tarefa editada ')->withInput();

  }

    public function store(Request $request){
    
        $task = new Task();
        $infopai=task::where('id',$request->parent)->value('tipo');
            if($infopai==0){
                $task->tipo = 1;   
                $task->fk_estadoIntervencao = null; 
                $task->color = "#eb4e4e";   
                $task->text = "Sprint: " .$request->text;
            }
            if($infopai==1){
                $task->tipo = 2;  
                 $task->fk_estadoIntervencao = 1; 
                 $task->color = "#40a431";   
                 $task->text = "Tarefa: ". $request->text;
            }

            if ($task->tipo==2) {
             
              if (Carbon::parse($request->start_date)->format('Y-m-d')!=Carbon::parse($request->end_date)->format('Y-m-d')) {
                      $task->start_date = $task->horaInicioPrev =  $request->start_date;
                      $task->end_date =$task->horaFimPrev = Carbon::parse($request->start_date)->format('Y-m-d'). ' '.Carbon::parse($request->end_date)->format('H:i:s');
                      $task->duration = Carbon::parse($task->start_date)->diffInHours(Carbon::parse($task->end_date));
              }
     
          
            }else {
              $task->duration = Carbon::parse($request->start_date)->diffInHours(Carbon::parse($request->end_date));
              $task->start_date = $task->horaInicioPrev =  $request->start_date;
              $task->end_date =$task->horaFimPrev = $request->end_date;
            }
            
        
        //  return response()->json([
        //   $task 
        //     ]);
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;      
        //    calcular custos previstos    
 
        $segundosduracao= Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->end_date));
        $custoHora=user::where('id',$request->fk_tecnico)->value('custoHora')/3600;
        $task->duracaoHorasEstimado=Carbon::parse($segundosduracao)->format('H:i:s');
        $task->custoPrevisto= $custoHora* $segundosduracao;
        $task->textColor = null;    
         $task->fk_tecnico = $request->fk_tecnico;
         $task->fk_departamento = $request->fk_departamento;
      
        $task->fk_projeto =(int) filter_var(URL::previous(), FILTER_SANITIZE_NUMBER_INT);
        
         
                  
         $task->save();

        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id,
        ]);
    }
 
    public function update($id, Request $request){
        //   return response()->json([
        //     $request->start_date

        // ]);
        $task = Task::find($id); 
        $task->text = $request->text;
        if ($task->tipo==2) {
             
          if (Carbon::parse($request->start_date)->format('Y-m-d')!=Carbon::parse($request->end_date)->format('Y-m-d')) {
                  $task->start_date = $task->horaInicioPrev =  $request->start_date;
                  $task->end_date =$task->horaFimPrev = Carbon::parse($request->start_date)->format('Y-m-d'). ' '.Carbon::parse($request->end_date)->format('H:i:s');
                  $task->duration = Carbon::parse($task->start_date)->diffInHours(Carbon::parse($task->end_date));
          }
 
      
        }else {
          $task->duration = Carbon::parse($request->start_date)->diffInHours(Carbon::parse($request->end_date));
          $task->start_date = $task->horaInicioPrev =  $request->start_date;
          $task->end_date =$task->horaFimPrev = $request->end_date;
        }
        $task->textColor = $request->textColor;    
        $task->color = $request->color;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
        $task->fk_tecnico = $request->fk_tecnico;
        if ($task->progress=1.00) {
          $task->fechado = 1;
        }    
        $segundosduracao= Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->horaFimPrev));
        $custoHora=user::where('id',$request->fk_tecnico)->value('custoHora')/3600;
        $task->custoPrevisto= $custoHora* $segundosduracao;
        $task->duracaoHorasEstimado=Carbon::parse($segundosduracao)->format('H:i:s');
        $task->save();
 
        return response()->json([
            "action"=> "updated",
           
        ]);
    }
 
    public function destroy($id){
        $task = Task::find($id);
        $task->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }

    // manipulaçao de tasks 

    public function starttarefa(Request $request) {
      $task =  task::find($request->id); 
      $status=user::where('id',Auth::id())->get();
      if(carbon::parse($task->start_date)->format('Y-m-d')!=carbon::parse($status[0]->updated_at)->format('Y-m-d') or $status[0]->status==0){   
       
        return Redirect::to('/registo')->with('Warning', 'Impossível iniciar a tarefa: O utilizador não está no ativo! Verifique a sua picagem!')->withInput();
      }
      $taskEmAndamento= task::where('fk_tecnico',Auth::id())->where('fk_estadoIntervencao',2)->where('tipo',2)->get(); 
       $aa= count($taskEmAndamento);
      if ($aa>0) {
        return Redirect::to('/registo')->with('Warning', 'Impossível iniciar a tarefa. A '.$taskEmAndamento[0]->text.' iniciada a: '.$taskEmAndamento[0]->start_date.' está em curso.! ')->withInput();
      }
   
      
        if ($task->fk_tecnico!=auth::id()) {
          return Redirect::to('/registo')->with('Warning', 'Impossível iniciar a tarefa de outra pessoa! ')->withInput();
        }

        if ($task->origem!=null) {
            $pai =task::find($task->origem); 
            $pai->fk_estadoIntervencao =3;  
            $pai->save();
        }

            $estadoProjeto= projeto::where('pk_projeto',$task->fk_projeto)->value('fk_estadoProj');
          if($estadoProjeto==2){
            return Redirect::to('/registo')->with('Danger', 'Tarefa não iniciada! O Projeto está no estado: '.DB::table('estadoprojetos')->where('pk_estadoProjeto',$estadoProjeto)->value('descricaoEstado'))->withInput();
          }
          elseif($estadoProjeto==4){ 
            return Redirect::to('/registo')->with('Danger', 'Tarefa não iniciada! O Projeto está no estado: '.DB::table('estadoprojetos')->where('pk_estadoProjeto',$estadoProjeto)->value('descricaoEstado'))->withInput();

          }
            $task->fk_estadoIntervencao =2;  
            $task->start_date=Carbon::now()->format('Y-m-d H:i:s');
              $task->horaInicio =Carbon::now()->format('Y-m-d H:i:s');
            $task->save();


        return Redirect::to('/registo')->with('Success', 'Tarefa Iniciada!')->withInput();
    }

    public function reiniciartarefa(Request $request)  {
       $taskEmAndamento= task::where('fk_tecnico',Auth::id())->where('fk_estadoIntervencao',2)->where('start_date','like',Carbon::now()->format('Y-m-d').'%')->get(); 
        $aa= count($taskEmAndamento);
        if ($aa>0) {
          return Redirect::to('/registo')->with('Warning', 'Impossível iniciar a tarefa. A '.$taskEmAndamento[0]->text.' está em curso.! ')->withInput();
        }
       $pai =  task::find($request->id); 
      

          $task = new Task();
          if(strrpos($pai->text,'(Continuação)'))
          {
        
       $str= substr($pai->text, strrpos($pai->text,'(Continuação)'));
         if ((int) filter_var(($str), FILTER_SANITIZE_NUMBER_INT)) {
             
             $num= (int) filter_var(($str), FILTER_SANITIZE_NUMBER_INT);
             $str= substr($pai->text, strpos($pai->text,'(Continuação)'));
           $texto=  strstr($pai->text, '(Continuação)', true). str_replace($num, $num+1, $str);
         }else {
             $texto= $pai->text. '#1';
         }
 
 
        }else {
          $texto= $pai->text. '(Continuação)';
        }
        $task->text=$texto;
  
    
      $task->duration = 1;
      $task->progress = $request->has("progress") ? $request->progress : 0;
      $task->start_date=Carbon::now()->format('Y-m-d H:i:s');
      $task->parent = $pai->parent;   
      $task->tipo=2;
      $task->textColor = null; 
      $task->color = '#40a431'; 
      $task->horaInicioPrev = Carbon::now()->format('Y-m-d H:i:s');
      $task->end_date = null;
      $task->horaInicio =Carbon::now()->format('Y-m-d H:i:s');   
      $duracaoprev=(Carbon::parse($pai->horaInicioPrev)->diffInSeconds(Carbon::parse($pai->horaFimPrev)));
      $realizado= $duracaoprev*$pai->progress;
      $emfaltaPrev=$duracaoprev-$realizado;
      $task->horaFimPrev = Carbon::now()->addSeconds($emfaltaPrev)->format('Y-m-d H:i:s');
      $task->end_date = null;   
      $task->duracaoHorasReal = 0;  
      $task->duracaoHorasEstimado =  gmdate("H:i:s",$emfaltaPrev);
      $custoHora=user::where('id',$task->fk_tecnico)->value('custoHora')/3600;
      $task->custoPrevisto= $custoHora* $emfaltaPrev;
    
      $task->custoReal = 0;
      $task->fk_tecnico = $pai->fk_tecnico;
      $task->fk_projeto = $pai->fk_projeto;
      $task->fk_estadoIntervencao =2; 
      $task->origem=$pai->id;  
      $task->save();
      $pai ->fk_estadoIntervencao =3;  
      $pai->save();

          $link= new Link();
          $link->type=0;
          $link->source=$pai->id;
          $link->target=$task->id;
          $link->save();
 
    
   


     

        return Redirect::to('/registo')->with('Success', 'Tarefa Reiniciada!')->withInput();
    }

    public function prereagendartask(Request $request){
  
        $task =  task::where('id',$request->id)->get();
       
        return view('criar/reagendar',compact('task'));
    }

    public function reagendartask(Request $request) {
  
        $task =  task::find($request->id);
        $start_date=$request->date. ' '. $request->time.':00';
        $segundosduracao=(Carbon::parse($task->start_date)->diffInSeconds(Carbon::parse($task->end_date)));
        $task->start_date= $task->horaInicioPrev=(Carbon::parse($start_date))->format('Y-m-d H:i:s');
        $task->end_date= $task->horaFimPrev= (Carbon::parse($start_date))->format('Y-m-d') . ' '. Carbon::parse($start_date)->addSeconds($segundosduracao)->format('H:i:s');
        $task->fk_estadoIntervencao=4;
         $task->save();
        return Redirect::to('/registo')->with('Success', 'Tarefa Reagendada!')->withInput();
    }

    public function parar(Request $request){
        $custoHora=user::where('id',Auth::id())->value('custoHora')/3600;
     
      
         $task =  task::find($request->id);
         $segundosduracao=(Carbon::parse($task->horaInicio)->diffInSeconds(Carbon::now()->format('H:i:s')));
         $task->fk_estadoIntervencao =3;
      
          $task->end_date =Carbon::now()->format('Y-m-d H:i:s');
          $task->duracaoHorasReal= gmdate("H:i:s",$segundosduracao);
          $task->custoReal= $custoHora* $segundosduracao;
          $task->progress=1;
          $task->fechado=1;
          $task->save();
  

         $sprint =  task::find($task->parent);
         $sprint->custoReal=    $sprint->custoReal+$task->custoReal;
         $sprint->duracaoHorasReal=Carbon::parse(((Carbon::parse($sprint->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'))))+$segundosduracao)->format('H:i:s');
         $sprint->save();

      
        $projeto= projeto::find($task->fk_projeto);
        $projeto->custoReal+= $task->custoReal;
        $projeto->horasGastas=($projeto->horasGastas+$segundosduracao);
        $projeto->save();

        return view('criar/parartarefa',compact('task'));
       
    }


    public function pausartarefa(Request $request) {
   
        
        $custoHora=user::where('id',Auth::id())->value('custoHora')/3600;
        $task =  task::find($request->id);
        $segundosduracao=(Carbon::parse($task->horaInicio)->diffInSeconds(Carbon::now()->format('H:i:s')));
        $task->fk_estadoIntervencao =5;
     
        $task->end_date =Carbon::now()->format('Y-m-d H:i:s');
        $task->duracaoHorasReal= gmdate("H:i:s",$segundosduracao);
        $task->custoReal= $custoHora* $segundosduracao;
        $task->progress=$request->progress;
        $task->save();
  
        $projeto= projeto::find($task->fk_projeto);
        $projeto->custoReal+= $task->custoReal;
        $projeto->horasGastas=($projeto->horasGastas+$segundosduracao);
        // $horasGastasSegundos=(Carbon::parse($projeto->horasGastas)->diffInSeconds(Carbon::parse('00:00:00')->format('H:i:s')));
        // $projeto->horasGastas=Carbon::parse($horasGastasSegundos)->addSeconds($segundosduracao)->format('H:i:s');
        $projeto->save();

        $sprint =  task::find($task->parent);
         $sprint->custoReal= $sprint->custoReal+$task->custoReal;
         $sprint->duracaoHorasReal=Carbon::parse(((Carbon::parse($sprint->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'))))+$segundosduracao)->format('H:i:s');
        $sprint->save();


        return view('criar/pausartarefa',compact('task'));
    }

    public function updateTarefaRelatorio(Request $request) {   

    

        $task =  task::find($request->id); 
        if ($task->progress==1) {

        }else {
          $task->progress = $request['percentagem']/100;
        
        }
        if ( $task->progress==1) {
          $task->fechado=1;
        }
        $task->relatorio = $request['relatorio'];
        $task->observação = $request['observação'];
      
        $task->save();
        
                if ($request->Agendar==1){
        $task =  task::find($request->id);
            $task->fk_estadoIntervencao =7;
            $task->save();

            $taskn= new Task();
            if(strrpos($task->text,'(Continuação)'))
        {
      
          $str= substr($task->text, strrpos($task->text,'(Continuação)'));
            if ((int) filter_var(($str), FILTER_SANITIZE_NUMBER_INT)) {
                
                $num= (int) filter_var(($str), FILTER_SANITIZE_NUMBER_INT);
                $str= substr($task->text, strpos($task->text,'(Continuação)'));
              $texto=  strstr($task->text, '(Continuação)', true). str_replace($num, $num+1, $str);
            }else {
                $texto= $task->text. '#1';
            }
    
    
         }else {
            $texto= $task->text. '(Continuação)';
         }
         $taskn->text=$texto;
        $taskn->start_date = Carbon::parse($request->horaInicioPrev)->format('Y-m-d H:i:s');
        $taskn->horaInicioPrev =  Carbon::parse($request->horaInicioPrev)->format('Y-m-d H:i:s');

        $duracaoprev=(Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->horaFimPrev)));
       
       $emfaltaPrev=(($duracaoprev*(100-($request->percentagem)))/100);

       
        $taskn->end_date =  (Carbon::parse($request->horaInicioPrev)->addSeconds($emfaltaPrev))->format('Y-m-d H:i:s');
        $taskn->horaFimPrev =  (Carbon::parse($request->horaInicioPrev)->addSeconds($emfaltaPrev))->format('Y-m-d H:i:s');
        $taskn->progress = $request->has("progress") ? $request->progress : 0;
        $taskn->parent = $task->parent;       
        $segundosduracao= Carbon::parse($request->horaInicioPrev)->diffInSeconds(Carbon::parse($taskn->horaFimPrev));
        $custoHora=user::where('id',$task->fk_tecnico)->value('custoHora')/3600;
        $taskn->custoPrevisto= $custoHora* $segundosduracao;
        $taskn->textColor = null;    
        $taskn->fk_tecnico = $task->fk_tecnico;      
        $taskn->fk_projeto =$task->fk_projeto;
        $taskn->tipo = 2;  
        $taskn->fk_estadoIntervencao = 1; 
        $taskn->color = "#40a431"; 
        $taskn->origem=$task->id;  
        $taskn->save();
      
        $link= new Link();
        $link->type=0;
        $link->source=$task->id;
        $link->target=$taskn->id;
        $link->save();
 
        }

        return Redirect::to('/registo');

    }

    public function apagarTarefa(Request $request) {
        
    
        $task = Task::find( $request->id);
            
        $taksFilhas=Link::where('source', $task->id)->get();
        if(count($taksFilhas)>0){
        $task->text='Tarefa apagada';
        $task->color='#808080';
        $task->progress=0;
        $task->start_date=$task->horaInicioPrev;
        $task->fk_estadoIntervencao =6;
        $task->end_date = $task->horaInicio =null;
        $task->duracaoHorasReal= gmdate("H:i:s",0);
        $task->custoReal= 0;
        $task->save();
        }
        else {
            $task->delete();
        }




        return Redirect::to('/registo')->with('Success', 'Tarefa Apagada!')->withInput();
    }

    public function cancelarTarefa(Request $request) {
      
       $task = Task::find($request->id);
        $task->start_date=$task->horaInicioPrev;
       $task->end_date=$task->horaFimPrev;
        $task->progress=0;

        $task->fk_estadoIntervencao =1;
        
       $task->duracaoHorasReal= gmdate("H:i:s",0);
       $task->custoReal= 0;
     
     $task->save();
 
       return Redirect::to('/registo')->with('Success', 'Tarefa cancelada!')->withInput();
    }

    public function vertarefa(Request $request){ 
        $task = Task::find( $request->id);
        $projeto = projeto::find($task->fk_projeto);
        $tecnico= user::find($task->fk_tecnico);
        $sprint =Task::find( $task->parent);
        $grafico = \Lava::DataTable();
        $grafico->addStringColumn('Custos')
        ->addNumberColumn('Real')
        ->addNumberColumn('Previsto');

          // Random Data For Example
        
            $grafico->addRow(['Custos', $projeto->custoReal, $projeto->custoPrevisto]);

            if(($projeto->custoReal) > ($projeto->custoPrevisto)){

              $colors = ['colors'=> [
                        '#eb4e4e', '#009abf'
                        ], 'legend'=>'bottom'];
              }elseif(($projeto->custoReal) <= ($projeto->custoPrevisto)){
                $colors = ['colors'=> [
                    '#40a431', '#009abf'
                ], 'legend'=>'bottom'];

              }

      \Lava::BarChart('Grafico Teste', $grafico,$colors);
      
        $horas = \Lava::DataTable();
        $horas->addStringColumn('Horas')
        ->addNumberColumn('Real')
        ->addNumberColumn('Previsto');

        // Random Data For Example
         $horasgastas1= intval($projeto->horasGastas/3600).'.'.gmdate("i",$projeto->horasGastas);
        $horasprevistas1 =intval($projeto->horasPrevistas/3600).'.'.gmdate("i",$projeto->horasPrevistas);
        $horas->addRow(['Horas',  $horasgastas1, $horasprevistas1]);
        if(($projeto->horasGastas) > ($projeto->horasPrevistas)){

          $colors = ['colors'=> [
                    '#eb4e4e', '#009abf'
                    ], 'legend'=>'bottom'];
          }elseif(($projeto->horasGastas) <= ($projeto->horasPrevistas)){
            $colors = ['colors'=> [
                '#40a431', '#009abf'
            ], 'legend'=>'bottom'];

          }

          \Lava::ScatterChart('horas', $horas,$colors);
          $task1 = \Lava::DataTable();
          $task1->addStringColumn('Custos')
          ->addNumberColumn('Real')
          ->addNumberColumn('Previsto');
  
          // Random Data For Example
          
              $task1->addRow(['Custos', $task->custoReal, $task->custoPrevisto]);
  
              if(($task->custoReal) > ($task->custoPrevisto)){
  
                $colors = ['colors'=> [
                          '#eb4e4e', '#009abf'
                          ], 'legend'=>'bottom'];
                }elseif(($task->custoReal) <= ($task->custoPrevisto)){
                  $colors = ['colors'=> [
                      '#40a431', '#009abf'
                  ], 'legend'=>'bottom'];
  
                }
  
     \Lava::ColumnChart('task1', $task1,$colors);
     $task2 = \Lava::DataTable();
     $task2->addStringColumn('Horas')
     ->addNumberColumn('Real')
     ->addNumberColumn('Previsto');
 



     // Random Data For Example
     $horasgastas2= explode(":",$task->duracaoHorasReal);
     $horasprevistas2 = explode(":",$task->duracaoHorasEstimado);
         $task2->addRow(['Horas',  $horasgastas2[0].'.'.$horasgastas2[1], $horasprevistas2[0].'.'.$horasprevistas2[1]]);
 
         if(($task->horasGastas) > ($task->horasPrevistas)){
 
           $colors = ['colors'=> [
                     '#eb4e4e', '#009abf'
                     ], 'legend'=>'bottom'];
           }elseif(($task->horasGastas) <= ($task->horasPrevistas)){
             $colors = ['colors'=> [
                 '#40a431', '#009abf'
             ], 'legend'=>'bottom'];
 
           }
 
           \Lava::BarChart('task2', $task2,$colors);
        return view('ver/tarefa',compact('task','projeto','sprint','tecnico'));

    }
  
    public function mostratodas(){
        
        $tasks = Task::where('tipo',2)->get(); 
      
      return view('mostrar/intervencoes',compact('tasks'));
    }

    public function mostraretapas() {
        
        $tasks = Task::where('tipo',1)->where('fechado',0)->get(); 
      
      return view('mostrar/etapas',compact('tasks'));
    }

    public function mostrarprojetos() {
        
        $projetos = Projeto::get(); 
     
      return view('mostrar/projetosclientesetapas',compact('projetos'));
    }
    public function criaretapa(Request $request){
        
        $projetos = Projeto::find($request->id); 
        $tecnico=user::leftjoin('projdeps','projdeps.fk_departamento','users.fk_departamento')->where('fk_projeto',$request->id)->orderBy('sigla','ASC')->pluck('sigla', 'id');
    
        $departamentos=projdep::leftjoin('departamentos','projdeps.fk_departamento','departamentos.pk_departamento')->where('fk_projeto',$request->id)->orderBy('abreviatura','ASC')->pluck('abreviatura', 'pk_departamento');
     
      return view('criar/etapa',compact('projetos','tecnico','departamentos'));
    }
    public function gravaretapa(Request $request)    {
      
      // $validator =  Validator::make($request->all(), [
      //   'descricao' => 'required',
      //   'horaInicioPrev' => 'required',
      //   'horaFimPrev' => 'required',
      //   ]);

      //   if($validator->fails()){
      //       \Session::flash('warning','Por favor preencha os campos assinalados');
      //       return Redirect::to('/etapacriar')->withInput()->withErrors($validator);

      //   }

            // $firstinicio = carbon::parse($request->start_date);
            // $secondfim = carbon::parse($request->end_date);
            // if ($firstinicio->greaterThan($secondfim))
            // {
            //     return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
            //         ->withInput();
    
            // }
       
       
        $task = new Task();
        $task->text = "Sprint: ". $request->descricao;
        $task->textColor = null;  
        $task->start_date =$task->horaInicioPrev= Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $task->end_date =  $task->horaFimPrev= Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        $segundosduracao= Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->horaFimPrev));
        $task->duration = Carbon::parse($request->start_date)->diffInHours(Carbon::parse($request->end_date));
        $task->fk_departamento=user::where('id',$request->fk_tecnico)->value('fk_departamento');
        $task->parent = task::where('fk_projeto',$request->fk_projeto)->where('tipo','0')->value('id');
        $task->fk_tecnico = $request->fk_tecnico;
        $task->color = "#eb4e4e"; 
        $task->tipo = 1; 
        $task->fk_projeto=$request->fk_projeto;
        $task->save();


        return Redirect::to('/etapas')->with('Success', 'Etapa criada')->withInput();
    }

    public  function pararetapa(Request $request){
      // return $request;
      $etapa= task::find($request->id); 
      $tasks=task::where('parent',$request->id)->where('tipo','2')->WhereIn('fk_estadoIntervencao',array(1,2,4,5,7))->get();
      if(count($tasks)>0 and $request->confirma==null){
        return Redirect::to('/etapas')->with('Warning', 'Ainda se encontram etapas por concluir. Deseja concluir todas?')->with('id', $etapa->id)->withInput();

      }elseif ($request->confirma=='sim') {

          for ($i=0; $i <count($tasks) ; $i++) { 
            // return $tasks[$i]->fk_estadoIntervencao;
          if ($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4) {
          
            $tasks[$i]->fk_estadoIntervencao=6;
        
            $tasks[$i]->save();
          } elseif ( $tasks[$i]->fk_estadoIntervencao==5) {
            $tasks[$i]->fk_estadoIntervencao=3;
            $tasks[$i]->save();
          }elseif ($tasks[$i]->fk_estadoIntervencao==2 or $tasks[$i]->fk_estadoIntervencao==7) {
            $colaborador=user::find( $tasks[$i]->fk_tecnico);
            
            return Redirect::to('/etapas')->with('Danger', 'A tarefa: '.  $tasks[$i]->text . ' do colaborador : '.$colaborador->sigla.' está em curso. Iniciada em :'.$tasks[$i]->start_date)->withInput();
          }
          
        }
        }
          $etapa->fechado=1;
          $etapa->save();
      return Redirect::to('/etapas')->with('Success', 'Etapa terminada')->withInput();
    }


    public function criartarefaamao(Request $request)    {  
    
      $dia= Session::get('dia');
        if ($dia==null) {
            $dia=$request->data;
        }
     
        $user=user::where('id',auth::id())->get();
        $clientes=cliente::leftjoin('projetos','pk_cliente','fk_cliente')->where('fk_estadoproj','<',4)->orderBy('nomeCompleto','ASC')->leftjoin('projdeps','pk_projeto','fk_projeto')->where('fk_departamento',$user[0]->fk_departamento)->groupBy('fk_cliente')->get();
        $projetos = Projeto::leftjoin('projdeps','pk_projeto','fk_projeto')->where('fk_departamento',$user[0]->fk_departamento)->where('fk_estadoproj','<',4)->orderBy('nomeProjeto','ASC')->get();
        $etapas=task::where('tipo',1)->where('fechado',0)->where('fk_departamento',$user[0]->fk_departamento)->orderBy('text','ASC')->get();
    
     
      return view('criar/tarefa',compact('clientes','projetos','etapas','dia'));
    }

    public function gravartarefamao(Request $request){
 
      $versehatask=task::where('start_date',$request->diaInicio . ' '.$request->horaInicio)->where('parent',$request->parent)->where('text','like','Tarefa: '.$request->text.'%')->Where('fk_tecnico',auth::id())->get();
       if (count($versehatask)>0) {
        return Redirect::back()->with('Warning', 'Tarefa duplicada.')->withInput($request->all())->with(['dia'=>$request->diaInicio]);
       }
      //  return $request;
      
        if($request->diaInicio!=$request->diaFim){
          return Redirect::back()->with('Warning', 'A data de fim não coincide com a data de inicio')->withInput($request->all())->with(['dia'=>$request->diaInicio]);
        }
        $inico =Carbon::parse($request->horaInicio)->diffInSeconds(Carbon::parse('00:00:00'));
        $fim=  Carbon::parse($request->horaFim)->diffInSeconds(Carbon::parse('00:00:00'));
        if($inico>=$fim){
          return Redirect::back()->with('Warning', 'Hora de fim da tarefa tem de ser superior à hora de inicio.')->withInput($request->all())->with(['dia'=>$request->diaInicio]);
        }

      if ($request->simNao2==1) {
        $participantes=sizeof($request->participantes);
      } else {
        $participantes=0;
      }



      $task = new Task();
      $task->text = "Tarefa: ". $request->text;
      $task->textColor = null;  
      $task->start_date =$task->horaInicioPrev= $request->diaInicio. ' '.$request->horaInicio.':00';
      $task->end_date =  $task->horaFimPrev= $request->diaFim. ' '.$request->horaFim.':00';
      $segundosduracao= Carbon::parse($task->horaInicioPrev)->diffInSeconds(Carbon::parse($task->horaFimPrev));
      $task->duration = intval($segundosduracao/3600);
      $custoHora=user::where('id',auth::id())->value('custoHora')/3600;
      $task->duracaoHorasEstimado=Carbon::parse($segundosduracao)->format('H:i:s');
      $task->parent = $request->parent;
      $task->custoPrevisto= $custoHora* $segundosduracao;
      $task->fk_tecnico = auth::id();
      $task->color = "#40a431"; 
      $task->tipo = 2; 
      $task->fk_projeto=$request->fk_projeto;

        if ($request->simNao==1) {
              $task->relatorio=$request->relatorio;
                $task->duracaoHorasReal= gmdate("H:i:s",$segundosduracao);
              $task->custoReal= $custoHora* $segundosduracao;
              $task->progress=1;
              $task->fk_estadoIntervencao =3;

              $sprint =  task::find($task->parent);
              $sprint->custoReal=    $sprint->custoReal+$task->custoReal;
              $sprint->duracaoHorasReal=Carbon::parse(((Carbon::parse($sprint->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'))))+$segundosduracao)->format('H:i:s');
            $sprint->save();

            
              $projeto= projeto::find($task->fk_projeto);
              $projeto->custoReal+= $task->custoReal;
              $projeto->horasGastas=($projeto->horasGastas+$segundosduracao);
              $projeto->save();

        }else {
          $task->progress = 0;
          $task->fk_estadoIntervencao =1;
        }
        if ( $task->progress==1) {
          $task->fechado=1;
        }
        $task->save();



      for ($i=0; $i <$participantes ; $i++) { 
            $tasks[$i] = new Task();
          //  $request->participantes[$i];
            $tasks[$i]->text = "Tarefa: ". $request->text;
            $tasks[$i]->textColor = null;  
            $tasks[$i]->start_date =$tasks[$i]->horaInicioPrev= $request->diaInicio. ' '.$request->horaInicio.':00';
            $tasks[$i]->end_date =  $tasks[$i]->horaFimPrev= $request->diaFim. ' '.$request->horaFim.':00';
            $segundosduracao= Carbon::parse($tasks[$i]->horaInicioPrev)->diffInSeconds(Carbon::parse($tasks[$i]->horaFimPrev));
            $tasks[$i]->duration = intval($segundosduracao/3600);
            $custoHora=user::where('id',$request->participantes[$i])->value('custoHora')/3600;
            $tasks[$i]->duracaoHorasEstimado=Carbon::parse($segundosduracao)->format('H:i:s');
            $tasks[$i]->parent = $request->parent;
            $tasks[$i]->custoPrevisto= $custoHora* $segundosduracao;
            $tasks[$i]->fk_tecnico = $request->participantes[$i];
            $tasks[$i]->color = "#40a431"; 
            $tasks[$i]->tipo = 2; 
            $tasks[$i]->fk_projeto=$request->fk_projeto;

          if ($request->simNao==1) {
            $tasks[$i]->relatorio=$request->relatorio;
              $tasks[$i]->duracaoHorasReal= gmdate("H:i:s",$segundosduracao);
            $tasks[$i]->custoReal= $custoHora* $segundosduracao;
            $tasks[$i]->progress=1;
            $tasks[$i]->fk_estadoIntervencao =3;

            $sprint =  task::find($tasks[$i]->parent);
            $sprint->custoReal=    $sprint->custoReal+$tasks[$i]->custoReal;
            $sprint->duracaoHorasReal=Carbon::parse(((Carbon::parse($sprint->duracaoHorasReal)->diffInSeconds(Carbon::parse('00:00:00'))))+$segundosduracao)->format('H:i:s');
          $sprint->save();


            $projeto= projeto::find($tasks[$i]->fk_projeto);
            $projeto->custoReal+= $tasks[$i]->custoReal;
            $projeto->horasGastas=($projeto->horasGastas+$segundosduracao);
            $projeto->save();

          }else {
          $tasks[$i]->progress = 0;
          $tasks[$i]->fk_estadoIntervencao =1;
          }
          if ( $tasks[$i]->progress==1) {
          $tasks[$i]->fechado=1;
          }
        
          $tasks[$i]->save();


      }

      if ($request->tipo==5) {
        $event=new Event();

      
        for ($e=0; $e < $participantes; $e++) { 
          
            $sigla[]= ' '. user::where('id',$request->participantes[$e])->value('sigla');
          
      }
      
      if ($participantes>0) {
        $eventuser=user::where('id',auth::id())->value('sigla').'+'. implode("+",$sigla);
      }else{
        $eventuser=user::where('id',auth::id())->value('sigla');
      }


        $event->text = $eventuser.'->Reunião: '. $request->text ;
        $event->start_date =    $request->diaInicio. ' '.$request->horaInicio.':00';
        $event->end_date = $request->diaFim. ' '.$request->horaFim.':00';
        $event->subject = 3;    
        $event->fk_tecnico=0;
        $event->obs = null;
        $event->localizacao = null;
      
        $event->save();
      } elseif($request->tipo==6){
        $event=new Event();
      
        for ($e=0; $e < $participantes; $e++) { 
          
            $sigla[]= ' '. user::where('id',$request->participantes[$e])->value('sigla');
          
      }
        $eventuser=user::where('id',auth::id())->value('sigla').'+'. implode("+",$sigla);

        $event->text = $eventuser.'->Call Skype: '. $request->text ;
        $event->start_date =    $request->diaInicio. ' '.$request->horaInicio.':00';
        $event->end_date = $request->diaFim. ' '.$request->horaFim.':00';
        $event->subject = 4;    
        $event->fk_tecnico=0;
        $event->obs = null;
        $event->localizacao = null;
        $event->save();
      }
      
      return Redirect::to('/registod')->with('Success', 'Tarefa Criada!')->with(['dia'=>  $request->diaInicio, 'id'=> auth::id()]);   
            
          
    }
    
}
