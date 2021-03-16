<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PotencialCliente;
use App\Orcamento;
use App\User;
use App\leads;
use App\contactoscomclientes;
use App\tipoContactos;
use App\Contacto;
use App\Cliente;
use Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\carbon;
use Session;

class potencialClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        
        $potencialcliente = PotencialCliente::get();

        return view('mostrar/potencialcliente', compact('potencialcliente', 'users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        return view('criar/potencialcliente', compact('users'));

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

            'email' => 'required|email',
           
            ]);
            if($validator->fails()){
                \Session::flash('warning','Por favor preencha os campos assinalados corretamente.');
                return Redirect::to('/newpotencialcliente')->withInput()->withErrors($validator);
            }


            $verificarcliente=cliente::where('NIF',$request->NIF)->get();
            if(count($verificarcliente)>0){
                \Session::flash('warning', 'O cliente  '. $verificarcliente[0]->nomeAbreviado .' já se encontra criado em clientes');
                return Redirect::to('/newpotencialcliente')->withInput()->withErrors($validator);
            }

            
            $verificarpotcliente=PotencialCliente::where('NIF',$request->NIF)->get();
            if(count($verificarpotcliente)>0){
                \Session::flash('warning', 'O potencial cliente  '. $verificarpotcliente[0]->nomeAbreviado .' já se encontra criado.');
                return Redirect::to('/newpotencialcliente')->withInput()->withErrors($validator);
            }
        $potencialcliente = new PotencialCliente;
        $potencialcliente->NIF = $request['NIF'];
        $potencialcliente->nomeCompleto = $request['nomeCompleto'];
        $potencialcliente->nomeAbreviado = $request['nomeAbreviado'];
        // $potencialCliente->visivel = $request['visivel'];
        $potencialcliente->email = $request['email'];
        $potencialcliente->morada = $request['morada'];
        $potencialcliente->contacto = $request['contacto'];
        $potencialcliente->contactoAlternativo = $request['contactoAlternativo'];
        $potencialcliente->observacoes = $request['observacoes'];
        $potencialcliente->fk_criador = Auth::id();

        $potencialcliente->save();
 
        \Session::flash('success', 'O Potencial Cliente ' . $request->nomeCompleto . ' foi criado com sucesso');
  

        // escrever log 
        return Redirect::to('/potencialcliente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $potencialcliente = PotencialCliente::find($request->id);
        $leads = leads::where('fk_potencialcliente',$request->id)->get();
        $contactolead=[];
        $lead=0;
        $contacto = tipoContactos::get();
        $agenda=contacto::where('fk_potencialcliente',$request->id)->get();
        $orcamentos=orcamento::where('fk_potcliente',$request->id)->get();
        return view('ver/potencialcliente', compact('potencialcliente','leads','contactolead','lead','contacto','agenda','orcamentos'));

    }
    public function showcomlead(Request $request)
    { 
        $fk_potencialcliente= Session::get('fk_potencialcliente');
        if ($fk_potencialcliente==null) {
            $fk_potencialcliente=$request->fk_potencialcliente;
        }
        $lead= Session::get('lead');
        if ($lead==null) {
            $lead=$request->pk_lead;
        }
        $potencialcliente = PotencialCliente::find($fk_potencialcliente);
        $leads = leads::where('fk_potencialcliente',$fk_potencialcliente)->get();
        $contacto = tipoContactos::get();
        $contactolead = contactoscomclientes::where('fk_lead',$lead)->leftjoin('users','id','fk_responsavel')->leftjoin('tipo_contactos','pk_tipo_contacto','fk_tipo_contacto')->get();
        $agenda=contacto::where('fk_potencialcliente',$fk_potencialcliente)->get();
        return view('ver/potencialcliente', compact('potencialcliente','leads','contactolead','lead','contacto','agenda'));

    }
    public function storecontactos(Request $request)
    {
      
    //   return $request;
        $contacto = new contactoscomclientes;
        $contacto->fk_lead = $request->lead;
        $contacto->mensagem = $request['mensagem'];
         $contacto->mensagemCliente = $request['mensagemCliente'];

        $contacto->parecer = $request['parecer'];
        $contacto->dataContacto =  Carbon::parse($request->dataContacto)->format('Y-m-d H:i:s');
        if ($request->proximoContacto!=null) {
            $contacto->proximoContacto =  Carbon::parse($request->proximoContacto)->format('Y-m-d H:i:s');

        }
        // $contacto->proximoContacto =  Carbon::parse($request->proximoContacto)->format('Y-m-d H:i:s');
         $contacto->fk_tipo_contacto = $request['fk_tipo_contacto'];
    
       
         $contacto->fk_responsavel = Auth::id();

        $contacto->save();
        return 
        Redirect::to('/verpotencialclientelead') ->with(['lead'=> $contacto->fk_lead,'fk_potencialcliente'=> $request->fk_potencialcliente ]);
     

        
      

    }

    public function apagarcontacto(Request $request)
    {
    
        $contacto =  contactoscomclientes::find($request->id);
        $contacto->delete();
        return 
        Redirect::to('/verpotencialclientelead') ->with(['lead'=> $request->lead,'fk_potencialcliente'=> $request->fk_potencialcliente ]);
     

    }

    public function agendaadicionar(Request $request)
    {
        
    // return $request;
  
        $contacto = new contacto;
        $contacto->nome = $request['nome'];
        $contacto->funcao = $request['funcao'];
        $contacto->contacto1 = $request['contacto1'];
        $contacto->contacto2 = $request['contacto2'];
        $contacto->email = $request['email'];
        $contacto->fk_potencialcliente  = $request['fk_potencialcliente'];


        $contacto->save();
       

        

        \Session::flash('success', 'O Contacto '. $request->nome .' foi criado com sucesso');

        // escrever log 
        return
        Redirect::to('/verpotencialclientelead') ->with(['lead'=> $request->lead,'fk_potencialcliente'=> $request->fk_potencialcliente ]);

        
        return Redirect::back();
    }


    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $potencialcliente = PotencialCliente::find($request->id);
        $users = user::where('visivel', 1)->pluck('name', 'id');


        return view('editar/potencialcliente', compact('potencialcliente','users'));

    }
    public function converter(Request $request)
    {
         $potencialcliente = PotencialCliente::find($request->id);



        return view('criar/convertercliente', compact('potencialcliente'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $potencialcliente = PotencialCliente::find($request->id);
        $potencialcliente->NIF = $request['NIF'];
        $potencialcliente->nomeCompleto = $request['nomeCompleto'];
        $potencialcliente->nomeAbreviado = $request['nomeAbreviado'];
        $potencialcliente->visivel = $request['visivel'];
        $potencialcliente->email = $request['email'];
        $potencialcliente->morada = $request['morada'];
        $potencialcliente->contacto = $request['contacto'];
        $potencialcliente->contactoAlternativo = $request['contactoAlternativo'];
        $potencialcliente->observacoes = $request['observacoes'];
        // $potencialcliente->fk_criador = $request['fk_criador'];
     
        $potencialcliente->save();
        return Redirect::to('/potencialcliente'); 
    }

    public function editcontacto($id)
    {
   
        $contacto=contacto::find($id);
  
        

        return view('editar/contactocliente', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatecontacto(Request $request)
    {
  

        
        $contacto =  contacto::find($request->id);
        $contacto->nome = $request['nome'];
        $contacto->funcao = $request['funcao'];
        $contacto->contacto1 = $request['contacto1'];
        $contacto->contacto2 = $request['contacto2'];
        $contacto->email = $request['email'];
      
       
        $contacto->save();
       

        

        \Session::flash('success', 'O Contacto '. $request->nome .' foi editado com sucesso');
        return
        Redirect::to('/verpotencialclientelead') ->with(['fk_potencialcliente'=> $contacto->fk_potencialcliente ]);
    
        
    }

 public function apagarcontactoc(Request $request)
    {
   
        $contacto =  contacto::find($request->id);
        $contacto->delete();
       
        return
        Redirect::to('/verpotencialclientelead') ->with(['fk_potencialcliente'=> $contacto->fk_potencialcliente ]);
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
    }
}
