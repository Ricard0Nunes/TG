@extends('adminlte::page')
@section('venda', 'AdminLTE')
@section('content')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                                   
                                       
                                   
                                    {!! Form::open(array('route' =>  ['orcamento3','id'=>$orcamento->pk_orcamento],'method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}

                                    <div class="">  <div class="form-group ">
                                        <div class="col-sm-2">
                                        </div>
                                        
                                        {!! Form::label('tipoorcamento','Tipo (*)',['class'=>'col-sm-2 control-label']) !!}

                                        <div class="col-sm-8">
                                              {!! Form::select('tipoorcamento', $tipocorcamento,null,['class'=>'form-control']) !!}
                                        </div>    
                                  </div>       </div> <br>
                                   <br>
                                  <div class=""><div class="form-group ">
                                    <div class="col-sm-2">
                                    </div>
                                    {!! Form::label('prazo','Prazo (*)',['class'=>'col-sm-2 control-label']) !!}

                                    <div class="col-sm-8">
                                        {!! Form::select('prazo', $prazo,null,['class'=>'form-control']) !!}                                  </div>    
                              </div>    </div>
                              <br><br><br>
                              <br>  <div><div class="form-group ">
                                <div class="col-sm-4">   
                                </div>  
                                <div class="col-sm-4">
                                  <span><strong>Estado:</strong>   {{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}     </span>      </div>  
                                  <div class="col-sm-4">    <button type="submit" class="btn btn-success pull-right ">Enviar</button>
                                      </div>  
                          </div>    </div>
                      
                          @else
                        
                                <h1 class="invoice-id" style="padding-right:3%">Orçamento Nº: {{$orcamento->numeroOrcamento}}</h1>
                                <div class="date" style="padding-right:3%">  TIPO: {{App\orc_Tipo::where('pk_orcTipo',$orcamento->fk_tipo)->value('tipoOrcamento')}}   </div>
                                <div class="date" style="padding-right:3%"> ESTADO: {{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}</div>
                                <div class="date" style="padding-right:3%"> Prazo: {{App\orc_prazo::where('pk_prazo',$orcamento->fk_prazo)->value('prazo')}}  </div>
                                <div class="date" style="padding-right:3%">
                                    @if ($orcamento->dataProposta==null)
                                    Data Proposta : {{carbon\carbon::now()}}
                                    @else
                                    Data Proposta : {{$orcamento->dataProposta}}
                                    @endif </div>
                                <div class="date" style="padding-right:3%">
                                    @if ($orcamento->fk_estado==1)
                                    {!! Form::open(array('route' => 'fecharproposta','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    <input id="invisible_id"  name="id" type="hidden" value={{$orcamento->pk_orcamento}}>
                                      <button type="submit" style="btn btn-block btn-warning btn-flat ">Fechar Proposta
                                     </button>
                                     <div class="pull-right">
                                        <span style=" display: inline;">
                                    
                                        {!! Form::close()!!}
                                        </span>
                                      
                                      </a>
                                     </div>
                                    @else
                                    {!! Form::open(array('route' => 'fecharproposta','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    <input id="invisible_id"  name="id" type="hidden" value={{$orcamento->pk_orcamento}}>
                                      <button type="submit" style="btn btn-block btn-warning btn-flat ">Adjudicar/não adjudicar/rever
                                     </button>
                                     <div class="pull-right">
                                        <span style=" display: inline;">
                                    
                                        {!! Form::close()!!}
                                        </span>
                                      
                                      </a>
                                     </div>
                                    @endif
                            
                              
                          @endif
                                 
                         
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
                            <th class="text-left">Produto <br> Observações</th>  
                            <th class="text-right">Preço Uni. s/IVA</th>
                            <th class="text-right">Qty.</th> 
                            <th class="text-right">Desconto (%) </th>
                             <th class="text-right">Valor Desconto</th> 

                            <th class="text-right">Valor Liquido</th>
                            <th class="text-right">IVA</th>
                            <th class="text-right">Valor IVA</th>
                            <th class="text-right">Total a Pagar c/IVA</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                   
                          @foreach ($artigoorcamento as $artigoorcamento)
                          <tr>
                              <td class="no"> 
                              
                              
                                   #{{ $artigoorcamento->sku}}

                                  
                                

                               
                                    </td>
                              <td class="text-left"style="background-color:#d5d5d5"><h3>
                                {{$artigoorcamento->descricao}}
                                  </h3>
                                  {{$artigoorcamento->observacoes}}
                                  <br>
                                  <small>Visível p/impressão" <input type="checkbox" name="sim" disabled  {{$artigoorcamento->visivelobs == 1 ?' checked':''}}></small>

                                 <small></small> 
                              </td>
                              <td class="qty" >{{number_format($artigoorcamento->precounitario,2 ,'.', '')}}€/uni</td>
                              <td class="qty"style="background-color:#d5d5d5">{{$artigoorcamento->quantidade}}</td>
                          
                              <td class="qty">{{number_format($artigoorcamento->desconto,2 ,'.', '')}}%</td>
                              <td class="qty"style="background-color:#d5d5d5">{{$artigoorcamento->valordesconto}}€</td>
                              <td class="qty">{{number_format($artigoorcamento->valorSemIva,2 ,'.', '')}}€</td>
                              <td class="qty"style="background-color:#d5d5d5">{{number_format(App\iva::where('pk_iva',$artigoorcamento->fk_iva)->value('valor_iva'),2 ,'.', '')}}%</td>
                              <td class="qty">{{number_format($artigoorcamento->valorDoIva,2 ,'.', '')}}€</td>
                              <td class="total">{{number_format($artigoorcamento->totalComIva,2 ,'.', '')}}€/IVA inc.</td>
                          </tr> 
                          @endforeach
                          {{-- @if ($venda->fk_estadovenda==1) --}}
                          
                          <tr>

                              {!! Form::open(array('route' =>['editarartigoorcamento','id'=>$orcamento->pk_orcamento, 'artigo'=> $artigoo->pk_artigoorcamento],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!} 
                          
                       

                             
                              <td class="text-center" ><button type="submit" class="btn btn-success">Adicionar</button></td>
                              <td class="text-left"style="background-color:#d5d5d5"><h3>
                                {{$artigo->descricao}}
                                  </h3>
                                    <br>
                                    <div class="row" >
                                        {!! Form::label('observacoes','Observações (*)',['class'=>'col-sm-12 control-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('observacoes',$artigoo->observacoes,['class'=>'form-control','rows' =>'3']) !!}
                                            <small>Visível p/impressão <input type="checkbox" checked name="sim" > </small>
                                        </div>
                                    </div>
                              </td>
                              <td class="text-center" >
                                <div class="col-sm-10 pull-right" >
                                    {!! Form::text('precounitario',$artigoo->precounitario,['class'=>'form-control','required'=>'required']) !!}
                                   </div>
                        </td>
                              <td class="text-center" style="background-color:#d5d5d5">
                                <div class="col-sm-10 pull-right" >
                                {!! Form::text('quantidade',$artigoo->quantidade,['class'=>'form-control','required'=>'required']) !!}
                                </div>
                            </td>
                            <td class="text-center"> <div class="col-sm-10 pull-right" >
                                {!! Form::text('desconto',$artigoo->desconto,['class'=>'form-control']) !!}
                                </div></td>
                               
                                
                                <td style="background-color:#d5d5d5">
                                    <div class="col-sm-10 pull-right" >
                                        {!! Form::text('valordesconto',$artigoo->valordesconto,['class'=>'form-control','readonly']) !!}
                                        </div></td>
                                </td>
                                <td class="text-center" >
                                    <div class="col-sm-10 pull-right" >
                                        {!! Form::text('valorliquido',$artigoo->valorSemIva,['class'=>'form-control','readonly']) !!}
                                        </div></td>
                            </td>
                            <td style="background-color:#d5d5d5">
                                <div class="col-sm-10 pull-right" >
                                    {!! Form::text('iva',number_format(App\iva::where('pk_iva',$artigoo->fk_iva)->value('valor_iva'),2 ,'.', ''),['class'=>'form-control','readonly']) !!}
                                    </div>
                            </td>
                            <td> <div class="col-sm-10 pull-right" >
                                {!! Form::text('valoriva',$artigoo->valorDoIva,['class'=>'form-control','readonly']) !!}
                                </div></td>
                            <td class="total" >
                                <div class="col-sm-10 pull-right" >
                                    {!! Form::text('totalcomiva',$artigoo->totalComIva,['class'=>'form-control','readonly']) !!}
                                    </div>
                             </td>
                          </tr>
                          <tr >
                          
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
                            <td colspan="3"></td>
                            <td colspan="6">Total s/IVA</td>
                            <td>{{number_format($orcamento->valorSemIva,2 ,'.', '')}}€</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="6">Total Desconto</td>
                            <td>{{number_format($orcamento->desconto,2 ,'.', '')}}€</td>

                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="6">Total do IVA</td>
                            <td>{{number_format($orcamento->valorDoIva,2 ,'.', '')}}€</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="6">Total c/IVA</td>
                            <td>{{number_format($orcamento->valorComIva,2 ,'.', '')}}€</td>

                        </tr>
                        {{-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">--</td>
                            <td>--</td>
                        </tr> --}}
                        {{-- @if ($venda->fk_estadovenda==1 and $quantidade>0)
                            
                     
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
                        @endif --}}
                          
                    </tfoot>
                </table>
                
                <div class="thanks"></div>
                <div class="notices">
                    {{-- <div>Aviso:</div>
                    <div class="notice">A proposta é válida até dia X e os preços podem variar consoante o mercado</div> --}}
                </div>
            </main>
            <footer>
               Orçamento processado através do Turtlegest, pelo utilizador: {{App\user::where('id',$orcamento->fk_responsavel)->value('name')}} 
            </footer>
<br><br>
            <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-5" >
        
                    </div>
             
    
                            <div class="col-xs-12 col-sm-12 col-md-2" >


                                {!! Form::open(array('route' => 'orcamento.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$orcamento->pk_orcamento}}>
                                    <button type="submit" class="btn btn-success" text="Ver Proposta"> Atualizar
                                   </button>
                                </a> 
                                    {!! Form::close()!!}
                                    <a href=" /orcamentos"  ><button type="button" class="btn btn-block btn-warning btn-flat">
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
<script  type="text/javascript">
    $('#familiaartigos').on('change', function(e){
        console.log(e);
        var pk_familiaartigos = e.target.value;
        
        $.get('/ajax-artigos?pk_familiaartigos='+ pk_familiaartigos, function(data){
            $('#artigo').empty();
            $('#artigo').append('<option value="">' +'Escolha um artigo'+ '</option>');
            $.each(data, function(index, artigoObj){
                $('#artigo').append('<option value="' + artigoObj.pk_artigo + '">' + artigoObj.descricao + '</option>');
            });
        });
       

    });


</script>
<script  type="text/javascript">
    $('#artigo').on('change', function(e){
        console.log(e);
        var pk_artigo = e.target.value;
        
        $.get('/ajax-valor?pk_artigo='+ pk_artigo, function(data){
            $('#valor').empty();
            // $('#valor').append('<input  value="'+ valorObj.precoCompra +'">');
            $.each(data, function(index, valorObj){
                $('#valor').val(valorObj.precoCompra);
            });
        });
       

    });

    // '<input type="text" name="valorsemiva" value="'+ valorObj.precoCompra +'" class="form-control" required>'
</script>
<script>
     var novalinha = document.getElementById('adicionar'); 
                             
                                    novalinha.onclick = function() {
                                         
                                         
                                                document.getElementById("novalinha").className = ""; 
                                                document.getElementById("adicionar").className = "hidden";  
 
                                       
                                    }
                              
</script>
@stop
