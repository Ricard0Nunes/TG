@extends('adminlte::page')
@section('venda', 'AdminLTE')
@section('content')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
     #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #40a431
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #40a431
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #40a431
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #40a431;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #40a431
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #40a431;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #40a431;
    font-size: 1.4em;
    border-top: 1px solid #40a431
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
<div id="invoice">

    <div class="toolbar hidden-print">
  
   
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <main>
                <div class="row ">
             
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <h2 class="to" style="padding-left:3%">       {{  $cliente->nomeCompleto}}</h2> 
                                <div class="address" style="padding-left:3%">       {{  $cliente->morada}}</div>
                                <div class="email" style="padding-left:3%"><a href="">{{  $cliente->email}}</a></div>
                            </div>
                            <div class="col-md-4 col-xs-12">

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="col invoice-details">
                                    <h1 class="invoice-id" style="padding-right:3%">Venda Nº:{{$venda->pk_venda}}</h1>
                                    <div class="date"  style="padding-right:3%">  Data Abertura:     {{  $venda->dataVenda}} </div>
                                    <div class="date"  style="padding-right:3%"> Data Fecho : {{  $venda->dataFechoVenda}}</div>
                                    
                                    <h2 class="invoice-id"  style="padding-right:3%">{{$estadoVenda}}</h2>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#Sku</th>
                            <th class="text-left">Produto-Armazem(Quantidade) Preço Compra €</th>
                          
                            <th class="text-right">Preço Venda</th>
                            <th class="text-right">Quantidade</th>
                            <th class="text-right">Total</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                   
                          @foreach ($artigosvenda as $artigosvenda)
                          <tr>
                              <td class="no"> 
                              
                                   @if ($venda->fk_estadovenda==1)
                                   {!! Form::open(array('route' => 'venda.removerartigo','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                       <a href="" > <input id="aaa" name="id" type="hidden" value={{$artigosvenda->pk_artigovenda}}>
                                            <button type="submit" class="fas fa-trash-alt btn btn-danger btn-sm">
                                       </button></a> 
                                   {!! Form::close()!!}
                                   @endif
                                

                                       {{ $artigosvenda->sku}}
                                    </td>
                              <td class="text-left"><h3>
                                   {{$artigosvenda->descricao}}
                                  </h3>
                                  {{ $artigosvenda->caracteristicas}}
                                  <br>
                                 <small>Armazem: {{ App\inventario::where('pk_inventario',$artigosvenda->fk_inventario)->leftjoin('armazens','pk_armazem','fk_armazem')->value('nome')}}({{ App\inventario::where('pk_inventario',$artigosvenda->fk_inventario)->leftjoin('armazens','pk_armazem','fk_armazem')->value('localizacao')}})</small> 
                              </td>
                           
                              <td class="unit">{{ $artigosvenda->precoUnitario}}€</td>
                              <td class="qty">{{ $artigosvenda->quantidade}}</td>
                              <td class="total">{{ $artigosvenda->precoTotal}}€</td>
                         
                          </tr> 
                          @endforeach
                          @if ($venda->fk_estadovenda==1)
                          <tr>
                              {!! Form::open(array('route' =>['venda.adicionarartigo','fk_venda'=>$venda->pk_venda],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
                          
                       

                             
                              <td class="text-center" ><button type="submit" class="btn btn-success">Adicionar</button></td>
                              <td class="text-center"> 
                                    {{-- {!! Form::label('fk_familiaArtigo','Família de Artigo (*)',['class'=>'col-sm-2 control-label']) !!} --}}
                            
                                    <div class="col-sm-12">
                                      {{-- {!! Form::select('fk_artigo',$artigos,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Adicionar Artigo','required'=>'required']) !!} --}}
                                      <select id="artigo" class="form-control" name="fk_inventario">
                                        <option value="">Escolha o Produto</option>
                         
                                        @foreach ($artigos as $artigos)
                                        <option value="{{$artigos->pk_inventario}}"  @if(old('fk_inventario') == $artigos->pk_inventario) selected @endif>
                                           {{$artigos->descricao}} - Armazem: {{$artigos->nome}} ({{$artigos->quantidade}}) {{$artigos->ultimoPrecoCompra}} €
                                        </option> 
                         
                                        @endforeach
                                        
                                      </select>
                                    </div>
                              </td>
                              
                              <td class="text-center" >
                                    <div class="col-sm-5 pull-right" >
                                    {!! Form::text('precoVenda',null,['class'=>'form-control','required'=>'required']) !!}
                                    </div>
                              </td>
                              <td class="text-center"> <div class="col-sm-5 pull-right" >
                                     {!! Form::text('quantidade',null,['class'=>'form-control','required'=>'required']) !!}
                              </div></td>
                              <td>--</td>

                              
                          </tr>
                         @endif
                          <tr>
                          
                       @if (session('Warning'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                        <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                        <strong> {{ session('Warning') }} 
                            
                            {{ Form::hidden('confirma', 'sim', array('id' => 'start')) }}
                            <a href="" > <input id="invisible_id" name="id" type="hidden" value={{session('id')}}>
                                <button type="submit" class="btn btn " text="a"> Sim
                            </button>
                            </a> </strong>
                        </div>
                        
                        @endif
                        @if (session('Warning1'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                        <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                        <strong> {{ session('Warning1') }} 
                            
                            {{ Form::hidden('confirmapreco', 'sim', array('id' => 'start')) }}
                            <a href="" > <input id="invisible_id" name="id" type="hidden" value={{session('id')}}>
                                <button type="submit" class="btn btn " text="a"> Sim
                            </button>
                            </a> </strong>
                        </div>
                        
                        @endif
                        {!! Form::close()!!}
                        @if (session('Warning2'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                        <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                        <strong> {{ session('Warning2') }} 
                            
                           </strong>
                        </div>
                        
                        @endif
                    </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Quantidade</td>
                            <td>{{$quantidade}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Total</td>
                            <td>{{$total}}€</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">--</td>
                            <td>--</td>
                        </tr> --}}
                        @if ($venda->fk_estadovenda==1 and $quantidade>0)
                            
                     
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Fechar Venda</td>
                            <td>
                                <div class="pull-right">
                                  
                                    {!! Form::open(array('route' => 'venda.fechar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$venda->pk_venda}}">
                                            <button type="submit" class="btn btn-primary btn far fa-check-square  pull-right"> OK
                                               
                                           </button></a> 
                                           <div class="pull-right">
                                              <span style=" display: inline;">
                                          
                             
                                          
                                    {!! Form::close()!!}                                    </div>
                        
                                  </div>
                            </td>
                        </tr>
                        @endif
                          
                    </tfoot>
                </table>
                
                <div class="thanks"></div>
                <div class="notices">
                    {{-- <div>Aviso:</div>
                    <div class="notice">A proposta é válida até dia X e os preços podem variar consoante o mercado</div> --}}
                </div>
            </main>
            <footer>
               Esta venda foi processada através do Turtlegest, pelo utilizador: {{DB::table('users')->where('id',$venda->fk_responsavel)->value('name')}} 
            </footer>
<br><br>
            <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-5" >
        
                    </div>
             
    
                            <div class="col-xs-12 col-sm-12 col-md-2" >
                                    <a href="{{ URL::previous() }}"  ><button type="button" class="btn btn-block btn-warning btn-flat">
                                            Voltar</button></a>
                                </div>
                                <div class="col-xs-12 col-sm-12 c2ol-md-5" >
        
                    </div>
        </div>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>

@stop
