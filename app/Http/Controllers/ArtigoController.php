<?php

namespace App\Http\Controllers;

use App\artigo;
use App\familiaArtigos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\inventario;
use App\artigoscompra;
use App\artigo_venda;
use App\iva;
use Illuminate\Support\Facades\File;



class ArtigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artigo= artigo::get();
        return view('mostrar/artigo', compact('artigo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familiaartigo= familiaArtigos::get();
        $iva= iva::pluck('descricao_iva','pk_iva');
        return view('criar/artigo',compact('familiaartigo','iva'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $artigo= new artigo;
        $artigo->sku=$request->sku;
        $artigo->descricao=$request->descricao;
        $artigo->caracteristicas=$request->caracteristica;
        $artigo->precoCompra=$request->preco;
        $artigo->foto=$request->foto;
        if($request->hasFile('foto'))
            
        {
 
         $artigo->foto= $request->file('foto')->store('produtos','public');
        }
        else{
        $artigo->foto="produtos/produtodefeito.png";
     
        }
        $artigo->peso=$request->peso;

        if (isset($_POST['fk_familiaArtigo']) && $_POST['fk_familiaArtigo'] == 'novaFam') { //opção selecionada "Novo Cargo"
            $familiaartigo = new familiaArtigos; //novo cargo
            $familiaartigo->descricao = $request->novaDescricao;
     
            $familiaartigo->save();
            $id_novaFam = $familiaartigo->pk_familiaartigos;
            $artigo->fk_familiaartigos = $id_novaFam;
        } else {
            $artigo->fk_familiaartigos=$request->fk_familiaArtigo;
        }

       
        $artigo->descontinuado=0;
        $artigo->tipoartigo=$request->tipoartigo;
        $artigo->fk_iva=$request->fk_iva;
      
        $artigo->save();
        \Session::flash('success',  $artigo->descricao.' foi criado com sucesso');
        return Redirect::to('/artigos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $artigo= artigo::find($request->id);
        $inventario= inventario::where('fk_artigo',$request->id)->get();
        $artigoscompra= artigoscompra::where('fk_artigo',$request->id)->leftjoin('compras','pk_compra','fk_compra')->leftjoin('users','id','fk_responsavel')->get();
        $artigosvenda= artigo_venda::where('fk_artigo',$request->id)->leftjoin('vendas','pk_venda','fk_venda')->leftjoin('users','id','fk_responsavel')->get();
        $precomedio= artigoscompra::where('fk_artigo',$request->id)->leftjoin('compras','pk_compra','fk_compra')->where('fk_estadocompra',4)->avg('precoUnitario');
        $familiaartigo= familiaArtigos::find($artigo->fk_familiaartigos);
        $emstock= inventario::where('fk_artigo',$request->id)->sum('quantidade');
        $encomendados= artigoscompra::where('fk_artigo',$request->id)->leftjoin('compras','pk_compra','fk_compra')->where('fk_estadocompra','<',4)->sum('quantidade');
        return view('ver/artigo', compact('artigo','inventario','artigoscompra','precomedio','familiaartigo','emstock','encomendados','artigosvenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        $artigo= artigo::find($request->id);
        $familiaartigo= familiaArtigos::pluck('descricao','pk_familiaartigos');
        $iva= iva::pluck('descricao_iva','pk_iva');

        return view('editar/artigo', compact('artigo','familiaartigo','iva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $artigo= artigo::find($request->id);
        $artigo->sku=$request->sku;
        $artigo->descricao=$request->descricao;
        $artigo->caracteristicas=$request->caracteristica;
        $artigo->precoCompra=$request->preco;
        if($request->foto!=null){
            if($request->hasFile('foto'))
            
            {
                if(File::exists($artigo->foto)) {
                    File::delete($artigo->foto);
                }
     
             $artigo->foto= $request->file('foto')->store('produtos','public');
            }
            else{
            $artigo->foto="produtos/produtodefeito.png";
         
            }
        }
      
        $artigo->peso=$request->peso;
        $artigo->fk_familiaartigos=$request->fk_familiaArtigo;
        $artigo->descontinuado=$request->descontinuado;
        $artigo->fk_iva=$request->fk_iva;

        $artigo->save();
        \Session::flash('success',  $artigo->descricao.' foi editado com sucesso');
        return Redirect::to('/artigos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\artigo  $artigo
     * @return \Illuminate\Http\Response
     */
    public function destroy(artigo $artigo)
    {
        //
    }
}
