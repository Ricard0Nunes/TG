<?php
namespace App\Http\Controllers;

use App\inscricao;
use App\formacoes;
use App\User;
use App\Notificacoes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\carbon;
use Redirect;
use App\Event;
use Validator;
use Auth;

class FormacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        // return  $users = user::where('visivel',1)->whereNotIn('id',array(1,3))->pluck('name', 'id');
    //     $inscricao=inscricao::where('fk_formacao',$request->id_formacao)->get();
    //  $inscritos=count($inscricao);

        $formacao = formacoes::get();
       
        return view('mostrar/formacao', compact('formacao', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = user::where('visivel', 1)->pluck('name', 'id');
        return view('criar/formacao', compact('users'));
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
            'numero_vagas' => 'required|integer',
            ]);

            if($validator->fails()){
                \Session::flash('warning','Preencha os campos assinaldos corretamente.');
                return Redirect::to('/newformacao')->withInput()->withErrors($validator);
            }

        $first = carbon::parse($request->dataInicio);
        $second = carbon::parse($request->dataFim);
        if ($first->greaterThan($second))
        {
            return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
                ->withInput();

        }

        $formacao = new formacoes;

        $formacao->nome_formacao = $request['nome_formacao'];

        $formacao->entidade_formacao = $request['entidade_formacao'];

        // $formacao->dataInicio = $request['dataInicio'];
        // $formacao->dataInicio =Carbon::now()->format('Y-m-d H:i:s');
        $formacao->dataInicio =  Carbon::parse($request->dataInicio)->format('Y-m-d H:i:s');

        // $formacao->dataFim = $request['dataFim'];
        // $formacao->dataFim =Carbon::now()->format('Y-m-d H:i:s');
        $formacao->dataFim =  Carbon::parse($request->dataFim)->format('Y-m-d H:i:s');

        $formacao->horas_formacao = $request['horas_formacao'];

        $formacao->local_formacao = $request['local_formacao'];

        $formacao->numero_vagas = $request['numero_vagas'];

        $formacao->interno = $request['internaExterna'];

        $formacao->eficacia_formacao = $request['eficacia_formacao'];

        $formacao->custo_formacao = $request['custo_formacao'];



        if ($request['internaExterna'] == 1)
        {
            $formacao->fk_formador = $request['fk_formador'];
        }
        else
        {

            $formacao->nome_formador = $request['nome_formador'];

        }

        $formacao->save();
     

        \Session::flash('success', 'A formação  ' . $request->nome_formacao . ' foi criado com sucesso');

        return Redirect::to('/formacao');

        
        
    }

    public function fecharformacao(Request $request)
    {
        $eventuser="";
        $formacao = formacoes::find($request->id);

        $formacao->estado=1;

        $formacao->save();

        $participantes = inscricao::where('fk_formacao', $request->id)
        ->get();

        for ($e=0; $e < count($participantes); $e++) { 
     
            $sigla[]= ' '. user::where('id',$participantes[$e]->fk_user)->value('sigla');
         
      }
    
    //   tem de ser aqui ao fechar. 
      if (count($participantes)>0) {
       $eventuser= implode("+",$sigla);
      }
     
       $event= new Event;
       $event->text = $eventuser.'->Formação: '. $formacao->nome_formacao ;
    //    precisam ter a formaçao em formato hora tambem 

    $event->start_date =  Carbon::parse($formacao->dataInicio)->format('Y-m-d H:i:s');

    //    $event->start_date = $request->diaInicio. ' '.$request->horaInicio.':00';   
    
    $event->end_date =  Carbon::parse($formacao->dataFim)->format('Y-m-d H:i:s');
    //    $event->end_date = $request->diaFim. ' '.$request->horaFim.':00';
       $event->subject = 7;    
       $event->fk_tecnico=0;
       $event->obs = null;
       $event->localizacao = null;
      
       $event->save();
      

        return Redirect::to('/formacao');

    }
    public function avaliacao(Request $request)
    {
        if ($request->id==null) {
            $request->id=Auth::id();
        }else {
            $request->id=$request->id;
        }   

        $user = user::find($request->id);

        $formacao = formacoes::leftjoin('inscricaos','formacoes.pk_formacao','inscricaos.fk_formacao')->where('inscricaos.fk_user',$user->id)->where('formacoes.estado',2)->get();

        return view('ver/formacao', compact('formacao')); 
    }

    public function mostrarformacaoindividual(Request $request)
    {
        if ($request->id==null) {
            $request->id=Auth::id();
        }else {
            $request->id=$request->id;
        }

          $user = user::find($request->id);

        $formacao = formacoes::leftjoin('inscricaos','formacoes.pk_formacao','inscricaos.fk_formacao')->where('inscricaos.fk_user',$user->id)->get();

        return view('ver/formacaoavaliacao', compact('formacao'));

    
    }
    public function terminarformacao(Request $request)
    {
     $formacao = formacoes::find($request->id);
        $formacao->estado=2;
        $formacao->save();

        $pk_user=inscricao::where('fk_formacao',$formacao->pk_formacao)->get('fk_user');
        for ($r=0; $r < count($pk_user); $r++) { 
         $notificar= new notificacoes();
         $notificar->descricao='Tem uma Formação para Avaliar.';
         $notificar->fk_tipoNotificacao=7;
         $notificar->fk_user=$pk_user[$r]->fk_user;
         $notificar->save();
        }
        return Redirect::to('/formacao');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\formacoes  $formacoes
     * @return \Illuminate\Http\Response
     */
    public function show(formacoes $formacoes)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\formacoes  $formacoes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
   
        $formacao = formacoes::find($request->id);
        $users = user::where('visivel', 1)->pluck('name', 'id');

        return view('editar/formacao', compact('formacao','users'));
        
    } 
    public function update(Request $request)
    {

        $formacao = formacoes::find($request->id);
        // return $request; 
      
        $formacao->nome_formacao = $request['nome_formacao'];
        $formacao->entidade_formacao = $request['entidade_formacao'];
        $formacao->dataInicio = $request['dataInicio'];
        $formacao->dataFim = $request['dataFim'];
        $formacao->horas_formacao= $request['horas_formacao'];
        $formacao->local_formacao = $request['local_formacao'];
        $formacao->numero_vagas = $request['numero_vagas']; 
        if ($request['internaExterna'] == 1)
        {
            $formacao->fk_formador = $request['fk_formador'];
        }
        else
        {

            $formacao->nome_formador = $request['nome_formador'];

        }
        // $formacao->eficacia_formacao = $request['eficacia_formacao'];
        $formacao->custo_formacao = $request['custo_formacao']; 

       
        
        $formacao->save();
        return Redirect::to('/formacao'); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\formacoes  $formacoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $formacao = formacoes::find($request->id);

        $inscritos = inscricao::where('fk_formacao', $request->id)
            ->get();

        if (count($inscritos) == 0)
        {

            $formacao->delete();
            \Session::flash('danger', 'Formação eliminada!!');

            return Redirect::to('/formacao');

        }
        else
        {

            \Session::flash('danger', 'Não é possível eliminar a formação, pois existe colaboradores inscritos!!');
            return Redirect::to('/formacao');
        }

    }
    public function formavaliacao(Request $request)
    {       

        
        // $users = user::where('visivel', 1)->pluck('name', 'id');
        // $user = user::find($request->id);
        $inscricao = inscricao::find($request->id);
        $formacao = formacoes::find($inscricao->fk_formacao);

      

        // return $inscricao;
        return view('criar/avaliacao', compact('formacao','inscricao'));
    }
    public function insertavalicao(Request $request, $id)
    {
      

       $inscricao = inscricao::find($id);

       $inscricao->avaliacao_user = $request['avaliacao_user'];

       $inscricao->avaliacao_formador = $request['avaliacao_formador'];

       $inscricao->observacao = $request['observacao'];

      

       $inscricao->save();

       return Redirect::to('/minhaformacao');


    }
    public function arquivarformacao(Request $request)
    {

        $formacao = formacoes::find($request->id);

        $formacao->estado=3;

        $formacao->save();
        return Redirect::to('/formacao');

    }

}

