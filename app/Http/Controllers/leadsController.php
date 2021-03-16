<?php

namespace App\Http\Controllers;

use App\leads;
use App\PotencialCliente;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use Carbon\Carbon;




class leadsController extends Controller
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
        $leads = leads::get();

        return view('mostrar/leads', compact('leads', 'users','potencialcliente'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('visivel', 1)->orderBy('name','ASC')->pluck('name', 'id');
        $potencialcliente = PotencialCliente::where('convertido',0)->orderBy('nomeCompleto','ASC')->pluck('nomeCompleto','pk_potencialCliente');

        return view('criar/leads', compact('users','potencialcliente'));

    }
    public function createpot(Request $request)
    {
        $users = user::where('visivel', 1)->pluck('name', 'id');
        $potencialcliente = PotencialCliente::where('pk_potencialCliente',$request->fk_potencialcliente)->value('pk_potencialCliente');

        return view('criar/leadspot', compact('users','potencialcliente'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firstinicio = carbon::parse($request->inicio);
        $secondfim = carbon::parse($request->fim);
        if ($firstinicio->greaterThan($secondfim))
        {
            return Redirect::back()->with('warning', 'Data de fim inferior à data de início.')
                ->withInput();

        }
        
        $leads = new leads;
        $leads->inicio = $request['inicio'];
        $leads->fim = $request['fim'];
        $leads->objetivo = $request['objetivo'];
        $leads->notas = $request['notas'];
        $leads->fk_responsavel = Auth::id();
        $leads->fk_potencialcliente = $request['fk_potencialcliente'];

        $leads->save();

        return Redirect::to('/leads');

    }
    public function storepot(Request $request)
    {
        
        $leads = new leads;
        $leads->inicio = $request['inicio'];
        $leads->fim = $request['fim'];
        $leads->objetivo = $request['objetivo'];
        $leads->notas = $request['notas'];
        $leads->fk_responsavel = Auth::id();
        $leads->fk_potencialcliente = $request['fk_potencialcliente'];

        $leads->save();

        return
        Redirect::to('/verpotencialclientelead') ->with(['fk_potencialcliente'=> $leads->fk_potencialcliente ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function show(leads $leads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       
        $leads = leads::find($request->id);
        $potencialcliente = PotencialCliente::pluck('nomeCompleto','pk_potencialCliente');


        return view('editar/leads', compact('potencialcliente','leads'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $leads = leads::find($request->id);

        $leads->inicio = $request['inicio'];
        $leads->fim = $request['fim'];
        $leads->objetivo = $request['objetivo'];
        $leads->notas = $request['notas'];
        $leads->fk_responsavel = Auth::id();
        $leads->fk_potencialCliente = $request['fk_potencialCliente'];
        // return $request;
        $leads->save();

        return Redirect::to('/leads');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function destroy(leads $leads)
    {
        //
    }
}
