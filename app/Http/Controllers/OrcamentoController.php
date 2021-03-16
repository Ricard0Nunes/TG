<?php

namespace App\Http\Controllers;
use App\Orcamento;
use Illuminate\Http\Request;
use App\Projeto;
use App\Area;
use App\areaOrcamento;
use App\Cliente;
use App\PotencialCliente;
use Validator;
use App\Empresa;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\orc_Tipo;
use App\orc_Prazo;
use App\artigo;
use App\familiaArtigos;
use App\artigosOrcamento;
use App\iva;
use Session;

use Barryvdh\DomPDF\Facade as PDF;


use Auth;


class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orcamento=orcamento::get();
        return view('mostrar/orcamentos', compact('orcamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $cliente = cliente::orderBy('nomeCompleto')->pluck( 'nomeCompleto', 'pk_cliente');
        $potCliente = PotencialCliente::orderBy('nomeCompleto')->pluck( 'nomeCompleto', 'pk_potencialCliente');
        $tipo=orc_tipo::pluck( 'tipoOrcamento', 'pk_orcTipo');

        return view('criar/orcamento1', compact('cliente','potCliente'));
    }

    public function iniciar(Request $request){

    
        if ($request->simNao==0) {
           $fk_cliente=$request->cliente;
           $fk_potencialCliente=null;
        } else {
            $fk_cliente=null;
            $fk_potencialCliente=$request->potencialCliente;
        }
        $contador= orcamento::orderBy('pk_orcamento','DESC')->value('contador');
        if ($contador==null) {
           $contador=0;
        }
         $anoUltima= orcamento::orderBy('pk_orcamento','DESC')->value('ano');
      
        if ($anoUltima[0]==null or intval($anoUltima)!=date('y')) {
          $contador=0;
        }
        $contador=$contador+1;
        if ($contador<9) {
         $contador="0". $contador;
        }
        $orcamento= new orcamento;
        $orcamento->fk_cliente =  $fk_cliente;
        $orcamento->fk_potCliente =  $fk_potencialCliente;
        $orcamento->contador =   $contador;
        $orcamento->fk_responsavel = auth::id();
        $orcamento->fk_estado = 1;
        $orcamento->valorSemIva=0;
        $orcamento->valorComIva=0;
        $orcamento->valorDoIva=0;
        $orcamento->desconto=0;
        $orcamento->save();
        return 
        Redirect::to('/editarorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }
    public function store(Request $request)
    {
           
            $orcamento= orcamento::find($request->id);
            $tipo=orc_tipo::find($request->tipoorcamento);
            $empresa=empresa::where('pk_empresa',1)->value('nomeAbreviado');
     
            if ($orcamento->contador<9) {
                $orcamento->contador="0". $orcamento->contador;
               }
            $codigoProjeto=$empresa.'_'.$tipo->abreviatura.'_'.carbon::parse($request->date)->format('my').$orcamento->contador;
            $orcamento->numeroOrcamento = $codigoProjeto;
            $orcamento->ano =  date('y');
            $orcamento->fk_prazo=$request->prazo;
            $orcamento->fk_tipo=$request->tipoorcamento;
    
            $orcamento->save();
           
            return 
            Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }
        
        $orcamento=orcamento::find($id);
        if ($orcamento==null  ) {
            return 
            Redirect::to('/orcamentos'); 
         }
        $cliente=cliente::find($orcamento->fk_cliente);
        $potcliente=PotencialCliente::find($orcamento->fk_potCliente);
        $tipocorcamento=orc_tipo::pluck('tipoOrcamento','pk_orcTipo');
        $prazo=orc_prazo::pluck('prazo','pk_prazo');
        $familiaartigo=familiaArtigos::get();
        $artigoorcamento=artigosOrcamento::where('fk_orcamento',$orcamento->pk_orcamento)->leftjoin('artigos','fk_artigo','pk_artigo')->get();
        $originounovoorcamento=orcamento::where('fk_orcamentoRevisao',$id)->get();
   
   
        return view('criar/orcamento3', compact('orcamento','cliente','potcliente','tipocorcamento','prazo','familiaartigo','artigoorcamento','originounovoorcamento'));

     
     
    }
    public function newOrcamentoArtigoAjax() {
    
    
        $pk_familiaartigos = request()->input('pk_familiaartigos');
        $artigo = artigo::where('fk_familiaartigos',$pk_familiaartigos)->get();
        
        return response()->json($artigo);
  
    }
    public function newOrcamentoValorAjax() {
    
    
        $pk_artigo = request()->input('pk_artigo');
        $valor = artigo::where('pk_artigo',$pk_artigo)->get();
        
        return response()->json($valor);
  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {    $id= Session::get('id');
        if ($id==null) {
            $id=$request->id;
        }

        $orcamento=orcamento::find($id);
        $cliente=cliente::find($orcamento->fk_cliente);
        $potcliente=PotencialCliente::find($orcamento->fk_potCliente);
        $tipocorcamento=orc_tipo::pluck('tipoOrcamento','pk_orcTipo');
        $prazo=orc_prazo::pluck('prazo','pk_prazo');
    
        return view('criar/orcamento2', compact('orcamento','cliente','potcliente','tipocorcamento','prazo'));
        
    }
    public function adicionarartigo(Request $request){

        
        $artigonovo=new artigosOrcamento;
        $artigo=artigo::find($request->fk_artigo);
        $iva=iva::find($artigo->fk_iva);
        $artigonovo->quantidade=$request->quantidade;
        $artigonovo->precounitario=$request->precoCompra;
        if ($request->desconto>0) {
         $valordoartigocomodesconto=number_format($artigonovo->precounitario-(   $request->desconto/100 *  $artigonovo->precounitario),2 ,'.', ''); 
        }else {
            $valordoartigocomodesconto= $artigonovo->precounitario;
        }
        $artigonovo->valorSemIva=number_format($request->quantidade* $valordoartigocomodesconto,2 ,'.', '');
        $valoriva= ($iva->valor_iva/100)+1;
        $valorcomiva=number_format($valoriva*$artigonovo->valorSemIva,2 ,'.', '');
        $valordoiva=number_format($valorcomiva-$artigonovo->valorSemIva,2 ,'.', '');
        $artigonovo->valordesconto=number_format(($artigonovo->precounitario* $artigonovo->quantidade)-  $artigonovo->valorSemIva,2 ,'.', '');
        $artigonovo->valorDoIva=$valordoiva;
        $artigonovo->totalComIva=$valorcomiva;
        $artigonovo->desconto=$request->desconto;
        $artigonovo->observacoes=$request->observacoes;
        if($request->sim=="on"){
            $artigonovo->visivelobs=1;
        }else {
            $artigonovo->visivelobs=0;
           
        }
        $artigonovo->fk_artigo=$request->fk_artigo;
        $artigonovo->fk_orcamento=$request->id;
        $artigonovo->fk_iva=$artigo->fk_iva;
        $orcamento=orcamento::find($request->id);
        $orcamento->valorSemIva= $orcamento->valorSemIva+ $artigonovo->valorSemIva;
        $orcamento->valorComIva= $orcamento->valorComIva+ $valorcomiva;
        $orcamento->valorDoIva= $orcamento->valorDoIva+ $valordoiva;
        $orcamento->desconto= $orcamento->desconto+$artigonovo->valordesconto;

       
        $orcamento->save();
        $artigonovo->save();


        // adicionar ao orcamento
        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $artigonovo->fk_orcamento]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removerartigo(Request $request)
    { 
         $artigosOrcamento=artigosOrcamento::find($request->id);
         $orcamento=orcamento::find($artigosOrcamento->fk_orcamento);
         $orcamento->valorSemIva-=$artigosOrcamento->valorSemIva;
         $orcamento->valorComIva-=$artigosOrcamento->totalComIva;
         $orcamento->valorDoIva-=$artigosOrcamento->valorDoIva;
         $orcamento->desconto-=$artigosOrcamento->valordesconto;
         $orcamento->save();
         $artigosOrcamento->delete();

         return 
         Redirect::to('/verorcamento') ->with(['id'=>  $artigosOrcamento->fk_orcamento]);




    }
    public function editarartigo(Request $request){
        $artigoo=artigosOrcamento::find($request->id);
        $artigo=artigo::find($artigoo->fk_artigo);
        $orcamento=orcamento::find($artigoo->fk_orcamento);
        $cliente=cliente::find($orcamento->fk_cliente);
        $potcliente=PotencialCliente::find($orcamento->fk_potCliente);
        $artigoorcamento=artigosOrcamento::where('fk_orcamento',$orcamento->pk_orcamento)->where('pk_artigoorcamento','!=',$request->id)->leftjoin('artigos','fk_artigo','pk_artigo')->get();
        return view('criar/orcamento4', compact('orcamento','cliente','potcliente','artigoorcamento','artigo','artigoo'));


    }
    public function updateartigo(Request $request){
      
         $artigonovo=artigosOrcamento::find($request->artigo);
         $orcamento=orcamento::find($request->id);
         $orcamento->valorSemIva-=$artigonovo->valorSemIva;
         $orcamento->valorComIva-=$artigonovo->totalComIva;
         $orcamento->valorDoIva-=$artigonovo->valorDoIva;
         $orcamento->desconto-=$artigonovo->valordesconto;
         $orcamento->save();
         

        
        $artigo=artigo::find($artigonovo->fk_artigo);
        $iva=iva::find($artigo->fk_iva);
        $artigonovo->quantidade=$request->quantidade;
        $artigonovo->precounitario=$request->precounitario;
        if ($request->desconto>0) {
         $valordoartigocomodesconto=number_format($artigonovo->precounitario-(   $request->desconto/100 *  $artigonovo->precounitario),2 ,'.', ''); 
        }else {
            $valordoartigocomodesconto= $artigonovo->precounitario;
        }
        $artigonovo->valorSemIva=number_format($request->quantidade* $valordoartigocomodesconto,2 ,'.', '');
        $valoriva= ($iva->valor_iva/100)+1;
        $valorcomiva=number_format($valoriva*$artigonovo->valorSemIva,2 ,'.', '');
        $valordoiva=number_format($valorcomiva-$artigonovo->valorSemIva,2 ,'.', '');
        $artigonovo->valordesconto=number_format(($artigonovo->precounitario* $artigonovo->quantidade)-  $artigonovo->valorSemIva,2 ,'.', '');
        $artigonovo->valorDoIva=$valordoiva;
        $artigonovo->totalComIva=$valorcomiva;
        $artigonovo->desconto=$request->desconto;
        $artigonovo->observacoes=$request->observacoes;
        if($request->sim=="on"){
            $artigonovo->visivelobs=1;
        }else {
            $artigonovo->visivelobs=0;
           
        }
 
        $artigonovo->fk_orcamento=$request->id;
        $artigonovo->fk_iva=$artigo->fk_iva;
     
        $orcamento->valorSemIva= $orcamento->valorSemIva+ $artigonovo->valorSemIva;
        $orcamento->valorComIva= $orcamento->valorComIva+ $valorcomiva;
        $orcamento->valorDoIva= $orcamento->valorDoIva+ $valordoiva;
        $orcamento->desconto= $orcamento->desconto+$artigonovo->valordesconto;

    
        $orcamento->save();
        $artigonovo->save();
        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $request->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fecharproposta(Request $request)
    { 
        $orcamento=orcamento::find($request->id);
        $orcamento->fk_estado=2;
        $orcamento->dataProposta=Carbon::now( )->format('Y-m-d');
        $orcamento->dataValidade=Carbon::now()->addDays(orc_prazo::where('pk_prazo',$orcamento->fk_prazo)->value('dias'))->format('Y-m-d');
        $orcamento->save();

        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }
 
    public function orcamentoPdf(Request $request){

        $css = file_get_contents(public_path('css/orcamento.css'));
    

         $orcamento=orcamento::find($request->id);
         if ( $orcamento->dataEnvioProposta==null and $orcamento->fk_estado>1) {
            $orcamento->dataEnvioProposta=Carbon::now( )->format('Y-m-d');
            $orcamento->save();

         }
         $cliente=cliente::find($orcamento->fk_cliente);
         $potcliente=PotencialCliente::find($orcamento->fk_potCliente);
         $artigoorcamento=artigosOrcamento::where('fk_orcamento',$orcamento->pk_orcamento)->leftjoin('artigos','fk_artigo','pk_artigo')->get();
         $empresa=empresa::find(1);
         $pdf = PDF::loadView('ver/orcamentopdf',compact('orcamento','cliente','empresa','potcliente','artigoorcamento'))->setPaper('a4', 'portrait');
         return $pdf->stream();
    }
    public function adjudicar(Request $request){
        $orcamento=orcamento::find($request->id);
        $orcamento->fk_estado=3;
        $orcamento->adjudicado=1;
        $orcamento->dataAdjudicacao=Carbon::now( )->format('Y-m-d');
        $orcamento->save();
        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }
    public function naoadjudicar(Request $request){
        $orcamento=orcamento::find($request->id);
        $orcamento->fk_estado=4;
        $orcamento->dataAdjudicacao=Carbon::now( )->format('Y-m-d');
        $orcamento->save();
        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }
    public function enviarnaoadjudicacao(Request $request){
        $orcamento=orcamento::find($request->id);
        $orcamento->motivoNaoAdjudicacao=$request->motivo;
        $orcamento->save();
        return 
        Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }

    public function reverproposta(Request $request){
        $orcamentoa=orcamento::find($request->id);
        $contador= orcamento::orderBy('pk_orcamento','DESC')->value('contador');
        if ($contador==null) {
           $contador=0;
        }
         $anoUltima= orcamento::orderBy('pk_orcamento','DESC')->value('ano');
      
        if ($anoUltima[0]==null or intval($anoUltima)!=date('y')) {
          $contador=0;
        }
        $contador=$contador+1;
        if ($contador<9) {
         $contador="0". $contador;
        }
        $orcamento= new orcamento;
        $orcamento->fk_cliente =  $orcamentoa->fk_cliente;
        $orcamento->fk_potCliente =  $orcamentoa->fk_potencialCliente;
        $orcamento->contador =   $contador;
        $tipo=orc_tipo::find($orcamentoa->fk_tipo);
        $empresa=empresa::where('pk_empresa',1)->value('nomeAbreviado');
        $codigoProjeto=$empresa.'_'.$tipo->abreviatura.'_'.carbon::parse($request->date)->format('my').$orcamento->contador;
        $orcamento->numeroOrcamento = $codigoProjeto;
        $orcamento->ano =  date('y');
        $orcamento->fk_prazo=$orcamentoa->fk_prazo;
        $orcamento->fk_tipo=  $orcamentoa->fk_tipo;
        $orcamento->fk_orcamentoRevisao=  $request->id;
        $orcamento->observacoes=  $orcamentoa->observacoes;
        $orcamento->desconto=  $orcamentoa->desconto;
        $orcamento->valorDoIva=  $orcamentoa->valorDoIva;
        $orcamento->valorComIva=  $orcamentoa->valorComIva;
        $orcamento->valorSemIva=  $orcamentoa->valorSemIva;
        $orcamento->fk_responsavel = auth::id();
        $orcamento->fk_estado = 1;
        $orcamento->save();
        
        $artigoorcamento=artigosOrcamento::where('fk_orcamento',$request->id)->get();

        for ($i=0; $i <count($artigoorcamento) ; $i++) { 
            $novoartigo=new artigosOrcamento;
            $novoartigo->quantidade=$artigoorcamento[$i]->quantidade;
            $novoartigo->precounitario=$artigoorcamento[$i]->precounitario;
            $novoartigo->valorSemIva=$artigoorcamento[$i]->valorSemIva;
            $novoartigo->valordesconto=$artigoorcamento[$i]->valordesconto;
            $novoartigo->valorDoIva=$artigoorcamento[$i]->valorDoIva;
            $novoartigo->totalComIva=$artigoorcamento[$i]->totalComIva;
            $novoartigo->desconto=$artigoorcamento[$i]->desconto;
            $novoartigo->observacoes=$artigoorcamento[$i]->observacoes;
            $novoartigo->visivelobs=$artigoorcamento[$i]->visivelobs;
            $novoartigo->fk_iva=$artigoorcamento[$i]->fk_iva;
            $novoartigo->fk_artigo=$artigoorcamento[$i]->fk_artigo;
            $novoartigo->fk_orcamento=$orcamento->pk_orcamento;
            $novoartigo->save();

        }

         
         return 
         Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);
    }
    
    public function orcamentocondicoes(Request $request){
        $orcamento=orcamento::find($request->id);
        $orcamento->condicoesEntrega=$request->condicoesentrega;
        $orcamento->condicoesPagamento=$request->concicoespagamento;
        $orcamento->observacoes=$request->observacoes;
        $orcamento->save();

        return 
         Redirect::to('/verorcamento') ->with(['id'=>  $orcamento->pk_orcamento]);

    }
    
}
