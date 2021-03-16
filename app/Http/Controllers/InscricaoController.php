<?php

namespace App\Http\Controllers;

use App\inscricao;
use App\formacoes;
use App\User;
use Redirect;
Use auth;
Use Carbon\carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;


class InscricaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inscricaoformacao(Request $request)
    { 
      
        $data=carbon::now()->format('Y-m-d H:i:s');
        //$users = user::get();
         $users = user::where('visivel',1)->pluck('name', 'id');
        //  $formacoes = formacoes::where('visivel',1)->pluck('nome_formacao', 'pk_formacao');
         $formacoes = formacoes::find($request->id);

         // $users = users::all();
         // $users = user::where('id','>',1)->get();
 
         return view('criar/inscricao',compact('users','formacoes','data'));
    }



    public function mostrarinscricao(Request $request)
    { 
      
        $inscricao2=[];
        // carbon::now()->format('Y-m-d H:i:s');
         $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
    // return $id;
      $formacoes = formacoes::find($id);

         $inscricao = inscricao::where('fk_formacao',$id)->leftjoin('formacoes','pk_formacao','fk_formacao')->leftjoin('users','id','fk_user')->get();

         for ($e=0; $e < count($inscricao); $e++) { 
     
            $inscricao2[]= $inscricao[$e]->fk_user;
         
      } 
      if ($formacoes->fk_formador==null) {
        $formacoes->fk_formador=0;
      }
     
                 
      $users = user::where('visivel',1)->pluck('name', 'id');  
      $naoinscritos = user::where('visivel',1)->whereNotIn('id',$inscricao2)->whereNotIn('id',array($formacoes->fk_formador))->get(); 
     


         return view('mostrar/inscricao',compact('inscricao','formacoes','naoinscritos'));
    }


    public function inseririnscricao(Request $request)
    { 
        
        $formacao=formacoes::find($request->id_formacao);

        $inscritos=inscricao::where('fk_formacao',$request->id_formacao)->get();


        if ($formacao->numero_vagas<= count($inscritos)) {

            \Session::flash('danger', 'A Formação encontra-se cheia de momento, por favor tente mais tarde! ');     
            return Redirect::to('/inscricao')->with(['id'=> $inscritos[0]->fk_formacao]);
      
         }else{

        $inscricao = new inscricao;

        $inscricao->fk_user = $request->id_inscrito;

        $inscricao->fk_formacao = $request->id_formacao;

        $inscricao->data_inscricao =carbon::now()->format('Y-m-d H:i:s');


        $inscricao->save();

        // $totalvagas=$formacao->numero_vagas;

        // for ($i=$totalvagas; $i < count($inscritos); $i++) { 

        //     $totalvagas--;

        //  }

        return Redirect::to('/inscricao')->with(['id'=>$inscricao->fk_formacao]);

         }
     

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = user::where('visivel',1)->pluck('name', 'id');

        
        //$formacoes = formacoes::pluck('nome_formacao', 'pk_formacao');
        $formacoes = formacoes::find($request->id);

        return view('criar/inscricao',compact('formacoes','users'));

    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $formacao=formacoes::find($request->fk_formacao);
        $inscritos=inscricao::where('fk_formacao',$request->fk_formacao)->get();
             
        return count( $inscritos);
               
                
        $inscricao = new inscricao;

        $inscricao->fk_user = $request['fk_user'];

        // $inscricao->fk_formacao = $request['fk_formacao'];
        $inscricao->fk_formacao = $request['fk_formacao'];
        // $inscricao->fk_formacao = $request['nome_formacao'];
   

        $inscricao->data_inscricao = $request['data_inscricao'];

        $inscricao->avaliacao_user = $request['avaliacao_user'];

        $inscricao->avaliacao_formador = $request['avaliacao_formador'];

    //     for ($e=0; $e < count($inscricao); $e++) { 
     
    //         $inscricao2[]= $inscricao[$e]->pk_inscricao;
                    
    //    }

    //    if ($inscricao2 > $formacao->numero_vagas) {
    //        return "bbb";
    //        // return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')->withInput();

    //    }
    //    else{
    //        $inscricao->save();
    //        return Redirect::to('/calendario');
    //    }

        $inscricao->save();

 
        return Redirect::to('/calendario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function show(inscricao $inscricao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function edit(inscricao $inscricao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inscricao $inscricao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inscricao  $inscricao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inscricao = inscricao::find($request->id); 
        $inscricao->delete();    
        return Redirect::to('/inscricao')->with(['id'=>$inscricao->fk_formacao]);
    }
}
