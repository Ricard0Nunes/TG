<?php

namespace App\Http\Controllers;

use App\venda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use Carbon\carbon;
use Session;
use Auth;
use DB;
use App\artigo_venda;
use App\inventario;

use App\artigo;
use Illuminate\Support\Facades\Redirect;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venda= venda::get();
        return view('mostrar/venda', compact('venda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes= cliente::orderBy('nomeAbreviado')->pluck('nomeAbreviado','pk_cliente');
        $venda=   venda::orderBy('created_at', 'desc')->first();
        
        if ($venda==null) {
          
        $ultimavenda=1;
        } else {
        
            $ultimavenda=$venda->pk_compra+1;
        }
        
        return view('criar/iniciarvenda',compact('clientes','ultimavenda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venda= new venda();
        $venda->dataVenda=carbon::now()->format('Y-m-d H:i:s');
        $venda->fk_cliente=$request->fk_cliente;
        $venda->fk_responsavel=auth::id();
        $venda->fk_estadoVenda=1;
        $venda->save();
      
        return 
        Redirect::to('/mostrarvenda') ->with(['id'=>$venda->pk_venda]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
   
        $venda=  venda::find($id);
        $cliente= cliente::find($venda->fk_cliente);
        $estadoVenda= DB::table('estado_vendas')->where('pk_estadovenda',$venda->fk_estadovenda)->value('estado');
        $artigosvenda= artigo_venda::where('fk_venda',$venda->pk_venda)->leftjoin('artigos','pk_artigo','fk_artigo')->get();
        $quantidade= artigo_venda::where('fk_venda',$venda->pk_venda)->sum('quantidade');
        $total= artigo_venda::where('fk_venda',$venda->pk_venda)->sum('precoTotal');

        $artigos=inventario::leftjoin('artigos','pk_artigo','fk_artigo')->leftjoin('armazens','pk_armazem','fk_armazem')->get();
               return view('criar/venda',compact('venda','cliente','estadoVenda','artigosvenda','artigos','quantidade','total'));
    }

    public function adicionarartigo(Request $request)
    {
   
 
        $inventario=inventario::find($request->fk_inventario);
        
        if ($request->quantidade>$inventario->quantidade and ($request->confirma!='sim')) {
            return Redirect::to('/mostrarvenda')->with('Warning', 'A quantidade no armazem é inferior à de venda. Deseja prosseguir?')->with(['id'=>$request->fk_venda])->withInput();
        } 
     
        if ($request->precoVenda<$inventario->ultimoPrecoCompra and  ($request->confirmapreco!='sim')) {
            return Redirect::to('/mostrarvenda')->with('Warning1', 'O preço de venda é inferior ao preço da ultima compra. Deseja prosseguir?')->with(['id'=>$request->fk_venda])->withInput();

         }
         $artigosvenda= new artigo_venda();
       
        $artigosvenda->precoUnitario= $request->precoVenda;
        $artigosvenda->quantidade= $request->quantidade;
        $artigosvenda->precoTotal= $artigosvenda->precoUnitario* $artigosvenda->quantidade;
        $artigosvenda->fk_venda=$request->fk_venda;
        $artigosvenda->fk_artigo=$inventario->fk_artigo;
        $artigosvenda->fk_tecnico=auth::id();
        $artigosvenda->fk_inventario=$request->fk_inventario;
       
        $artigosvenda->save();

        return 
        Redirect::to('/mostrarvenda') ->with(['id'=> $artigosvenda->fk_venda]);




    }
    public function removerartigo(Request $request)
    {
       
        $artigosvenda=  artigo_venda::find($request->id);
        $artigosvenda->delete();

        return 
        Redirect::to('/mostrarvenda') ->with(['id'=> $artigosvenda->fk_venda]);




    }
    public function fechar(Request $request)
    {
    
       $erro=0;
      $venda=  venda::find($request->id);
        $venda->fk_estadovenda=2;
        $venda->dataFechoVenda=carbon::now()->format('Y-m-d H:i:s');
        $artigosvenda= artigo_venda::where('fk_venda',$venda->pk_venda)->leftjoin('artigos','pk_artigo','fk_artigo')->get();
        for ($i=0; $i <count($artigosvenda) ; $i++) { 
            $pesoT[$i]=$artigosvenda[$i]->quantidade*$artigosvenda[$i]->peso;
            $inventario=inventario::leftjoin('armazens','fk_armazem','pk_armazem')->find($artigosvenda[$i]->fk_inventario);
            if ($inventario->quantidade<$artigosvenda[$i]->quantidade ) {
                 $quantidade[$i]=$inventario->quantidade-$artigosvenda[$i]->quantidade;
                $faltastock[$i]='Sku: '. $artigosvenda[$i]->sku. ' - ' .$artigosvenda[$i]->descricao .', armazem: '.$inventario->nome.', quantidade em falta: '.$quantidade[$i].'  ';
                $erro=1;
                 } 
          
            
        }
        
        if ($erro==1) {
        return Redirect::to('/mostrarvenda')->with('Warning2', 'Os Artigos :  ['.implode(" ; ",$faltastock) . '] estão sem stock.' )->with(['id'=>$venda->pk_venda])->withInput();

        }
        $venda->peso= array_sum($pesoT);
        $venda->nArtigos= artigo_venda::where('fk_venda',$venda->pk_venda)->sum('quantidade');
        $venda->preco= artigo_venda::where('fk_venda',$venda->pk_venda)->sum('precoTotal');


        // retirar do inventario 

        for ($i=0; $i <count($artigosvenda) ; $i++) { 
            $inventario=inventario::leftjoin('armazens','fk_armazem','pk_armazem')->find($artigosvenda[$i]->fk_inventario);
            $inventario->quantidade= $inventario->quantidade-$artigosvenda[$i]->quantidade;
         
            $inventario->save();
            
        }
        $venda->save();


        return 
        Redirect::to('/mostrarvenda') ->with(['id'=> $venda->pk_venda]);




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function recebimento(Request $request)
    {
        $venda=  venda::find($request->id);
        $venda->dataRecebimento=$request->dataRecebimento;
        $venda->fk_estadovenda=3;
        $venda->save();
        return 
        Redirect::to('/vendas');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(venda $venda)
    {
        //
    }
}
