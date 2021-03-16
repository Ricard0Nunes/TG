@extends('adminlte::page')
@section('Compra', 'AdminLTE')
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
        <div class="text-right">
            {{-- {!! Form::open(array('route' => 'compras.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
            <div class="form-group">
                {!! Form::label('fk_fornecedor','Fornecedor (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::select('fk_fornecedor',$fornecedores,null,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('fk_fornecedor','<p class="alert alert-danger">:message</p>')!!}
                </div> --}}
{{-- 
          </div>
          {!! Form::close()!!} --}}
        </div>
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
                            <div class="col-md-4">
                                <h2 class="to">    G7 </h2> 
                                <div class="address">  ~RUA DA NOSSA SENHORA DOS AFLITOS     </div>
                                <div class="email"><a href="">EMAILFAKE@bro.pt</a></div>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Encomenda Nº:</h1>
                                    <div class="date">  Data Abertura:     </div>
                                    <div class="date"> Data Fecho : </div>
                                    
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
                            <th class="text-left">Produto/Descrição</th>
                            <th class="text-right">Preço Uni.</th>
                            <th class="text-right">Quantidade</th>
                            <th class="text-right">Total</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                   
                      
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Quantidade</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Total</td>
                            <td>€</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">--</td>
                            <td>--</td>
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
               Esta encomenda foi processada através do Turtlegest. 
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>

@stop
