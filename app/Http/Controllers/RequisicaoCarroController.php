<?php

namespace App\Http\Controllers;

use App\requisicaocarro;
use App\Salas;
use App\equipamentos;
use App\Notificacoes;
use App\veiculos;
use App\user;
use App\Empresa;
use App\usersComuns;
use App\empresasComuns;
use App\CustosExtraProjeto;
use App\Task;
use App\Event;
use App\Projeto;
use App\Cliente;
use App\RequisicaoEquipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use auth;
use DB;
use Validator;

use Session;
use Barryvdh\DomPDF\Facade as PDF;
class RequisicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function requisicoescarro()
    {
        $requisicao = requisicaocarro::get();
        return view('mostrar/requisicaocarro', compact('requisicao'));
    }
        
    public function requisicoesequipamento()
    {
        $requisicao = requisicaoequipamento::get();
        return view('mostrar/requisicaoequipamento', compact('requisicao'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRequisicaoSala()
    {
        $user = user::where('id','>',1)-> where('visivel',1)->pluck('name','id');
        $sala = salas::pluck('nome','pk_sala');
        return view('criar/requisicaoSala', compact('user','sala'));
    }

    public function createRequisicaoEquipamento()
    {    
        $users = userscomuns::where('requisicaoEquipamento',0)->where('visivel',1)->orderBy('nome','ASC')->pluck('nome','BI');
        $equipamento = equipamentos::where('codigo', 'like', 'Cpu%')->where('requisitado',0)->orderby('codigo')->pluck('codigo','codigo');
        $periferico = equipamentos::where('codigo', 'like', 'Peri%')->where('requisitado',0)->orderby('codigo')->pluck('codigo','codigo');
        return view('criar/requisicaoequiamento', compact('users','equipamento','periferico'));
    }

    public function createRequisicaocarro()
    {   $veiculo = veiculos::pluck('descricao','pk_veiculo');
        $tasks = Task::where('tipo',1)->where('progress','!=','1.00')->leftjoin('projetos','pk_projeto','fk_projeto')->whereIn('fk_estadoproj', [1, 3])->get(); 
        $user=user::where('id',auth::id())->value('name');
        $users=user::where('visivel',1)->where('id','!=',auth::id())->orderBy('name','ASC')->pluck('name','bi');

        return view('criar/requisicaocarro',compact('user','veiculo','users','tasks'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRequisicaoSala(Request $request)
    {
        $requisicao = new requisicao;
        $requisicao->motivo = $request->motivo;
        $requisicao->data = $request->data;
        $requisicao->validado = 0;
        $requisicao->horaInicio = $request->horaInicio;
        $requisicao->horaFim = $request->horaFim;
        $requisicao->requisitadoPor = $request->requisitadoPor;
        $requisicao->fk_sala = $request->fk_sala;
        $requisicao->save();
        return Redirect::to('/requisicoes');
    }

    public function storeRequisicaoEquipamento(Request $request)
    {
        
      if(sizeof($request->peri)==1){
          if( $request->peri[0]==""){
              $temperiferico=0;
          }
          else {
            $temperiferico=1;
          }
      }else {
        $temperiferico=1;
      }
     
        $requisicaoequipamento = new requisicaoequipamento;
        if (strlen($request->requisitadoPor)==7) {
            $requisicaoequipamento->requisitadoPor = "0".$request->requisitadoPor;
        }else {
            $requisicaoequipamento->requisitadoPor = $request->requisitadoPor;
        }
        
        $userscomuns=userscomuns::where('BI',$request->requisitadoPor)->get();
        $userscomuns[0]->requisicaoEquipamento=1;
        $userscomuns[0]->save();
        $requisicaoequipamento->dataInicio= $request->dataInicio;
        $requisicaoequipamento->cpu= $request->cpu;
        $equipamento=equipamentos::where('codigo', 'like',$request->cpu)->get();
        $equipamento[0]->requisitado=1;
        $equipamento[0]->save();
        $requisicaoequipamento->observacoes= $request->notas;
        if ($temperiferico==1){
            for ($i=0; $i < sizeof($request->peri); $i++) { 
                $periferico=equipamentos::where('codigo', 'like',$request->peri[$i])->get();
                $periferico[0]->requisitado=1;
                $periferico[0]->save();
            }
            
        $requisicaoequipamento->peri=implode(",",$request->peri);
     }
         $requisicaoequipamento->save();
         \Session::flash('success', 'Requisição guardada');

         return Redirect::to('/requisicoesequipamento');
    }

    public function storeRequisicaoCarro(Request $request)
    {
        // ver se carro está disponivel 


        $req=requisicaocarro::where('fk_veiculo',$request->fk_veiculo)->where('dataPartida', $request->dataPartida)->get();
        if(count($req)>0){

            
            $chegadaRequisicaoA=carbon::parse($req[0]->chegadaPrevista)->diffInSeconds(Carbon::parse('00:00:00')); 
            $partidaRequisicaoN=carbon::parse($request->partidaPrevista)->diffInSeconds(Carbon::parse('00:00:00'));

                    if ($chegadaRequisicaoA>= ($partidaRequisicaoN)) {
                    
                        return Redirect::back()->with('warning', 'Existe uma requisição para a data:  '. $request->dataPartida. ' | Partida '.$req[0]->partidaPrevista. ' - Chegada: '. $req[0]->chegadaPrevista.' | Rota: '. $req[0]->rota. ' | Requisitante: '. userscomuns::where('BI',$req[0]->requisitadoPor)->value('nome'))->withInput();
                    
                    }


        }
    $partida =Carbon::parse($request->partidaPrevista)->diffInSeconds(Carbon::parse('00:00:00'));
    $chegada=  Carbon::parse($request->chegadaPrevista)->diffInSeconds(Carbon::parse('00:00:00'));
    if($partida>$chegada){
      return Redirect::back()->with('warning', 'Hora de chegada tem de ser superior à hora de partida.')->withInput();
    }

                // ver se não excede a lotção do carro 
                $pass=sizeof($request->ocupantes)+1;
            $veicu=veiculos::where('pk_veiculo', $request->fk_veiculo)->get();
            if ($pass>$veicu[0]->capacidade) {
                return Redirect::back()->with('warning', 'Atenção excedeu a capadidade do veiculo: '.$veicu[0]->capacidade .
                ' passageiros. A sua reserva contém: '.$pass . ' ocupantes')->withInput();
 
            }
          

        $ocupantes="";
        $requisicaocarro = new requisicaocarro;
        $requisicaocarro->requisitadoPor = user::where('id',auth::id())->value('bi');

        $requisicaocarro->dataPartida= $request->dataPartida;
        $requisicaocarro->partidaPrevista= $request->partidaPrevista;
        $requisicaocarro->chegadaPrevista= $request->chegadaPrevista;
        $requisicaocarro->rota= $request->rota;
        $requisicaocarro->notas= $request->notas;

        if(sizeof($request->ocupantes)==1){
            if( $request->ocupantes[0]==""){
                $temocupantes=0;
            }
            else {
              $temocupantes=1;
            }
        }else {
          $temocupantes=1;
        }
 



        if ($temocupantes==1) {
        
            for ($o=0; $o <sizeof($request->ocupantes) ; $o++) { 
                if($o<sizeof($request->ocupantes)-1){
                    $ocupantes= $ocupantes.  $request->ocupantes[$o]. ' , ';
                }else {
                    $ocupantes= $ocupantes.  $request->ocupantes[$o];
                }
        
        }
    
        }

        $requisicaocarro->ocupantes= $ocupantes ;
        $requisicaocarro->fk_veiculo= $request->fk_veiculo;
        $requisicaocarro->save();
      
        if (sizeof($request->sprints)==1) {
         
        }
        else {
        for ($i=1; $i <sizeof($request->sprints) ; $i++) { 
            $sprint[$i]=task::where('id',$request->sprints[$i])->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('empresas','pk_empresa','fk_empresa')->get();
      
            $custosextra = new custosextraprojeto;
            $custosextra->nomeProjeto= projeto::where('pk_projeto', $sprint[$i][0]->fk_projeto)->value('nomeProjeto') . ' ('. cliente::where('pk_cliente',  $sprint[$i][0]->fk_cliente)-> value('nomeAbreviado').')';
            $custosextra->nomeSprint= $sprint[$i][0]->text;
            $custosextra->fk_projeto= $sprint[$i][0]->fk_projeto;
            $custosextra->fk_sprint= $sprint[$i][0]->id;
            $custosextra->descricao= 'Deslocação no dia: '. $requisicaocarro->dataPartida;
            $custosextra->processado=0;
            $custosextra->custo=0;
            $custosextra->fk_requisicao=   $requisicaocarro->pk_requisicao;
            $custosextra->fk_empresa=empresascomuns::where('NIF', $sprint[$i][0]->NIF)->value('pk_empresa');
             $custosextra->save();

      
          }
         }
  
     
      $rh=user::where('fk_departamento',3)->where('visivel',1)->get('id');
       for ($r=0; $r < count($rh); $r++) { 
        $notificar= new notificacoes();
        $notificar->descricao='Requisição de carro por aprovar.';
        $notificar->fk_tipoNotificacao=5;
        $notificar->fk_user=$rh[$r]->id;
        $notificar->save();
       }
        
        \Session::flash('success', 'O Veiculo foi requisitado, aguarda aprovação');

        return Redirect::to('/requisicoescarro');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function showRequisicaoSala(requisicao $requisicao)
    {
        //
    }

    public function termo(Request $request)
    { 
        $requisicaoequipamento= requisicaoequipamento::find($request->id);
        $userscomuns=userscomuns::where('BI',$requisicaoequipamento->requisitadoPor)->get();
        $empresa=empresa::where('visivel',1)->get();
        $equipamento=equipamentos::where('codigo', 'like',$requisicaoequipamento->cpu)->get();
        if ($requisicaoequipamento->peri!=null){
            $peris= explode(",", $requisicaoequipamento->peri);
             for ($i=0; $i < sizeof($peris); $i++) { 
                 $periferico[$i]=equipamentos::where('codigo', 'like',$peris[$i])->get();
                
             }
          
         }


         $temp = explode(" ",$empresa[0]->morada);

         $localizacao =  $temp[count($temp)-1];

        //  $html = ->render();
         $css = file_get_contents(public_path('css/app.css'));
        //  $file = $cssToInlineStyles->convert($html, $css);
        //  $pdf->loadHtml($file, $css);


         $pdf = PDF::loadView('ver/termoresponsabilidade', compact('periferico','localizacao','requisicaoequipamento','userscomuns','empresa','equipamento'))->setPaper('a4', 'portrait');
         return $pdf->stream();
  
    }

    public function showRequisicaoVeiculo(requisicao $requisicao)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function editRequisicaoSala(requisicao $requisicao)
    {
        //
    }



    public function editRequisicaoVeiculo(requisicao $requisicao)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function updateRequisicaoSala(Request $request, requisicao $requisicao)
    {
        //
    }

   
    
    public function updateRequisicaoVeiculo(Request $request)
    {
    
    
    }


    public function pararRequisicaoequipamento(Request $request){
        $requisicaoequipamento= requisicaoequipamento::find($request->id);

        $userscomuns=userscomuns::where('BI',$requisicaoequipamento->requisitadoPor)->get();
        $userscomuns[0]->requisicaoEquipamento=0;
        $userscomuns[0]->save();
        $requisicaoequipamento->dataFim= date('Y-m-d');
        $equipamento=equipamentos::where('codigo', 'like',$requisicaoequipamento->cpu)->get();
        $equipamento[0]->requisitado=0;
        $equipamento[0]->save();
        if ($requisicaoequipamento->peri!=null){
           $peris= explode(",", $requisicaoequipamento->peri);
            for ($i=0; $i < sizeof($peris); $i++) { 
                $periferico=equipamentos::where('codigo', 'like',$peris[$i])->get();
                $periferico[0]->requisitado=0;
                $periferico[0]->save();
            }
         
        }
        $requisicaoequipamento->save();
        \Session::flash('success', 'Requisição guardada');

        return Redirect::to('/requisicoesequipamento');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\requisicao  $requisicao
     * @return \Illuminate\Http\Response
     */
    public function requisicaocarroapagar(Request $request)
    {
      
     $requisicao = requisicaocarro::find($request->id); 
      $event= Event::where('start_date', $requisicao->dataPartida . ' '. $requisicao->partidaPrevista)->where('subject',7)->where('text','like','Reserva veiculo: '. DB::connection('geraltg')->table('veiculos')->where('pk_veiculo',$requisicao->fk_veiculo)->value('descricao'). "%" )->get() ;
     if (count($event)>0) {
        $event[0]->delete();
     }
     $custosextra= custosextraprojeto::where('fk_requisicao',$request->id)->get();

     for ($i=0; $i <count($custosextra) ; $i++) { 
      
      $custosextra[$i]->delete();
     }
     $requisicao->delete();


     return Redirect::to('/requisicoescarro')->with('Success', 'Requisição Removida')->withInput();

    }
    public function requisicaocarroaprovar(Request $request){
        $requisicao = requisicaocarro::find($request->aprovar);
        $requisicao->validado=1; 
        $requisicao->aprovadoPor=  user::where('id',auth::id())->value('name');
        $requisicao->save();
 
       
        $notificar= new notificacoes();
        $notificar->descricao='A requisição de viatura para o dia: '.$requisicao->dataPartida. ' foi aprovada.';
        $notificar->fk_tipoNotificacao=5;
        $notificar->fk_user=user::where('bi',$requisicao->requisitadoPor)->value('id');
        $notificar->save();


        $event=new Event();
        $bi=(explode(',',$requisicao->ocupantes));
        for ($i=0; $i < sizeof(explode(',',$requisicao->ocupantes)); $i++) { 
           
             $sigla[]= ' '. userscomuns::where('BI',$bi[$i])->value('sigla');
          
       }

        $event->text = 'Reserva veiculo: '. DB::connection('geraltg')->table('veiculos')->where('pk_veiculo',$requisicao->fk_veiculo)->value('descricao'). ' | Rota: '. $requisicao->rota.
      ' | Requisitado por: ' . userscomuns::where('BI',$requisicao->requisitadoPor)->value('sigla').  ' | Ocupantes: '.implode(",",$sigla) ;
        $event->start_date =    $requisicao->dataPartida . ' '. $requisicao->partidaPrevista ;
        $event->end_date = $requisicao->dataPartida . ' '. $requisicao->chegadaPrevista ;
        $event->subject = 7;    
        $event->fk_tecnico=0;
        $event->obs = null;
        $event->localizacao = null;
        $event->save();
        return Redirect::to('/requisicoescarro')->with('Success', 'Requisição Aceite')->withInput();
     }
     public function requisicaocarroreprovar(Request $request){

        $requisicao = requisicaocarro::find($request->reprovar);
        $requisicao->aprovadoPor=  user::where('id',auth::id())->value('name');

        $requisicao->validado=2;
        $requisicao->save();
        
        $notificar= new notificacoes();
        $notificar->descricao='A requisição de viatura para o dia: '.$requisicao->dataPartida. ' foi reprovada.';
        $notificar->fk_tipoNotificacao=5;
        $notificar->fk_user=user::where('bi',$requisicao->requisitadoPor)->value('id');
        $notificar->save();
         return Redirect::to('/requisicoescarro')->with('warning', 'Requisição Reprovada')->withInput();
     }
     
     public function requisicaocarrover(Request $request){
      
        $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
        $requisicao = requisicaocarro::find($id);
         $veiculo = veiculos::find($requisicao->fk_veiculo);
         $user=userscomuns::where('BI',$requisicao->requisitadoPor)->get();
        $custosextra= custosextraprojeto::where('fk_requisicao',$id)->leftjoin('empresascomuns','pk_empresa','fk_empresa')->get();


        return view('ver/requisicaocarro',compact('user','veiculo','requisicao','custosextra'));
     }

     public function requisicaocarroeditar(Request $request){
        $requisicao = requisicaocarro::find($request->id);
        $veiculo = veiculos::pluck('descricao','pk_veiculo');
        $tasks = Task::where('tipo',1)->where('progress','!=','1.00')->leftjoin('projetos','pk_projeto','fk_projeto')->whereIn('fk_estadoproj', [1, 3])->get(); 
        $user=user::where('id',auth::id())->value('name');
        $users=user::where('visivel',1)->where('id','!=',auth::id())->orderBy('name','ASC')->pluck('name','bi');
        $custosextra= custosextraprojeto::where('fk_requisicao',$request->id)->leftjoin('empresascomuns','pk_empresa','fk_empresa')->where('NIF',empresa::where('pk_empresa',1)->value('NIF'))->get();
        return view('editar/requisicaocarro',compact('user','veiculo','users','tasks','requisicao','custosextra'));
        
    }
    public function requisicaocarropartida(Request $request){
         $requisicao = requisicaocarro::find($request->id);
         $requisicao->localPartida=$request->localPartida;
         $requisicao->horaPartida= $request->partidaPrevista;
         $requisicao->kmIniciais=$request->kmsIniciais;
         $requisicao->save();
         return Redirect::to('/requisicaocarrover')->with('Success', 'Partida Registada')->withInput()->with(['id'=>$request->id]);

    }
    public function requisicaocarrochegada(Request $request){
        $requisicao = requisicaocarro::find($request->id);
        $requisicao->localChegada=$request->localChegada;
        $requisicao->horaChegada= $request->chegadaPrevista;
        $requisicao->kmFinais=$request->kmsFinais;
        $requisicao->kmtotal=$request->kmsFinais-  $requisicao->kmIniciais;
        $requisicao->save();
        $veiculo = veiculos::find($requisicao->fk_veiculo);
        $veiculo->localizacao= $requisicao->localChegada;
        $veiculo->kms =  $requisicao->kmFinais;
        $veiculo->save();
        return Redirect::to('/requisicaocarrover')->with('Success', 'Partida Registada')->withInput()->with(['id'=>$request->id]);
     }

     public function  requisicaocarroregistos(Request $request){
        $requisicao = requisicaocarro::find($request->id);

        // $validator =  Validator::make($request->all(), [
        //     //'autonomiaFinal' => 'required|max:8',
        //      'gastosCombustivel' => 'required|max:8',
        //     // 'gastosPortagens' => 'required|max:8',
        //     // 'gastosEstacionamento' => 'required|max:8',
        //     // 'gastosOutros' => 'required|max:8'
        //     ]);
        //     if($validator->fails()){
        //         \Session::flash('warning','Por favor preencha corretamente os campos assinalados.');
        //         return Redirect::to('/requisicaocarrover')->withInput()->with(['id'=>$request->id])->withErrors($validator);
        //     }
        $requisicao->autonomiaFinal=$request->autonomia;
        $requisicao->gastosCombustivel= $request->gasolina;
        $requisicao->gastosPortagens= $request->portagens;
        $requisicao->gastosEstacionamento= $request->estacionamento;
        $requisicao->gastosOutros=$request->outros;
        $requisicao->validado=3;

        if(is_numeric($requisicao->autonomiaFinal) && is_numeric($requisicao->gastosCombustivel) && is_numeric($requisicao->gastosPortagens) && is_numeric($requisicao->gastosEstacionamento) && is_numeric($requisicao->gastosOutros)){

             $requisicao->save();
        }else{
            
            \Session::flash('warning','Por favor, insira os valores corretamente, se precisar de inserir cêntimos, insira com " . ", por exemplo -> "200.25"');
            return Redirect::to('/requisicaocarrover')->withInput()->with(['id'=>$request->id]);


        }

  

        $veiculo = veiculos::find($requisicao->fk_veiculo);
        $veiculo->localizacao= $requisicao->localChegada;
        $veiculo->kms =  $requisicao->kmFinais;
        $veiculo->autonomia = $requisicao->autonomiaFinal;
        $veiculo->save();
        // custos totais da deslocacao 
        $custos=  $requisicao->kmtotal*$veiculo->valorKm + $requisicao->gastosPortagens+ $requisicao->gastosEstacionamento+  $requisicao->gastosOutros+ $requisicao->gastosCombustivel;
        // dividir custos pelos projetos 
        
        $custosextra = custosextraprojeto::where('fk_requisicao',$requisicao->pk_requisicao)->get();
        if (count($custosextra)>0) {
           
        
        $custosporsprint=$custos/count($custosextra);
        for ($i=0; $i <count($custosextra) ; $i++) { 
            $custosextra[$i]->custo=$custosporsprint;
            $custosextra[$i]->save();
        }
      }

        return Redirect::to('/requisicaocarrover')->with('Success', 'Requisicao Registada')->withInput()->with(['id'=>$request->id]);
     }

    





 }




