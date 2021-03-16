<?php

namespace App\Http\Controllers;
use App\Ausencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use App\User;
use App\usersComuns;
use App\DepEmp;
use App\Horario;
use App\Cargo;
use App\Departamento;
use App\Empresa;
use App\Task;
use App\Notificacoes;
use Carbon\Carbon;
use App\todoList;
use App\Ponto;
use App\Projeto;
use App\nivelAcesso;
use Auth;
use DB;
use App\empresasComuns;

use Illuminate\Support\Facades\URL;
use Validator;




class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    
    public function get(Request $request){
        $users = new User();
    
        $str= URL::previous();
        $id= (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


        $departamento = DB::table('projdeps')->where('fk_projeto',$id)->pluck('fk_departamento');

		$usersArray = $users->whereIn('fk_departamento',$departamento)->get()->all();
		 array_unshift($usersArray, ["id"=>"", "sigla" => "Escolha o Responsável"]);// add 'unassigned' user
        // return response()->json([
        //     $users
        //     ]);
		return response()->json(
			array_map(function ($users) {
					return [
						"key" => $users["id"],
						"label" => $users["sigla"]
					];
				},
				 $usersArray
			)
		);
    }
    public function getUsersEvent(Request $request){
        // return response()->json([
        //    'aaaaaa'
        //     ]);
        $users = new User();
    
        $str= URL::previous();
        $id= (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);


     

		$usersArray = $users->get()->where('visivel',1)->all();
		 array_unshift($usersArray, ["id"=>"", "sigla" => "Escolha o Responsável"]);// add 'unassigned' user
        //   return response()->json([
        //        'aaaaaa'
        //         ]);
		return response()->json(
			array_map(function ($users) {
					return [
						"key" => $users["id"],
						"label" => $users["sigla"]
					];
				},
				 $usersArray
			)
		);
	}
    public function index()
    {
      
        $users = user::where('id','>',1)->where('visivel',1)->get();
        return view('mostrar/users', compact('users'));
    }
    public function indexarquivo()
    {
      
        $users = user::where('id','>',1)->where('visivel',0)->get();
        return view('mostrar/users', compact('users'));
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       
        $departamento = departamento::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_departamento');
        $horario = horario::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_horario');
        $cargo = cargo::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_cargo');
        $nivel=nivelAcesso::orderBy('nivel','ASC')->pluck('nivel','pk_nivelAcesso');
        $cargos = cargo::all();
        $horarios = horario::all();
        $empresas=empresascomuns::pluck('nomeAbreviado','NIF');

        return view('criar/user',compact('departamento','horario','cargo', 'cargos', 'horarios','nivel','empresas'));
    }

    /**LOG CRIAR USER 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        




        $validator =  Validator::make($request->all(), [
        
            'dtnsc' => 'required|date|before:-15 years',
        
            'contactoPessoal' => 'required',

            'bi' => 'required|max:8|min:8',
            'nif' => 'required|max:9|min:9',
        

            'segSocial'=>'required|max:11|min:11',
            
            
        ]);

        if($this->validaNIF($request['nif'])==0){

            \Session::flash('warning','NIF Inválido!');
            return Redirect::back()->withInput()->withErrors($validator);
        }



        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');

            return Redirect::back()->withInput()->withErrors($validator);
        }

        $user = new user;
        $name=$request->name;

        $temp = explode(" ",$name);

        $nomeAbreviado = $temp[0] . " " . $temp[count($temp)-1];

        //===============Criação de novo Cargo de User===========//
        if (isset($_POST['fk_cargo']) && $_POST['fk_cargo'] == 'novoCargo') { //opção selecionada "Novo Cargo"
            $novoCargo = new cargo; //novo cargo
            $novoCargo->descricao = $request->novoCargoDescricao;
            $novoCargo->visivel = $request->novoCargoVisivel;
            $novoCargo->save();

            $id_novoCargo = $novoCargo->pk_cargo;
            $user->fk_cargo = $id_novoCargo;
        } else {
            $user->fk_cargo = $request['fk_cargo'];
        }

        //===============Criação de novo Horário de User===========//
        if (isset($_POST['fk_horario']) && $_POST['fk_horario'] == 'novoHorario') { //opção selecionada "Novo Horário"
            $novoHorario = new horario; //novo horário
            $novoHorario->descricao = $request->novaDescricao;
            $novoHorario->horaEntrada = $request->novaHoraEntrada;
            $novoHorario->horaSaida = $request->novaHoraSaida;
            $novoHorario->duracaoAlmoco  = $request->novaDuracaoAlmoco;
            $novoHorario->almocoApartir  = $request->novoAlmocoApartir;
            $novoHorario->almocoAte  = $request->novoAlmocoAte;
            $novoHorario->horasDiarias  = $request->novaHorasDiarias;
            $novoHorario->visivel  = $request->novoVisivel;
            $novoHorario->save();

            $id_novoHorario = $novoHorario->pk_horario; 
            $user->fk_horario =  $id_novoHorario;
        } else {
            $user->fk_horario = $request['fk_horario'];
        }


        $user->sigla = $request['sigla'];

        if($request->hasFile('foto'))
                    
                {
                
                $user->foto= $request->file('foto')->store('users','public');
                }
                else{
                            if ($request['sexo']==1) {
                                $user->foto="users/homem.png";
                            }else {
                                $user->foto="users/mulher.png";
                            }
            
                }
        $user->name =  $nomeAbreviado;
        $user->nomeCompleto=$request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->dtnsc = $request['dtnsc'];
        $user->morada = $request['morada'];
        $user->sexo = $request['sexo'];
        $user->emailPessoal = $request['emailPessoal'];
        $user->contactoPessoal = $request['contactoPessoal'];
        $horasdiarias= horario::where('pk_horario',$request->fk_horario)->value('horasDiarias');
        
        $horassemana= (Carbon::parse($horasdiarias)->diffInSeconds(Carbon::parse('00:00:00'))*5)/3600;
        $valorhora = ($request->salarioBase * 12)/(52 * ($horassemana));
        $user->custoHora = number_format($valorhora , 2);

        $user->iban=$request->iban;
        $user->salarioBase=$request->salarioBase;
        $user->validadecc=$request->validade;
        $user->cartaConducao=$request->cartaConducao;
        $user->estadoCivil=$request->estadoCivil;
        $user->skype=$request->skype;
        $user->numeroFilhos=$request->numeroFilhos;

        $user->bi = $request['bi'];
        $user->contactoProfissional = $request['contactoProfissional'];
        $user->contactoEmergencia = $request['contactoEmergencia'];
        $user->segSocial = $request['segSocial'];
        $user->nif = $request['nif'];
        $user->visivel = 1;
        $user->dataInicioContrato = $request['dataInicioContrato'];
        $user->dataFimContrato = $request['dataFimContrato'];

        $user->subcontratado=$request['simNao'];
        $user->fk_nivelAcesso=$request['fk_nivelAcesso'];
        $user->pin=$request['pin'];
        $user->fk_departamento = $request['fk_departamento'];
        if( $request['simNao']==0){
        $user->fk_empresa = empresa::where('visivel',1)->value('pk_empresa');
        $user->nifEmpregador=empresa::where('visivel',1)->value('nif');;
        }
        else {
            $user->fk_empresa = empresa::where('visivel',1)->value('pk_empresa');
            $user->nifEmpregador= $request['nifEmpregador'];
        }

        $userRegistado=  userscomuns::where('BI',$request['bi'])->get();

        if (count($userRegistado)==0) {
            $userscomuns= new userscomuns;
            $userscomuns->nome=$request['name'];
            $userscomuns->BI=$request['bi'];
            $userscomuns->nifempresa=  $user->nifEmpregador;
            $userscomuns->sigla = $request['sigla'];
            $userscomuns->save();

        }

        $user->save();
        if(($request['sexo']==1))
        {
        \Session::flash('success', 'O Colaborador '. $request->name .' foi criado com sucesso');
        }
        else{
            \Session::flash('success', 'A Colaboradora '. $request->name .' foi criada com sucesso');
        }
        // escrever log 
        return Redirect::to('/colaboradores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->id==null) {
            $request->id=Auth::id();
        }else {
            $request->id=$request->id;
        }
   
        $mes =Carbon::now()->format('m');
        $user = user::find($request->id);
        $userscomuns=userscomuns::where('BI',$user->bi)->get();
        $etapas=count(task::where('fk_tecnico',$user->id)->where('tipo',1)->get());
        $notificacoes=notificacoes::where('fk_user',$user->id)->get();
        $ausencias= ausencias::where('biuser',$user->bi)->where('start','like',date('Y').'%')->get();
        $tasksPendentes=task::where('fk_tecnico',$user->id)->where('tipo',2)->whereIn('fk_estadoIntervencao',array(1,4))->where('tipo',2)->orderBy('start_date','desc')->get();
        $tasksEmPausa=task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',5)->where('tipo',2)->orderBy('start_date','desc')->get();
        $tasksConcluidas=task::where('fk_tecnico',$user->id)->where('fk_estadoIntervencao',3)->orWhere('fk_estadoIntervencao',7)->where('tipo',2)->orderBy('start_date','desc')->get();
        $todolist=todolist:: where('fk_user',$user->id)->get();
        $notificacoes= DB::table('notificacoes')->where('fk_user',$user->id)->get();
        $queryString = $_SERVER['QUERY_STRING'];
        if ($queryString!=null) {
            $active_tab = $queryString;
        }else {
            $active_tab = "info";
        }
        
        $hoje=Carbon::now();
      
        $inicioSemana= Carbon::parse($hoje->weekday(1))->format('Y-m-d ');
        $fimSemana= $hoje->weekday(5)->format('Y-m-d ');
       $ponto = ponto::where('ccuser', $user->bi)->whereBetween('data',[$inicioSemana,$fimSemana])->get();
       $totalsemana=0;
       for ($i=0; $i < count($ponto); $i++) { 
          $totaldia[$i]= Carbon::parse($ponto[$i]->totalDia)->diffInSeconds(Carbon::parse('00:00:00'));
          $totalsemana=$totalsemana+$totaldia[$i];
       }
        $totalsemanal= intval( $totalsemana/3600).':'. gmdate("i:s", $totalsemana); 
        $horario = horario::where('pk_horario',$user->fk_horario)->get();
        $t= Carbon::parse($horario[0]->horasDiarias)->diffInSeconds(Carbon::parse('00:00:00'));
        $totPrev= $t*5;
        $totalPrevisto= intval( $totPrev/3600).':'. gmdate("i:s", $totPrev); 

        $saldohoras=userscomuns::where('BI',$user->bi)->value('saldo');
        $projeto = projeto::where('fk_responsavel', $user->id)->get();

        return view('ver/user', compact('user','userscomuns','ausencias','saldohoras','active_tab','notificacoes','totalsemanal','horario','totalPrevisto','tasksPendentes','tasksEmPausa','tasksConcluidas','todolist','etapas','notificacoes','projeto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    function validaNIF($nif, $ignoreFirst=true) {
        //Limpamos eventuais espaços a mais
        $nif=trim($nif);
        //Verificamos se é numérico e tem comprimento 9
        if (!is_numeric($nif) || strlen($nif)!=9) {
            return 0;
        } else {
            $nifSplit=str_split($nif);
            //O primeiro digíto tem de ser 1, 2, 5, 6, 8 ou 9
            //Ou não, se optarmos por ignorar esta "regra"
            if (
                in_array($nifSplit[0], array(1, 2, 5, 6, 8, 9))
                ||
                $ignoreFirst
            ) {
                //Calculamos o dígito de controlo
                $checkDigit=0;
                for($i=0; $i<8; $i++) {
                    $checkDigit+=$nifSplit[$i]*(10-$i-1);
                }
                $checkDigit=11-($checkDigit % 11);
                //Se der 10 então o dígito de controlo tem de ser 0
                if($checkDigit>=10) $checkDigit=0;
                //Comparamos com o último dígito
                if ($checkDigit==$nifSplit[8]) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }
    public function edit($id)
    {   
      $user = user::find($id);
       $userscomuns=  userscomuns::where('BI',$user->bi)->get();
       $empresas=empresascomuns::orderBy('nomeAbreviado','ASC')->pluck('nomeAbreviado','NIF');
        $departamentos = departamento::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_departamento');
        $nivel=nivelAcesso::orderBy('nivel','ASC')->pluck('nivel','pk_nivelAcesso');
        $horarios = horario::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_horario');
        $cargos = cargo::where('visivel',1)->orderBy('descricao','ASC')->pluck('descricao','pk_cargo');

        return view('editar/user', compact('user', 'cargos', 'departamentos', 'horarios','nivel','userscomuns','empresas'));
    }

 

    /**LOG UPDATE USER
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


  
        $validator = Validator::make($request->all(), [
          
         
       
        ]);
       

        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/editaruser/'.$id)->withInput()->withErrors($validator);
        }

        $user = user::find($id);
        $name=$request->nomeCompleto;

        $temp = explode(" ",$name);

        $nomeAbreviado = $temp[0] . " " . $temp[count($temp)-1];
        $user->subcontratado=$request['simNao'];
        $user->sigla = $request['sigla'];
     
        $user->name = $nomeAbreviado;
        $user->skype=$request->skype;
        $user->nomeCompleto =$request->nomeCompleto;
        $user->email = $request['email'];
        if($request->foto!=null){
         if($request->hasFile('foto'))
            
            {
                if(File::exists($user->foto)) {
                    File::delete($user->foto);
                }
            $user->foto= $request->file('foto')->store('users','public');
            }
         else{
  
            if ($request['sexo']==1) {
                $user->foto="users/homem.png";
              }else {
               $user->foto="users/mulher.png";
           }
        }
        }
        $user->dtnsc = $request['dtnsc'];
        $user->morada = $request['morada'];
        $user->sexo = $request['sexo'];
        $user->emailPessoal = $request['emailPessoal'];
        $user->contactoPessoal = $request['contactoPessoal'];
       
        $horasdiarias= horario::where('pk_horario',$request->fk_horario)->value('horasDiarias');

        $horassemana= (Carbon::parse($horasdiarias)->diffInSeconds(Carbon::parse('00:00:00'))*5)/3600;
        $valorhora = ($request->salarioBase * 12)/(52 * ($horassemana));
         $user->custoHora = number_format($valorhora , 2);
        
         $user->iban=$request->iban;
        $user->salarioBase=$request->salarioBase;
        $user->validadecc=$request->validade;
        $user->cartaConducao=$request->cartaConducao;
        $user->estadoCivil=$request->estadoCivil;
        $user->numeroFilhos=$request->numeroFilhos;



        $user->bi = $request['bi'];
        $user->contactoProfissional = $request['contactoProfissional'];
        $user->contactoEmergencia = $request['contactoEmergencia'];
        $user->segSocial = $request['segSocial'];
        $user->nif = $request['nif'];
        $user->visivel = $request['visivel'];
        $user->skype = $request['skype'];
        $user->dataInicioContrato = $request['dataInicioContrato'];
        $user->dataFimContrato = $request['dataFimContrato'];
        $user->fk_horario = $request['fk_horario'];
        $user->fk_departamento = $request['fk_departamento'];
        $user->fk_cargo = $request['fk_cargo'];
        $user->fk_horario = $request['fk_horario'];
        $user->fk_nivelAcesso = $request['fk_nivelAcesso'];
        $user->nifEmpregador = $request['nifEmpregador'];
        if( $request['password'] == null){
            $user->save();
        }else{
            $user->password =bcrypt($request['password']);
            $user->save();
        }
        $userscomuns=  userscomuns::where('BI',$user->bi)->get();
        $saldoseg=Carbon::parse(str_replace("-","",$request->saldo))->format('H:i:s');
        $userscomuns[0]->saldo=Carbon::parse($saldoseg)->diffInSeconds(Carbon::parse('00:00:00'));
        $userscomuns[0]->anoAnt=$request->anoAnt;
        $userscomuns[0]->ano=$request->ano;
        $userscomuns[0]->anoProx=$request->anoProx;
        $userscomuns[0]->sigla = $request['sigla'];
        $userscomuns[0]->visivel = $request['visivel'];
        $userscomuns[0]->save();


        return Redirect::to('/veruser/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
         $user=user::where('id','>',1)->get();
         $ponto= ponto::where('data',  date('Y-m-d'))->where('empresapicagem',empresa::where('visivel',1)->value('NIF'))->get();
        $almoco=[];
        $manha=[];
        $tarde=[];
        $ausente=[];
        $saida=[];
        $tasks=[];

 
        for ($i=0; $i <count($user) ; $i++) { 
        
        for ($a=0; $a <count($ponto) ; $a++) {
            $updated_at= 0; 
            if ($user[$i]->bi==$ponto[$a]->ccuser) {
               if(strpos( $ponto[$a]->updated_at,date('Y-m-d '))!==false) {
                $updated_at=1;
               }  
               else {
                $updated_at=0;
               }
         
                if ($ponto[$a]->saidaManha!=null and $ponto[$a]->entradaTarde!=null and $ponto[$a]->saidaTarde!=null and $updated_at==1 and $ponto[$a]->fk_tipo!=7  ) {
             
                    $saida[]=['name' => $user[$i]->name, 'foto'=> $user[$i]->foto, 'sigla'=> $user[$i]->sigla, 'estado'=>1];
                }
                elseif($ponto[$a]->saidaManha==null and $ponto[$a]->entradaTarde==null and $ponto[$a]->saidaTarde==null)
                    {
                        $manha[]=['name' => $user[$i]->name, 'foto'=> $user[$i]->foto, 'sigla'=> $user[$i]->sigla, 'estado'=>1];
                       
                    }
                    elseif($ponto[$a]->saidaManha!=null and $ponto[$a]->entradaTarde==null and $ponto[$a]->saidaTarde==null)
                    {
                        $almoco[]=['name' => $user[$i]->name, 'foto'=> $user[$i]->foto, 'sigla'=> $user[$i]->sigla, 'estado'=>1];
                    }
                    elseif($ponto[$a]->saidaManha!=null and $ponto[$a]->entradaTarde!=null and $ponto[$a]->saidaTarde==null )
                    {
                         $tarde[]=['name' => $user[$i]->name, 'foto'=> $user[$i]->foto, 'sigla'=> $user[$i]->sigla, 'estado'=>1];
                    }

            }
            else{
               
            }
        } 

        $ausente = user::where('visivel',1)->whereNotIn('id',[22,23])->where('updated_at', 'NOT LIKE', date('Y-m-d' .'%'))->get();
        
        $tasks=
        ausencias::where('estado',1)->Where(function ($query) {
            $query->whereDate('start', '<=', date('Y-m-d').'%')
                  ->whereDate('end','>=', date('Y-m-d').'%');
        })->orderBy('start')->get();
      

        }
 
        return view('ver/status', compact('manha','almoco','tarde','saida','ausente','tasks'));
    }
    public function colaboradoresall(){


        $user=user::where('id','>',1)->where('visivel',1)->get();

          
        return view('mostrar/colaboradoresall', compact('user'));
    }
}
