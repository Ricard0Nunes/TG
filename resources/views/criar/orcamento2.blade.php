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
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">
                   
                                   
                
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                @if ($orcamento->fk_cliente!=null)
                                <h2 class="to" style="padding-left:3%">{{$cliente->nomeCompleto}} </h2> 
                                <div class="address" style="padding-left:3%">{{$cliente->morada}}</div>
                                <div class="email" style="padding-left:3%"><a href="">{{$cliente->email}}</a></div>
                                <div class="email" style="padding-left:3%"><a href="">{{$cliente->contacto}}</a></div>
                                <div class="address" style="padding-left:3%">NIF:{{$cliente->NIF}}</div>
                                @else
                                <h2 class="to" style="padding-left:3%">{{$potcliente->nomeCompleto}} </h2> 
                                <div class="address" style="padding-left:3%">{{$potcliente->morada}}</div>
                                <div class="email" style="padding-left:3%"><a href="">{{$potcliente->email}}</a></div>
                                <div class="email" style="padding-left:3%"><a href="">{{$potcliente->contacto}}</a></div>
                                <div class="address" style="padding-left:3%">NIF:{{$potcliente->NIF}}</div>
                                @endif 
                              
                            </div>
                            <div class="col-md-2 col-xs-12">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="col invoice-details">
                                    @if ($orcamento->fk_tipo==null)
                                    <h1 class="invoice-id" style="padding-right:3%">Orçamento Nº: *********** {{$orcamento->contador}} </h1>
                                    <br>
                                    @else
                                    <h1 class="invoice-id" style="padding-right:3%">Orçamento Nº: {{$orcamento->numeroOrcamento}}</h1>
                                    @endif
                                   
                                       
                                   
                                    {!! Form::open(array('route' =>  ['orcamento3','id'=>$orcamento->pk_orcamento],'method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}

                                    <div class="">  <div class="form-group ">
                                        <div class="col-sm-2">
                                        </div>
                                        
                                        {!! Form::label('tipoorcamento','Tipo (*)',['class'=>'col-sm-2 control-label']) !!}

                                        <div class="col-sm-8">
                                              {!! Form::select('tipoorcamento', $tipocorcamento,$orcamento->fk_tipo,['class'=>'form-control']) !!}
                                        </div>    
                                  </div>       </div> <br>
                                   <br>
                                  <div class=""><div class="form-group ">
                                    <div class="col-sm-2">
                                    </div>
                                    {!! Form::label('prazo','Prazo (*)',['class'=>'col-sm-2 control-label']) !!}

                                    <div class="col-sm-8">
                                        {!! Form::select('prazo', $prazo,$orcamento->fk_prazo,['class'=>'form-control']) !!}                                  </div>    
                              </div>    </div>
                              <br><br><br>
                              <br>  <div><div class="form-group ">
                                <div class="col-sm-4">   
                                </div>  
                                <div class="col-sm-4">
                           
                                    <div class="col-sm-4">    <button type="submit" class="btn btn-success pull-right ">Enviar</button>
                                      </div>  
                          </div>    </div>
                   
                                 
                         
                                </div>
                      
                            </div>
                        </div>
                        {!! Form::close()!!} 
                    </div>
                    
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#Sku</th>
                            <th class="text-left">Produto</th>  
                            <th class="text-right">Preço Uni. s/IVA</th>
                            <th class="text-right">Qty.</th>
                            <th class="text-right">Desconto (%)</th>
                            <th class="text-right">Valor Desconto</th>
                            <th class="text-right">Valor Liquido</th>
                            <th class="text-right">IVA</th>
                            <th class="text-right">Valor IVA</th>
                            <th class="text-right">Total a Pagar c/IVA</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                   
                        {{-- @foreach ($artigosvenda as $artigosvenda) --}}
                        <tr>
                            <td class="no"> 
                            
                        
                                  </td>
                            <td class="text-left"><h3>
                           
                                </h3>
                         
                                <br>
                               <small> </small> 
                            </td>
                            <td class="qty"style="background-color:#d5d5d5">€</td>
                            <td class="qty"></td>
                            <td class="qty"style="background-color:#d5d5d5">%</td>
                            <td class="qty">€</td>
                            <td class="qty"style="background-color:#d5d5d5">€</td>
                            <td class="qty">%</td>
                            <td class="qty"style="background-color:#d5d5d5">€</td>
                            <td class="total">€</td>
                    
                       
                        </tr> 
                        {{-- @endforeach --}}
                        {{-- @if ($venda->fk_estadovenda==1) --}}
           
                  </tbody>
                  <tfoot>
         
                      <tr>
                          <td colspan="3"></td>
                          <td colspan="6">Total s/IVA</td>
                          <td>€</td>
                      </tr>
                      <tr>
                          <td colspan="3"></td>
                          <td colspan="6">Total do IVA</td>
                          <td>€</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td colspan="6">Total Desconto</td>
                        <td>€</td>

                    </tr>
                      <tr>
                          <td colspan="3"></td>
                          <td colspan="6">Total c/IVA</td>
                          <td>€</td>
                      </tr>
 
                        
                  </tfoot>
                </table>
                
                <div class="thanks"></div>
                <div class="notices">
                    {{-- <div>Aviso:</div>
                    <div class="notice">A proposta é válida até dia X e os preços podem variar consoante o mercado</div> --}}
                </div>
            </main>
            <footer>
               Esta venda foi processada através do Turtlegest, pelo utilizador: UTILIZADOR 
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
