<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Empresa;
use App\DepEmp;
use App\User;
use App\Task;
use Validator;
use App\ProjDep;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;

class departamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $departamento = departamento::where('visivel',1)->get();        
  
        return view('mostrar/listadepartamento', compact('departamento'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('criar/departamento');
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
            'descricao' => 'required',
            'abreviatura' => 'required',
         
            
        ]);
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/novodepartamento')->withInput()->withErrors($validator);
        }
        $departamento = new departamento;
        $departamento->descricao = $request['descricao'];
        $departamento->abreviatura = $request['abreviatura'];
        $departamento->visivel = 1;
        $departamento->fk_empresa = empresa::where('visivel',1)->value('pk_empresa');
        $departamento->save();
       

        

        \Session::flash('success', 'O departamento  '. $request->descricao .' foi criado com sucesso');

        // escrever log 
        return Redirect::to('/departamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function edit($id)
    {
        $departamento = departamento::find($id);
  
        

        return view('editar/departamento', compact('departamento'));
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
            'descricao' => 'required',
            'abreviatura' => 'required',
          
            
        ]);
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/editardepartamento/'.$id)->withInput()->withErrors($validator);
        }
        $departamento = departamento::find($id);
        $departamento->descricao = $request['descricao'];
        $departamento->abreviatura = $request['abreviatura'];
    
        $departamento->save();
        \Session::flash('success', 'O departamento '. $request->descricao .' foi editado com sucesso');

        // escrever log 
        return Redirect::to('/departamentos');
       
        
    }



   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        if(count(DB::table('users')->where('fk_departamento',$id)->get())>0){
        return Redirect::to('/departamentos')->with( 'delete','Atenção: O departamento contém colaboradores, deve mover remover os colaboradores primeiro!')->withInput();
        }
         $departamento=departamento::where('pk_departamento',$id)->value('descricao');
        DB::table('departamentos')->where('pk_departamento',$id)->delete();
        \Session::flash('success', 'O departamento '.$departamento.' foi removido.');

        // escrever log 
    
       
        return Redirect::to('/departamentos');
    }
    public function listarcolaboradores($id)

    {
   


        $departamento = DB::table('departamentos')        
    
        ->where('pk_departamento',$id)
        ->get();
    
        $users = DB::table('users')->where('fk_departamento',$id)->get();
    
        return view('mostrar/colaboradorespordepartamento', compact('departamento','users'));
    }
    public function relatoriodep()

    {
        $id=user::where('id',auth::id())->value('fk_departamento');
        $departamento=departamento::find($id);
        $users = DB::table('users')->where('fk_departamento',$id)->where('visivel',1)->get();
        for ($i=0; $i < count($users); $i++) { 
            $tasksPendentes[$i]=task::where('fk_tecnico',$users[$i]->id)->where('tipo',2)->whereIn('fk_estadoIntervencao',array(1,4))->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksEmPausa[$i]=task::where('fk_tecnico',$users[$i]->id)->where('fk_estadoIntervencao',5)->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksConcluidas[$i]=task::where('fk_tecnico',$users[$i]->id)->whereIn('fk_estadoIntervencao',array(3,7))->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksEmCurso[$i]=task::where('fk_tecnico',$users[$i]->id)->where('fk_estadoIntervencao',2)->where('tipo',2)->orderBy('start_date','desc')->get();
            $tasksdia[$i]= task::where('tipo',2)->where('start_date','like',date('Y-m-d').'%' )->where('fk_tecnico',$users[$i]->id)->leftjoin('projetos','pk_projeto','fk_projeto')->leftjoin('estadointervencoes','pk_estadoIntervencoes','fk_estadoIntervencao')->orderBy('start_date')->get();
        }

        $projeto=projdep::leftjoin('projetos','projetos.pk_projeto','projdeps.fk_projeto')->leftjoin('departamentos','departamentos.pk_departamento','projdeps.fk_departamento')->where('fk_departamento',$id)->leftjoin('clientes','fk_cliente','pk_cliente')->get();

        return view('ver/perfildepartamento',compact('departamento','users','projeto','tasksPendentes','tasksEmPausa','tasksConcluidas','tasksEmCurso','tasksdia'));
    }

}
