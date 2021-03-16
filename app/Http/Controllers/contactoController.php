<?php

namespace App\Http\Controllers;
use App\Contacto;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

class ContactoController extends Controller
{
    
   
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('criar/contacto');
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
         
            
        ]);
        if($validator->fails()){
            \Session::flash('warning','Por favor preencha os campos assinalados');
            return Redirect::back('')->withInput()->withErrors($validator);
        }
        $contacto = new contacto;
        $contacto->nome = $request['nome'];
        $contacto->funcao = $request['funcao'];
        $contacto->contacto1 = $request['contacto1'];
        $contacto->contacto2 = $request['contacto2'];
        $contacto->email = $request['email'];
        $contacto->fk_cliente = $request['fk_cliente'];
     
        $contacto->save();
       

        

        \Session::flash('success', 'O Contacto '. $request->nome .' foi criado com sucesso');

        // escrever log 
        return
        Redirect::to('/client') ->with(['id'=>$contacto->fk_cliente]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function edit($id)
    {
   
        $contacto=contacto::find($id);
  
        

        return view('editar/contacto', compact('contacto'));
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
  

        $validator =  Validator::make($request->all(), [
           
          
            
        ]);
        $contacto =  contacto::find($request->id);
        $contacto->nome = $request['nome'];
        $contacto->funcao = $request['funcao'];
        $contacto->contacto1 = $request['contacto1'];
        $contacto->contacto2 = $request['contacto2'];
        $contacto->email = $request['email'];
  
        $contacto->save();
       

        

        \Session::flash('success', 'O Contacto '. $request->nome .' foi editado com sucesso');
        return Redirect::to('/client') ->with(['id'=>$contacto->fk_cliente]);


        // escrever log 
        return Redirect::to('/clientes');
        
    }



   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function apagar(Request $request)
    {
   
        $contacto =  contacto::find($request->id);
        $contacto->delete();
       
        \Session::flash('success', 'O Contacto '.$contacto->nome.' foi removido.');

        // escrever log 
    
        return Redirect::to('/client') ->with(['id'=>$contacto->fk_cliente]);
        return Redirect::back();
    }
}
