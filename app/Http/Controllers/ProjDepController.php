<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\ProjDep;
use App\Departamento;
use App\Empresa;
use App\Http\Controllers\Controller;
use Validator;
// use Illuminate\Support\Facades\Redirect;

class ProjDepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
         $projeto=projdep::leftjoin('projetos','projetos.pk_projeto','projdeps.fk_projeto')->leftjoin('departamentos','departamentos.pk_departamento','projdeps.fk_departamento')->get();
        return view('mostrar/projetospdep', compact('projeto'));
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
    public function store(Request $request)
    {
     

        // $validator =  Validator::make($request->all(), [
            
        //     'fk_empresa' => 'required',
        //     'fk_departamento' => 'required',

    
        // ]);
        // if($validator->fails()){
        //     \Session::flash('warning','Por favor preencha os campos assinalados');
        //     return Redirect::to('/projdep')->withInput()->withErrors($validator);
        // }
        
      
        //  $projeto=projdep::leftjoin('projetos', 'projetos.pk_projeto', '=', 'projdeps.fk_projeto')
        // ->where('projetos.fk_empresa', $request->fk_empresa)
        // ->where('projdeps.fk_departamento',$request->fk_departamento )
        // ->get();
        // $departamento=departamento::where('pk_departamento',$request->fk_departamento)->value('abreviatura');
        // $empresa=empresa::where('pk_empresa',$request->fk_empresa)->value('nomeAbreviado');

        // return view('mostrar/projetospdep', compact('projeto', 'departamento','empresa'));
        // // escrever log 

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjDep  $projDep
     * @return \Illuminate\Http\Response
     */
    public function show(ProjDep $projDep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjDep  $projDep
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjDep $projDep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjDep  $projDep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjDep $projDep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjDep  $projDep
     * @return \Illuminate\Http\Response
     */
    public function removerdepproj($id,$projeto)
    {
        // ver se tem intervencoes
        
        projdep::where('fk_departamento', $id)->where('fk_projeto',$projeto)->delete();

        return back();
    }
    public function adicionardepproj($id,$projeto)
    {
        $projdep= new projdep;
        $projdep->fk_projeto= $projeto;
        $projdep->fk_departamento = $id;
        $projdep->save();

        return back();
    }
}
