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
                            <div class="col-md-7 col-xs-12">
                                 <div class="form-group">
                                    {!! Form::open(array('route' => 'store.iniciar','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
                                    {!! Form::label('simNao','Tipo de Cliente (*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                          <div id="radioButtons">
                                                <input type="radio" name="simNao" id="radio_Sim" value="1" required="" >Potencial Cliente
                                                <br>
                                                <input type="radio" name="simNao" id="radio_Nao" value="0" required >Cliente
                                          </div>
                                    </div>
                              </div>
                                <div id="potencial"class="hidden">
                                    <div class="form-group ">
                                          <div class="col-sm-3">
                                                {!! Form::select('potencialCliente', $potCliente,null,['class'=>'form-control']) !!}
                                          </div>    
                                    </div>       </div>
                                <div id="cliente"class="hidden">         <div class="form-group">
                                    <div class="col-sm-3">
                                          {!! Form::select('cliente', $cliente,null,['class'=>'form-control']) !!}
                                    </div>    
                              </div>       </div>
                              <button type="submit" class="btn btn-success ">Enviar</button>
                            </div>
                            <script>
                              var radio = document.getElementsByName('simNao'); 
                              for (var i = 0; i < radio.length; i++) {
                                    radio[i].onclick = function() {
                                          var valorRadio = this.value; 
                                          if(valorRadio == '1'){
                                                document.getElementById("potencial").className = ""; 
                                                document.getElementById("cliente").className = "hidden";  
 
                                          }
                                          else if(valorRadio == '0'){
                                                document.getElementById("potencial").className = "hidden"; 
                                                document.getElementById("cliente").className = "";  

                                          }
                                    }
                              }
                        </script>
                            <div class="col-md-4 col-xs-12">

                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Orçamento Nº:</h1>
                                    <div class="date">  Data Início:    </div>
                                    <div class="date"> Data de Vencimento : </div>
                                    
                                    <h2 class="invoice-id"></h2>
                                    
                                </div>
                            </div>
                        </div>
                       
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
                      </div>
            </main>
      
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
