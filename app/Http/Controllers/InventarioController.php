<?php

namespace App\Http\Controllers;

use App\inventario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\armazem;
use Auth;
use App\artigoscompra;
use App\artigo_venda;
use Session;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {    $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
       $inventario=inventario::leftjoin('artigos','fk_artigo','pk_artigo')->leftjoin('armazens','pk_armazem','fk_armazem')->where('fk_armazem',$id)->get();
       $armazem=armazem::find($id);
       return view('mostrar/inventario', compact('inventario','armazem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function corrigir(Request $request)
    {
        $inventario=inventario::leftjoin('armazens','fk_armazem','pk_armazem')->find($request->inventario);
     

        if ($request->quantidade<0) {
            $artigosvenda= new artigo_venda();
            $artigosvenda->quantidade= $request->quantidade;
            $artigosvenda->fk_tecnico=auth::id();
            $artigosvenda->fk_inventario=$request->inventario;
            $artigosvenda->acerto=1;
            $artigosvenda->save();
            $inventario->quantidade= $inventario->quantidade+$artigosvenda->quantidade;
     
            $inventario->save();
            


        } else {
            $artigoscompra= new artigoscompra();
            $artigoscompra->quantidade= $request->quantidade;
            $artigoscompra->fk_tecnico=auth::id();
            $artigoscompra->fk_inventario=$request->inventario;
            $artigoscompra->acerto=1;
            $artigoscompra->save();
            $inventario->quantidade= $inventario->quantidade+$artigoscompra->quantidade;
     
            $inventario->save();

        }
        return 
        Redirect::to('/inventario') ->with(['id'=> $inventario->fk_armazem]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventario $inventario)
    {
        //
    }
}
