<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Contacto;
use App\Projeto;
use App\PotencialCliente;
use App\Orcamento;
use App\Empresa;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;




class clienteController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = cliente::get();
        return view('mostrar/cliente', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
       
        return view('criar/cliente');

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
            
            'NIF' => 'required',
            'nomeCompleto' => 'required',
            'nomeAbreviado' => 'required',
            'email' => 'required|email',
            'contacto' => 'required',
            'morada' => 'required',
          
        ]);
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::to('/novocliente')->withInput()->withErrors($validator);
        }
        $verificarcliente=cliente::where('NIF',$request->NIF)->get();
        if(count($verificarcliente)>0){
            \Session::flash('warning', 'O cliente  '. $verificarcliente[0]->nomeAbreviado .' já se encontra criado');
            return Redirect::to('/novocliente')->withInput();
        }

       
        $cliente = new cliente;
        $cliente->NIF = $request['NIF'];
        $cliente->NISS = $request['NISS'];
        $cliente->nomeCompleto = $request['nomeCompleto'];
        $cliente->nomeAbreviado = $request['nomeAbreviado'];
        $cliente->morada = $request['morada'];
        $cliente->email = $request['email'];
        $cliente->contacto = $request['contacto'];

 
        if($request->hasFile('logo'))
            
        {
 
         $cliente->logo= $request->file('logo')->store('cliente','public');
        }
        else{
        $cliente->logo="cliente/clientedefeito.png";
    }
   


   
          


      
        $cliente->contactoAlternativo = $request['contactoAlternativo'];
        $cliente->observacoes = $request['observacoes'];
        $cliente->visivel = 1;
        $cliente->fk_empresa =  empresa::where('visivel',1)->value('pk_empresa');
        $cliente->fk_potencialCliente = $request->fk_potencialCliente;
        $cliente->save();
        if($request->fk_potencialCliente!=null){
            $potencialcliente = PotencialCliente::find($cliente->fk_potencialCliente);
            $potencialcliente->convertido=1;
      

            $agenda=contacto::where('fk_potencialcliente',$potencialcliente->pk_potencialCliente)->get();
          for ($i=0; $i <count($agenda) ; $i++) { 
              $agenda[$i]->fk_cliente=$cliente->pk_cliente;
              $agenda[$i]->save();
          }
            $potencialcliente->save();
         
        }
        

        \Session::flash('success', 'O cliente  '. $cliente->descricaoAbreviado .' foi criado com sucesso');

        return Redirect::to('/client') ->with(['id'=>$cliente->pk_cliente]);
        return Redirect::to('/clientes');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  
       if ($request->has('id')==true) {
       
       } else {
        $request->id= Session::get('id');
       }
   
        $cliente=cliente::find($request->id);
        $contacto=contacto::where('fk_cliente',$request->id)->get();
       $projetosTotal= projeto::where('fk_cliente',$request->id)->get();
       $projetosConcluidos= projeto::where('fk_cliente',$request->id)->where('fk_estadoproj',4)->get();
        $empresa = empresa::where('visivel',1)->pluck('nomeAbreviado','pk_empresa');
        $orcamentos=orcamento::where('fk_cliente',$request->id)->get();
        return view('ver/cliente', compact('cliente', 'empresa','contacto','projetosTotal','projetosConcluidos','orcamentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $cliente = cliente::find($request->id);
        return view('editar/cliente', compact('cliente'));
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
            
        'NIF' => 'required',
        'nomeCompleto' => 'required',
        'nomeAbreviado' => 'required',
        'email' => 'required',
        'contacto' => 'required',
        'morada' => 'required',

    ]);
    if($validator->fails()){
        \Session::flash('warning','Por favor preencha os campos assinalados');
        return Redirect::to('/editarcliente/'.$id)->withInput()->withErrors($validator);
    }
    $cliente = cliente::find($id);
    $cliente->NIF = $request['NIF'];
    $cliente->NISS = $request['NISS'];
    $cliente->nomeCompleto = $request['nomeCompleto'];
    $cliente->nomeAbreviado = $request['nomeAbreviado'];
    $cliente->morada = $request['morada'];
    $cliente->email = $request['email'];
    $cliente->contacto = $request['contacto'];
    $cliente->logo = $request['logo'];

    if($request->hasFile('logo'))
            
    {
        if(File::exists($cliente->logo)) {
            File::delete($cliente->logo);
        }
        $cliente->logo= $request->file('logo')->store('cliente','public');
    }
    else{

     
        $cliente->logo= "cliente/clientedefeito.png";
    }



    $cliente->contactoAlternativo = $request['contactoAlternativo'];
    $cliente->observacoes = $request['observacoes'];
    $cliente->visivel = $request['visivel'];
    $cliente->fk_potencialCliente = null;
    $cliente->save();

    \Session::flash('success', 'O cliente  '. $request->descricaoAbreviado .' foi editado com sucesso');

    // escrever log 
    return Redirect::to('/clientes');

    }
public function clientergpd(){
    $cliente = cliente::get();
    return view('mostrar/rgpdcliente', compact('cliente'));
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ativarrgpd (Request $request)
    {
        //
         
        $cliente = cliente::find($request->id);
        $cliente->nomeCompletoRGPD=$cliente->nomeCompleto;
        $cliente->nomeAbreviadoRGPD= $cliente->nomeAbreviado;
        $cliente->emailRGPD= $cliente->email;
        $cliente->moradaRGPD= $cliente->morada;
        $cliente->contactoRGPD= $cliente->contacto;
        $cliente->contactoAlternativoRGPD= $cliente->contactoalternativo;
        $cliente->RGPD= 1;
        $cliente->dadosRGPD= 'Cliente solicitou o direito ao esquecimento no dia: '.date('Y-m-d H:m:i');
        $cliente->nomeCompleto ='*******';
        $cliente->nomeAbreviado = '*******';
        $cliente->morada = '*******';
        $cliente->email = '*******';
        $cliente->contacto = '*******';
        $cliente->contactoAlternativo = '*******';

         $cliente->save();

         \Session::flash('success', 'Para o cliente com o nif '. $cliente->NIF .' foi ativado o regime de direito ao Esquecimento de acordo com as normas do RGPD');

         // escrever log 
         return Redirect::to('/rgpdcliente');
    }

    public function desativarrgpd (Request $request)
    { $cliente = cliente::find($request->id);
        $cliente->nomeCompleto=$cliente->nomeCompletoRGPD;
        $cliente->nomeAbreviado= $cliente->nomeAbreviadoRGPD;
        $cliente->email= $cliente->emailRGPD;
        $cliente->morada= $cliente->moradaRGPD;
        $cliente->contacto= $cliente->contactoRGPD;
        $cliente->contactoAlternativo= $cliente->contactoalternativoRGPD;
        $cliente->RGPD= 0;
        $cliente->dadosRGPD=  $cliente->dadosRGPD.'; Cliente cancelou o direito ao esquecimento no dia: '.date('Y-m-d H:m:i');
        $cliente->nomeCompletoRGPD =null;
        $cliente->nomeAbreviadoRGPD = null;
        $cliente->moradaRGPD = null;
        $cliente->emailRGPD = null;
        $cliente->contactoRGPD = null;
        $cliente->contactoAlternativoRGPD = null;
         $cliente->save();

         \Session::flash('success', 'Para o cliente com o nif '. $cliente->NIF .' foi cancelado o regime de direito ao Esquecimento de acordo com as normas do RGPD');

         // escrever log 
         return Redirect::to('/rgpdcliente');
    }
    
}
