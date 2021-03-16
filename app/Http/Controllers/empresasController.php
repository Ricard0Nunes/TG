<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Projeto;
use Auth;
use DB;

use Validator;

use Illuminate\Support\Facades\Redirect;
class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empresa = empresa::where('visivel',1)->get();

        $projetos = projeto::all();
     
        return view('ver/empresa', compact('empresa', 'projetos'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('criar/empresa');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSetup(Request $request)

    {

        $validator =  Validator::make($request->all(), [
         
            'NIF' => 'required|max:9|min:9',
            'nomeCompleto' => 'required',
            'nomeAbreviado' => 'required',
            'email' => 'required',
            'visivel' => 'required',
            'morada' => 'required',
            'contacto' => 'required',
            'horarioAbertura' => 'required',
            'horarioFecho' => 'required',
            
            
        ]);
        if($this->validaNIF($request['NIF'])==0){
            \Session::flash('warning','NIF Inválido!');
            return Redirect::to('/setupEmpresa')->withInput()->withErrors($validator);
        }






        
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/setupEmpresa')->withInput()->withErrors($validator);
        }
        $empresa = new empresa;
        $empresa->NISS = $request['NISS'];
        $empresa->NIF = $request['NIF'];
        $empresa->nomeCompleto = $request['nomeCompleto'];
        $empresa->nomeAbreviado = $request['nomeAbreviado'];
        $empresa->email = $request['email'];
        $empresa->visivel = $request['visivel'];
        $empresa->morada = $request['morada'];
        $empresa->contacto = $request['contacto'];
        $empresa->horarioAbertura = $request['horarioAbertura'];
        $empresa->horarioFecho = $request['horarioFecho'];
        $empresa->observacoes = $request['observacoes'];
         DB::connection('geraltg')->table('empresascomuns')->insert([
            ['NIF' =>  $request['NIF'],
            'nomeCompleto' =>  $empresa->nomeCompleto,
            'nomeAbreviado' => $request['nomeAbreviado'],
           'horarioAbertura' => $request['horarioAbertura'],
           'horarioFecho' => $request['horarioFecho'],
           'created_at' =>  date('Y-m-d H:i:s')],
         
        ]);

        $empresa->save();
        \Session::flash('success', 'A empresa '. $request->nomeAbreviado .' foi criada com sucesso');

        // escrever log 
        return view('setup/setupcargohorario');
    }
    
    
    public function store(Request $request)

    {

        $validator =  Validator::make($request->all(), [
         
            'NIF' => 'required|max:9|min:9',
            'nomeCompleto' => 'required',
            'nomeAbreviado' => 'required',
            'email' => 'required',
            'visivel' => 'required',
            'morada' => 'required',
            'contacto' => 'required',
            'horarioAbertura' => 'required',
            'horarioFecho' => 'required',
            
            
        ]);
        if($this->validaNIF($request['NIF'])==0){
            \Session::flash('warning','NIF Inválido!');
            return Redirect::to('/novaempresa')->withInput()->withErrors($validator);
        }






        
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/novaempresa')->withInput()->withErrors($validator);
        }
        $empresa = new empresa;
        $empresa->NISS = $request['NISS'];
        $empresa->NIF = $request['NIF'];
        $empresa->nomeCompleto = $request['nomeCompleto'];
        $empresa->nomeAbreviado = $request['nomeAbreviado'];
        $empresa->email = $request['email'];
        $empresa->visivel = $request['visivel'];
        $empresa->morada = $request['morada'];
        $empresa->contacto = $request['contacto'];
        $empresa->horarioAbertura = $request['horarioAbertura'];
        $empresa->horarioFecho = $request['horarioFecho'];
        $empresa->observacoes = $request['observacoes'];
         DB::connection('geraltg')->table('empresascomuns')->insert([
            ['NIF' =>  $request['NIF'],
            'nomeCompleto' =>  $empresa->nomeCompleto,
            'nomeAbreviado' => $request['nomeAbreviado'],
           'horarioAbertura' => $request['horarioAbertura'],
           'horarioFecho' => $request['horarioFecho'],
           'created_at' =>  date('Y-m-d H:i:s')],
         
        ]);

        $empresa->save();
        \Session::flash('success', 'A empresa '. $request->nomeAbreviado .' foi criada com sucesso');

        // escrever log 
        return Redirect::to('/registo');
    }
    
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function home()
    // {
    //     $empresa = empresa::all();
    //     return view('home', compact('empresa'));
    // }
    public function show($id)
    {
        $empresa = empresa::find($id);
        return view('ver/empresa', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = empresa::find($id);
        return view('editar/empresa', compact('empresa'));
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
        'NISS' => 'required',
        'NIF' => 'required',
        'nomeCompleto' => 'required',
        'nomeAbreviado' => 'required',
        'email' => 'required',
        'visivel' => 'required',
        'morada' => 'required',
        'contacto' => 'required',
        'horarioAbertura' => 'required',
        'horarioFecho' => 'required',
       
        
    ]);
    if($validator->fails()){
        \Session::flash('warning','Por favor preencha os campos assinalados');
        return Redirect::to('/editarempresa/'.$id)->withInput()->withErrors($validator);
    }
        $empresa = empresa::find($id);
        $empresa->NISS = $request['NISS'];
        $empresa->NIF = $request['NIF'];
        $empresa->nomeCompleto = $request['nomeCompleto'];
        $empresa->nomeAbreviado = $request['nomeAbreviado'];
        $empresa->email = $request['email'];
        $empresa->visivel = $request['visivel'];
        $empresa->morada = $request['morada'];
        $empresa->contacto = $request['contacto'];
        $empresa->horarioAbertura = $request['horarioAbertura'];
        $empresa->horarioFecho = $request['horarioFecho'];
        $empresa->observacoes = $request['observacoes'];
        $empresa->save();
        \Session::flash('success', 'A empresa '. $request->nomeAbreviado .' foi editada com sucesso');

        // escrever log 
        return Redirect::to('/empresas');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
