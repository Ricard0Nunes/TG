<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use App\contacto;
use App\leads;
use App\contactoscomclientes;
use Illuminate\Http\Request;
use Carbon\carbon;
use App\tipoContactos;
use Illuminate\Support\Facades\Redirect;
class contactosComClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

              $contacto = contactoscomclientes::leftjoin('leads','pk_lead','fk_lead')->get();
               return view('mostrar/contactosComClientes', compact('contacto'));
           
    }

   
    

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('visivel', 1)->orderBy('name','ASC')->pluck('name', 'id');
        $contacto = tipoContactos::orderBy('tipoContacto','ASC')->pluck('tipoContacto', 'pk_tipo_contacto');
        $lead = leads::orderBy('objetivo','ASC')->get();

        // return $contacto =contacto::where('visivel', 1)->pluck('nome', 'contacto1');
        //  $contacto =contactoscomclientes::get()->pluck( 'tipoContacto','pk_tipo_contacto');
        return view('criar/contactosComClientes', compact('users','contacto','lead'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         return $request;
        $first = carbon::parse($request->dataContacto);
        $second = carbon::parse($request->proximoContacto);
        if ($first->greaterThan($second))
        {
            return Redirect::back()->with('warning', 'Data de contacto inferior à data de proximo contacto.')
                ->withInput();

        }

        $contacto = new contactoscomclientes;
        $contacto->fk_lead = $request->fk_lead;
        $contacto->mensagem = $request['mensagem'];
         $contacto->mensagemCliente = $request['mensagemCliente'];

        $contacto->parecer = $request['parecer'];
        $contacto->dataContacto =  Carbon::parse($request->dataContacto)->format('Y-m-d H:i:s');
        $contacto->proximoContacto =  Carbon::parse($request->proximoContacto)->format('Y-m-d H:i:s');
         $contacto->fk_tipo_contacto = $request['fk_tipo_contacto'];
    
        //  $contacto->fk_responsavel = $request['fk_responsavel'];
         $contacto->fk_responsavel = Auth::id();

        $contacto->save();
     
// return $contacto;
        // \Session::flash('success', 'A formação  ' . $request->nome_formacao . ' foi criado com sucesso');

        return Redirect::to('/contactosComClientes');

        
      

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contactoscomclientes  $contactoscomclientes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,contactoscomclientes $contactoscomclientes)
    {
          
        $contacto = contactoscomclientes::find($request->id);
   
        return view('ver/contactosComClientes', compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contactoscomclientes  $contactoscomclientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       

         $contacto = contactoscomclientes::find($request->id);
        // $users = user::find($request->id);
        //  $tipocontacto = tipoContactos::find($request->id);
        // $lead = leads::find($request->id);
        $tipocontacto = tipoContactos::pluck('tipoContacto', 'pk_tipo_contacto');
        $users = user::where('visivel',1)->pluck('name', 'id');
        $lead = leads::where('pk_lead','!=',$contacto->fk_lead)->get();
        return view('editar/contactoscomclientes', compact('contacto','users','lead','tipocontacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contactoscomclientes  $contactoscomclientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//  return $request;
        $first = carbon::parse($request->dataContacto);
        $second = carbon::parse($request->proximoContacto);
        if ($first->greaterThan($second))
        {
            return Redirect::back()->with('warning', 'Data de contacto inferior à data de proximo contacto.')
                ->withInput();

        }

        $contacto = contactoscomclientes::find($request->id);

        $contacto->mensagem = $request['mensagem'];
         $contacto->mensagemCliente = $request['mensagemCliente'];

        $contacto->parecer = $request['parecer'];
        $contacto->dataContacto =  Carbon::parse($request->dataContacto)->format('Y-m-d H:i:s');
        $contacto->proximoContacto =  Carbon::parse($request->proximoContacto)->format('Y-m-d H:i:s');
         $contacto->fk_tipo_contacto = $request['fk_tipo_contacto'];
         $contacto->fk_lead = $request['fk_lead'];
        //  $contacto->fk_responsavel = $request['fk_responsavel'];
         $contacto->fk_responsavel = Auth::id();

        $contacto->save();
     
// return $contacto;
        // \Session::flash('success', 'A formação  ' . $request->nome_formacao . ' foi criado com sucesso');

        return Redirect::to('/contactosComClientes');

        
      

    }

      
      
     


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contactoscomclientes  $contactoscomclientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,contactoscomclientes $contactoscomclientes)
    {
        $contacto = contactoscomclientes::find($request->id);

      
        
    

        $contacto->delete();
        \Session::flash('danger', 'Contacto eliminado!!');

        return Redirect::to('/contactoscomclientes');
    }
}
