<?php

namespace App\Http\Controllers;

use App\veiculos;
use Validator;

use App\empresasComuns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class VeiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculo = veiculos::get();
        return view('mostrar/veiculo', compact('veiculo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas=empresascomuns::pluck('nomeAbreviado','NIF');
        return view('criar/veiculo',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {

        $matricula = strtoupper($request->matricula);   

        if(strlen($matricula) != 8){

            \Session::flash('warning','A matricula tem de ter 8 caracteres');
            return Redirect::to('/novoveiculo')->withInput();
    
        }

        if($matricula[2]!="-" || $matricula[5]!="-"){

            \Session::flash('warning','Formatação da matricula errada, por favor insira: XX-XX-XX');
            return Redirect::to('/novoveiculo')->withInput();
    
         }

         if (preg_match('/^[0-9a-z]{2}-[0-9a-z]{2}-[0-9a-z]{2}$/i',$request->matricula)) {
        
        //     $veiculo->save(); 
       
           $veiculo = new veiculos;
           $veiculo->dataMatricula = $request->dataMatricula;
           $veiculo->matricula = strtoupper($request->matricula);
           $veiculo->marca = $request->marca;
           $veiculo->modelo = $request->modelo;
           $veiculo->capacidade = $request->capacidade;
           $veiculo->kms = $request->kms;
           $veiculo->autonomia = $request->autonomia;
           $veiculo->nifEmpresa = $request->nif;
           $veiculo->descricao= $request->marca. ' '.$request->modelo. ' | ' . $request->matricula . ' (Capacidade: '.$request->capacidade.')';
       

           
           if(is_numeric($veiculo->capacidade) && is_numeric($veiculo->kms) && is_numeric($veiculo->autonomia)){

            $veiculo->save();
           

       }else{
     
        \Session::flash('warning','Por favor, é necessário introduzir valores numéricos (Capacidade de Ocup. | KMs | Autonomia)');
        return Redirect::to('/novoveiculo')->withInput();

    
   }
   \Session::flash('success', 'O Veiculo '. $request->matricula.' foi criado com sucesso');
   return Redirect::to('/veiculos')->withInput();
   
    }else{
    \Session::flash('warning','A matrícula só pode conter letras e " - ". Formatação da Matrícula: "XX-XX-XX"'); 

       // \Session::flash('warning','Por favor, insira este tipo de formatação da matrícula: "XX-XX-XX"');
       return Redirect::to('/novoveiculo')->withInput();
    }

       return Redirect::to('/veiculos');

    // $veiculo->matricula=="xx-xx-xx";
    //   $veiculo->matricula[2];
    // $regex = preg_match('[@_!#$%^&*()<>?/\|}{~:]',$veiculo->matricula); 
    // c >= 'a' && c <= 'z'
    // || $veiculo->matricula[0] < 'a' || $veiculo->matricula[0] > 'z'
    // $veiculo->save();
    // \Session::flash('success', 'O Veiculo '. $request->matricula.' foi criada com sucesso');

    // escrever log 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function show(veiculos $veiculos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */


     
    public function edit($id)
    {
        $empresas=empresascomuns::pluck('nomeAbreviado','NIF');
        $veiculo = veiculos::find($id);
        // return $request;
        return view('editar/veiculo', compact('veiculo','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {

        $veiculo = veiculos::find($id); 
       // return $request;
             
        $matricula = strtoupper($request->matricula);  
  


        if  (strlen($matricula) != 8){
       
            \Session::flash('warning','Demasiados Dígitos, Formatação da Matrícula: "XX-XX-XX"'); 
            return Redirect::to('/editarveiculo/'.$id)->withInput();
        } 

        if($matricula[2]!='-' || $matricula[5]!='-'){
          
            \Session::flash('warning','Em falta "-". Formatação da Matrícula: "XX-XX-XX"'); 
             
        // return Redirect::to('/novoveiculo')->withInput();
        return Redirect::to('/editarveiculo/'.$id)->withInput();

        } 
     

   
        if (preg_match('/^[0-9A-Z]{2}-[0-9A-Z]{2}-[0-9A-Z]{2}$/i',strtoupper($request->matricula))) {
        
      
        $veiculo->dataMatricula = $request->dataMatricula;
        $veiculo->matricula = strtoupper($request->matricula);
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->capacidade = $request->capacidade;
        $veiculo->kms = $request->kms;
        $veiculo->autonomia = $request->autonomia;
        $veiculo->nifEmpresa = $request->nif;
        $veiculo->descricao= $request->marca. ' '.$request->modelo. ' | ' . $request->matricula . ' (Capacidade: '.$request->capacidade.')';

        
        if(is_numeric($veiculo->capacidade) && is_numeric($veiculo->kms) && is_numeric($veiculo->autonomia)){

            $veiculo->save();
       }else{
      
        \Session::flash('warning','Por favor, é necessário introduzir valores numéricos (Capacidade de Ocup. | KMs | Autonomia)');
        return Redirect::to('/editarveiculo/'.$id)->withInput();

       }

        \Session::flash('success', 'O Veiculo '. $request->matricula.' foi editado com sucesso');
        return Redirect::to('/veiculos')->withInput();

    }else{
    
        \Session::flash('warning','A matrícula só pode conter números e letras maíusculas. Formatação da Matrícula: "XX-XX-XX"');    
        // \Session::flash('warning','Por favor, insira este tipo de formatação da matrícula: "XX-XX-XX"');
        return Redirect::to('/editarveiculo/'.$id)->withInput();

    }

}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\veiculos  $veiculos
     * @return \Illuminate\Http\Response
     */
    public function destroy(veiculos $veiculos)
    {
        //
    }
}
