<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Departamento;
use App\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\carbon;


class AlertController extends Controller
{
    /**
     * CONTROLADOR PARA AS NOTICIAS
     *
     * @return \Illuminate\Http\Response
     */
    public function mostranoticias()
    {
        
     $noticia=alert::get();
     return view('mostrar/noticia', compact('noticia'));
    }
    public function mostranoticiasproprias()
    {
        
     $noticia=alert::where('fk_user', auth::id())->get();
     return view('mostrar/noticiauser', compact('noticia'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criar/noticia');
    }

    /**
     * GRAVAR NOTICIA 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $first = carbon::parse($request->inicio);
        $second = carbon::parse($request->fim);
        if ($first->greaterThan($second))
        {
            return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
                ->withInput();

        }
        
       $user=user::find(auth::id());
       $departamento=departamento::where('pk_departamento', $user->fk_departamento)->value('abreviatura');
            $alert = new alert;
            $alert->mensagem = 'Departamento de '.$departamento. ' informa: '.$request['mensagem'];
            $alert->de = $request['inicio'];
            $alert->a = $request['fim'];
            $alert->todos = 1;
            $alert->users = 1;
            $alert->fk_departamento=$user->fk_departamento;
            $alert->fk_user=auth::id();
       
            $alert->save();
      
     
            \Session::flash('success', 'A mensagem '. $request->mensagem .' foi criada com sucesso');
    
            // escrever log 
            return Redirect::to('/registo');
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $noticia = alert::find($request->id);
        return view('editar/noticia', compact('noticia'));
    }

    /**
     * EDITAR NOTICIA 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        $user=user::find(auth::id());
        $alert = alert::find($request->pk_alerta);
        $alert->mensagem = $request['mensagem'];
        $alert->de = $request['inicio'];
        $alert->a = $request['fim'];
        $alert->todos = 1;
        $alert->users = 1;
        $alert->fk_departamento=$user->fk_departamento;
        $alert->fk_user=auth::id();
    
        $alert->save();
  
 
        \Session::flash('Success', 'A mensagem '. $alert->mensagem .' foi criada com sucesso');

        // escrever log 
        return Redirect::to('/registo');
    
        
    }

    /**
     * APAGAR NOTICIA 
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function apagar(Request $request)
    {
     $noticia= alert::find($request->id);
     $noticia->delete();
     \Session::flash('success', 'A mensagem '. $noticia->mensagem .' foi apagada com sucesso');
    
     // escrever log 
     return Redirect::to('/registo');
 
    }
}
