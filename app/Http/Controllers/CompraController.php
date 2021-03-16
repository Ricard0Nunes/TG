<?php

namespace App\Http\Controllers;

use App\compra;
use App\fornecedor;
use App\artigo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\carbon;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\artigoscompra;
use App\inventario;
use App\armazem;


class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra= compra::get();
        $armazem= armazem::pluck('nome','pk_armazem');
        return view('mostrar/compra', compact('compra','armazem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores= fornecedor::orderBy('nomeAbreviado')->pluck('nomeAbreviado','pk_fornecedor');
        $compra=   compra::orderBy('created_at', 'desc')->first();
        
        if ($compra==null) {
          
        $ultimacompra=1;
        } else {
        
            $ultimacompra=$compra->pk_compra+1;
        }
        
        return view('criar/iniciarcompra',compact('fornecedores','ultimacompra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $compra= new compra();
        $compra->dataCompra=carbon::now()->format('Y-m-d H:i:s');
        $compra->fk_fornecedor=$request->fk_fornecedor;
        $compra->fk_responsavel=auth::id();
        $compra->fk_estadoCompra=1;
        $compra->save();
      
        return 
        Redirect::to('/mostrarcompra') ->with(['id'=>$compra->pk_compra]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
        $compra=  compra::find($id);
        $fornecedores= fornecedor::find($compra->fk_fornecedor);
        $estadoCompra= DB::table('estado_compra')->where('pk_estadocompra',$compra->fk_estadoCompra)->value('estado');
        $artigoscompra= artigoscompra::where('fk_compra',$compra->pk_compra)->leftjoin('artigos','pk_artigo','fk_artigo')->get();
        $quantidade= artigoscompra::where('fk_compra',$compra->pk_compra)->sum('quantidade');
        $total= artigoscompra::where('fk_compra',$compra->pk_compra)->sum('precoTotal');

        $artigos=artigo::where('descontinuado',0)->pluck('descricao','pk_artigo');
               return view('criar/compra',compact('compra','fornecedores','estadoCompra','artigoscompra','artigos','quantidade','total'));
        
    }


    public function adicionarartigo(Request $request)
        {
           
            $artigoscompra= new artigoscompra();
            $artigoscompra->precoUnitario= $request->precoCompra;
            $artigoscompra->quantidade= $request->quantidade;
            $artigoscompra->precoTotal= $artigoscompra->precoUnitario* $artigoscompra->quantidade;
            $artigoscompra->fk_compra=$request->fk_compra;
            $artigoscompra->fk_artigo=$request->fk_artigo;
            $artigoscompra->save();

            return 
            Redirect::to('/mostrarcompra') ->with(['id'=> $artigoscompra->fk_compra]);




        }
        public function removerartigo(Request $request)
        {
           
            $artigoscompra=  artigoscompra::find($request->id);
            $artigoscompra->delete();

            return 
            Redirect::to('/mostrarcompra') ->with(['id'=> $artigoscompra->fk_compra]);




        }
        public function fechar(Request $request)
        {
         
            $compra=  compra::find($request->id);
            $compra->fk_estadoCompra=2;
            $compra->dataFechoCompra=carbon::now()->format('Y-m-d H:i:s');
            $artigoscompra= artigoscompra::where('fk_compra',$compra->pk_compra)->leftjoin('artigos','pk_artigo','fk_artigo')->get();
            for ($i=0; $i <count($artigoscompra) ; $i++) { 
                $pesoT[$i]=$artigoscompra[$i]->quantidade*$artigoscompra[$i]->peso;
              
                
            }
            $compra->peso= array_sum($pesoT);
            $compra->nArtigos= artigoscompra::where('fk_compra',$compra->pk_compra)->sum('quantidade');
            $compra->preco= artigoscompra::where('fk_compra',$compra->pk_compra)->sum('precoTotal');
            
            $compra->save();

            return 
            Redirect::to('/mostrarcompra') ->with(['id'=> $compra->pk_compra]);




        }

        public function dataprevista(Request $request)
        {
          
            $compra=  compra::find($request->id);
            $compra->fk_estadoCompra=3;
            $compra->dataPrevistaChega=$request->dataprevista;
      
            $compra->save();

           
            return Redirect::to('/compras');




        }
        
        public function chegada(Request $request)
        {
        
         
            $compra=  compra::find($request->id);
            $compra->fk_estadoCompra=4;
            $compra->dataRecebimento=$request->datachegada;
      
            $artigoscompra= artigoscompra::where('fk_compra',$compra->pk_compra)->leftjoin('artigos','pk_artigo','fk_artigo')->get();
            for ($i=0; $i <count($artigoscompra) ; $i++) { 
                
                // pesquisar se tem no inventario
                $artigoinventario=inventario::where('fk_artigo',$artigoscompra[$i]->fk_artigo)->where('fk_armazem',$request->fk_armazem)->get();
                if (count($artigoinventario)>0) {
                $artigoinventario[0]->quantidade= $artigoinventario[0]->quantidade+$artigoscompra[$i]->quantidade;
                $artigoinventario[0]->ultimoPrecoCompra=$artigoscompra[$i]->precoUnitario;
                $artigoinventario[0]->save();
                } else {
                    $inventario= new inventario();
                    $inventario->quantidade=$artigoscompra[$i]->quantidade;
                    $inventario->ultimoPrecoCompra=$artigoscompra[$i]->precoUnitario;
                    $inventario->fk_artigo=$artigoscompra[$i]->fk_artigo;
                    $inventario->fk_armazem=$request->fk_armazem;
                    $inventario->save();
                  
                }

                
            }



            $compra->save();

           
            return Redirect::to('/compras');




        }

      


    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $compra=  compra::find($request->id);
        $compra->fk_estadoCompra=5;
        $compra->save();

           
        return Redirect::to('/compras');



    }
}
