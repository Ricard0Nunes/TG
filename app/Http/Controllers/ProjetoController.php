<?php

namespace App\Http\Controllers;

use App\Projeto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\Orcamento;
use App\Area;
use App\Task;
use App\User;
use App\Urgencia;
use App\Empresa;
use App\Departamento;
use App\ProjDep;
use App\CamposExtraProjeto;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\URL;

use App\Link;

class ProjetoController extends Controller
{

    public function gantt(){
        $tasks = new Task();
        $links = new Link();
      
        $str= URL::previous();
       $id= (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

        $projeto = projeto::find($id);
        $dep = projdep::where('fk_projeto',$id)->leftjoin('departamentos','pk_departamento','fk_departamento')-> pluck('descricao','pk_departamento');
        $usersb =  projdep::where('fk_projeto',$id)->leftjoin('departamentos','pk_departamento','fk_departamento')->leftjoin('users','users.fk_departamento','pk_departamento')->pluck('name','id');
        return response()->json([
            "data" => $tasks->where('fk_projeto', $id)->get(),
            "links" => $links->all(),
            "users"=>$usersb->all(),
            "dep"=>$dep->all()


        ]);
    }

    public function get(Request $request){
        $users = new Departamento();
    
        $str= URL::previous();
        $id= (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


        $dep =   projdep::where('fk_projeto',$id)->leftjoin('departamentos','pk_departamento','fk_departamento');


		$departamentoArray = $dep->get()->all();
		 array_unshift($departamentoArray, ["fk_departamento"=>"", "descricao" => "Escolha o Departamento"]);// add 'unassigned' user
        // return response()->json([
        //     $users
        //     ]);
		return response()->json(
			array_map(function ($dep) {
					return [
						"key" => $dep["fk_departamento"],
						"label" => $dep["descricao"]
					];
				},
				 $departamentoArray
			)
		);
	}

 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projeto = projeto::get();
        return view('mostrar/projetos', compact('projeto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $area = area::where('visivel',1)->orderBy('projArea','ASC')->pluck('projArea', 'pk_area');
        $urgencia = urgencia::where('visivel',1)->orderBy('descricaoUrgencia','ASC')->pluck('descricaoUrgencia', 'pk_urgencia');
        $responsavel = user::where('visivel',1)->orderBy('name','ASC')->where('id','>',1)->pluck('name', 'id');

        $cliente = cliente::where('visivel',1)->orderBy('nomeCompleto','ASC')->pluck('nomeCompleto', 'pk_cliente');
        $departamento = departamento::orderBy('descricao','ASC')->pluck('descricao', 'pk_departamento');
        $areas = area::where('visivel',1)->orderBy('projArea','ASC')->get();

        return view('criar/projetos',compact('area','urgencia','responsavel','cliente', 'areas','departamento'));
    
    }

    
 
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'codProj' => 'required',
            'nomeProjeto' => 'required',
            'descricaoProjeto' => 'required',
            'visivel' => 'required',
            'dataPrevistaInicio' => 'required',
            'horasPrevistas' => 'required',
            'custoPrevisto' => 'required',
            'fk_areaProj' => 'required',
            'fk_urgencia' => 'required',
            'fk_responsavel' => 'required',
       
            'fk_departamento' => 'required',
     
            ]);

            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/novoprojeto')->withInput()->withErrors($validator);
            }
            if($request['dataInicio']==""){
                $request['dataInicio']=null;
            }
            if($request['dataPrevistaFim']==""){
                $request['dataPrevistaFim']=null;
            }
            if($request['dataFim']==""){
                $request['dataFim']=null;
            }
         

            $projeto = new projeto;

            //===============Criação de nova Área de Projeto===========//
            if(isset($_POST['fk_areaProj']) && $_POST['fk_areaProj'] == 'novaAreaProjeto') { //opção selecionada "Novo Processo"
                $novaArea = new area; //nova área de projeto criada
                $novaArea->projArea = $request->novaArea;
                $novaArea->visivel = 1;

                $novaArea->save();
    
                $id_novaArea  = $novaArea->pk_area;
                $projeto->fk_areaProj = $id_novaArea;
                }
            else{ 
                $projeto->fk_areaProj = $request->fk_areaProj;
            }

            $first = carbon::parse($request->dataPrevistaInicio);
            $second = carbon::parse($request->dataPrevistaFim);
            if ($first->greaterThan($second))
            {
                return Redirect::back()->with('warning', 'Data prevista de fim inferior à data prevista de início.')
                    ->withInput();
    
            }

            $projeto->codProj = $request['codProj'];
            $projeto->nomeProjeto = $request['nomeProjeto'];
            $projeto->descricaoProjeto = $request['descricaoProjeto'];
            $projeto->dataPrevistaInicio = $request['dataPrevistaInicio'];
            $projeto->dataInicio = $request['dataInicio'];
            $projeto->dataPrevistaFim = $request['dataPrevistaFim'];
            $projeto->dataFim = $request['dataFim'];
            $projeto->custoPrevisto = $request['custoPrevisto'];
            $projeto->custoReal = 0;
            $projeto->horasPrevistas = $request['horasPrevistas']*3600;
            $projeto->horasGastas = 0;
            $projeto->observacoes = $request['observacoes'];
            $projeto->visivel = $request['visivel'];
            $projeto->fk_urgencia = $request['fk_urgencia'];
            $projeto->fk_criadoPor = $request['fk_criadoPor'];
            $projeto->fk_responsavel = $request['fk_responsavel'];
                   
            $projeto->fk_cliente = $request['fk_cliente'];
            $projeto->fk_empresa = empresa::where('visivel',1)->value('pk_empresa');
            if ( $request['dataInicio']!=null) {
                $projeto->fk_estadoproj = 1;
            }else{
                $projeto->fk_estadoproj = 2;
            }
           
            $projeto->fk_orcamento = $request['fk_orcamento']; 
            $projeto->save();
      
            $task = new Task();
 
            $task->text = "Projeto: ".$request['codProj'];
            $task->start_date = $request['dataPrevistaInicio'].' 00:00:00';
            $task->end_date = $request['dataPrevistaFim'].' 00:00:00';;
            $task->duration = Carbon::parse($request['dataPrevistaInicio'])->diffInDays(Carbon::parse($request['dataPrevistaFim'] ));
            $task->progress = $request->has("progress") ? $request->progress : 0;
            $task->parent = 0;
            $task->tipo = 0;
            $task->color = "#009abf";
            $task->fk_projeto =$projeto->pk_projeto;
            $task->fk_tecnico =$request['fk_responsavel'];
            $task->save();
     

        
            foreach($request->fk_departamento as $dep ):
       
                $projdep= new projdep;
                $projdep->fk_projeto= $projeto->pk_projeto;
                $projdep->fk_departamento = $dep;
                $projdep->save();
             endforeach;

            // 
          


            \Session::flash('success', 'O Projeto '. $request->descricaoProjeto .' foi criado com sucesso');
    
            // escrever log 
            $url="/verprojeto/".$projeto->pk_projeto;
            return Redirect::to($url);

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      
       $projeto = projeto::find( $request->id);
      
        $id=$request->id;
        $empresa = empresa::where('pk_empresa',$projeto->fk_empresa)->value('nomeAbreviado');
        
        $projDep = projDep::where('fk_projeto',$id)->leftjoin('departamentos', 'pk_departamento','fk_departamento')->get();
        $task = task::where('fk_projeto',$projeto->pk_projeto)->where('tipo', 0)->value('progress');
      
        $taskCustoP = $projeto->custoPrevisto;
        $taskCustoR = $projeto->custoReal;
        $taskHorasP = intval($projeto->horasPrevistas/3600).'.'.gmdate("i",$projeto->horasPrevistas);
        $taskHorasR = intval($projeto->horasGastas/3600).'.'.gmdate("i",$projeto->horasGastas);
      


        $area = area::where('pk_area',$projeto->fk_areaProj)->value('projArea');
        $urgencia = urgencia::where('pk_urgencia',$projeto->fk_urgencia)->value('descricaoUrgencia');
        $user = user::where('id',$projeto->fk_criadoPor)->value('name');
        $userImg = user::where('id',$projeto->fk_criadoPor)->value('foto');
        $user2 = user::where('id',$projeto->fk_responsavel)->value('name');
        $user2Img = user::where('id',$projeto->fk_responsavel)->value('foto');
        $cliente = cliente::where('pk_cliente',$projeto->fk_cliente)->value('nomeCompleto');
        $clienteLogo = cliente::where('pk_cliente',$projeto->fk_cliente)->value('logo');
        $clienteContacto = cliente::where('pk_cliente',$projeto->fk_cliente)->value('contacto');
        $clienteEmail = cliente::where('pk_cliente',$projeto->fk_cliente)->value('email');
        $status= DB::table('estadoprojetos')->where('pk_estadoProjeto',$projeto->fk_estadoproj)->value('descricaoEstado');
        // $grafico = \Lava::DataTable();
          $users = user::where('id','>',1)->get();
      
       
    

        // $grafico->addStringColumn('Custos')
        //     ->addNumberColumn('Real')
        //     ->addNumberColumn('Previsto');

            // Random Data For Example
            
    
       
           $contadordepessoas= DB::table('tasks')->where('fk_projeto',$id)->groupBy('fk_tecnico')->pluck('fk_tecnico');
           $tasksPendentes=task::where('fk_projeto',$id)->where('fk_estadoIntervencao',1)->orderBy('start_date')->get();
           $tasksEmCurso=task::where('fk_projeto',$id)->where('fk_estadoIntervencao',2)->orderBy('horaInicio')->get();
           $tasksConcluidas=task::where('fk_projeto',$id)->where('fk_estadoIntervencao',3)->orderBy('horaInicio')->get();
           $etapas= Task::where('tipo',1)->where('fk_projeto',$id)->get(); 
           $campoExtraProjeto=CamposExtraProjeto::where('fk_projeto',$id)->get();
        return view('ver/projeto2', compact('projeto','campoExtraProjeto','etapas','taskCustoP','contadordepessoas','taskHorasP','taskHorasR','taskCustoR','task','tasksPendentes','clienteLogo','clienteEmail','clienteContacto','tasksEmCurso','tasksConcluidas','status','users','empresa','projDep','urgencia','cliente','user','user2','userImg','user2Img','area'));
    }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $projeto = projeto::find($id);

        $area = area::where('visivel',1)->orderBy('projArea','ASC')->pluck('projArea', 'pk_area');
        $urgencia = urgencia::where('visivel',1)->orderBy('descricaoUrgencia','ASC')->pluck('descricaoUrgencia', 'pk_urgencia');
        $responsavel = user::where('visivel',1)->orderBy('name','ASC')->pluck('name', 'id');
        $cliente = cliente::where('visivel',1)->orderBy('nomeCompleto','ASC')->pluck('nomeCompleto', 'pk_cliente');
        $departamentonoprojeto = projdep::leftjoin('departamentos', 'pk_departamento','=','fk_departamento')->where('fk_projeto', '=', $id)->get();
       
        $departamento= DB::select("SELECT * from departamentos where pk_departamento not in (select fk_departamento from projdeps where projdeps.fk_projeto=$id)");

  

        return view('editar/projeto', compact('projeto', 'area','urgencia', 'responsavel', 'cliente','departamento','departamentonoprojeto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [
            'codProj' => 'required',
            'nomeProjeto' => 'required',
            'descricaoProjeto' => 'required',
            'visivel' => 'required',
            'dataPrevistaInicio' => 'required',
            'custoPrevisto' => 'required',
           
     
            ]);

            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados');
                return Redirect::to('/editarprojeto/'.$id)->withInput()->withErrors($validator);
            }
            if($request['dataInicio']==""){
                $request['dataInicio']=null;
            }
            if($request['dataPrevistaFim']==""){
                $request['dataPrevistaFim']=null;
            }
            if($request['dataFim']==""){
                $request['dataFim']=null;
            }

            $first = carbon::parse($request->dataPrevistaInicio);
            $second = carbon::parse($request->dataPrevistaFim);
            if ($first->greaterThan($second))
            {
                return Redirect::back()->with('warning', 'Data prevista de fim inferior à data prevista de início.')
                    ->withInput();
    
            }

            $firstinicio = carbon::parse($request->dataInicio);
            $secondfim = carbon::parse($request->dataFim);
            if ($firstinicio->greaterThan($secondfim))
            {
                return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
                    ->withInput();
    
            }

            $projeto = projeto::find($id);

            $projeto->codProj = $request['codProj'];
            $projeto->nomeProjeto = $request['nomeProjeto'];
            $projeto->descricaoProjeto = $request['descricaoProjeto'];
            $projeto->dataPrevistaInicio = $request['dataPrevistaInicio'];
            $projeto->dataInicio = $request['dataInicio'];
            $projeto->dataPrevistaFim = $request['dataPrevistaFim'];
            $projeto->dataFim = $request['dataFim'];
            $projeto->custoPrevisto = $request['custoPrevisto'];
            $projeto->custoReal = $request['custoReal'];
            $projeto->horasPrevistas = $request['horasPrevistas'];
            $projeto->horasGastas = $request['horasGastas'];
            $projeto->observacoes = $request['observacoes'];
            $projeto->visivel = $request['visivel'];
            $projeto->fk_urgencia = $request['fk_urgencia'];
            $projeto->fk_criadoPor = $request['fk_criadoPor'];
            $projeto->fk_responsavel = $request['fk_responsavel'];
            $projeto->fk_areaProj = $request['fk_areaProj'];
            $projeto->fk_cliente = $request['fk_cliente'];
            $projeto->fk_empresa = $request['fk_empresa'];
            $projeto->fk_estadoproj = 2;
            $projeto->fk_orcamento = $request['fk_orcamento']; 
            $projeto->save();

            // foreach($request->fk_departamento as $dep ):
       
            //     $projdep= new projdep;
            //     $projdep->fk_projeto= $projeto->pk_projeto;
            //     $projdep->fk_departamento = $dep;
            //     $projdep->save();
            //  endforeach;

             
            \Session::flash('success', 'O Projeto '. $request->descricaoProjeto .' foi atualizado com sucesso');
    
            // escrever log 
            return Redirect::to('/projetos');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projeto  $projeto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projeto $projeto)
    {
        //
    }
    public function start($id)
    {
    $projeto = projeto::find($id);

    $projeto->dataInicio = Carbon::now();
    $projeto->fk_estadoproj = 1;
    $projeto->save();
    \Session::flash('success', 'O Projeto '. $projeto->descricaoProjeto .' foi iniciado com sucesso');
    
    // escrever log 
    return Redirect::to('/projetos');  

    
    }
    public function restart($id)
    {
        $projeto = projeto::find($id);
        $projeto->dataFim = null;
        $projeto->fk_estadoproj = 3;
        $projeto->save();
        \Session::flash('success', 'O Projeto '. $projeto->descricaoProjeto .' foi Reaberto com sucesso');
        
        // escrever log 
        return Redirect::to('/projetos');    
    }
    public function stop($id)
    {

        //ver se projeto nao tem intervenções abertas 
        

        $projeto = projeto::find($id);
        $projeto->dataFim = Carbon::now();
        $projeto->fk_estadoproj = 4;
        $projeto->save();
        \Session::flash('success', 'O Projeto '. $projeto->descricaoProjeto .' foi Finalizado com sucesso');
        
        // escrever log 
        return Redirect::to('/projetos');    
    }


    public function storecampoextra(Request $request){

      
        $campoextra= new CamposExtraProjeto;
        $campoextra->descricao=$request->descricaocampoextra;
        $campoextra->valor=$request->valorcampoextra;
        $campoextra->fk_projeto=$request->fk_projeto;
        $campoextra->save();
        $url="/verprojeto/".$request->fk_projeto;
        return Redirect::to($url);
 
    }
}
