@extends('adminlte::page')
@section('Artigo', 'AdminLTE')
@section('content')
<style>
    #tabs.active{
        border-top:3px solid #00a65a !important;
    } 
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable(  );
    } );
</script>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">VER ARTIGO  #{{$artigo->sku}} {{$artigo->descricao}}</h3>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-2 col-lg-2">
            <img class=" zoomable" width="100%" src="{{asset($artigo->foto)}}" alt="Foto do Artigo"><br>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <h3 class="box-title">
                <strong>Preço:</strong>{{number_format($artigo->precoCompra,2 ,'.', '')}}€
                
                
             @if ($artigo->tipoartigo==0)
             <br>
             <strong>Preço Médio Compra:</strong> {{number_format($precomedio,2 ,'.', '')}}€  
             @endif   
             <br>
             <strong>Iva:</strong>{{number_format(App\Iva::where('pk_iva',$artigo->fk_iva)->value('valor_iva'),2 ,'.', '')}}%
                <br>
                <strong> Peso:</strong>{{$artigo->peso}} Kg
                <br>
                <strong>Família de Artigos:</strong>{{$familiaartigo->descricao}}
                
                @if ($artigo->tipoartigo!=2)
                <br>
                <strong>Stock:</strong>{{$emstock}} Encomendados:{{$encomendados}} 
                @endif  
                
            </h3>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <h3 class="box-title"><strong>Características: </strong>{{$artigo->caracteristicas}}
            </h3>
        </div>
    </div>

    </div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li id="tabs" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Inventário</a></li>                      
        <li id="tabs" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Histórico de Compras</a></li>
        <li id="tabs" class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Histórico de Vendas</a></li>
    
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        
                        <th class="text-center">Artigo</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Ultimo Preço Compra</th>
                        <th class="text-center">Armazem</th>
                        <th class="text-center">Gerir</th>
  

                    
                    </tr>
                </thead>
                <tbody>
                @foreach ($inventario as $inventario)
        
                <td class="text-center">{{$artigo->descricao}}</td>                      
                <td class="text-center">{{$inventario->quantidade}}</td>
                <td class="text-center">{{$inventario->ultimoPrecoCompra}}</td>
                <td class="text-center">{{App\armazem::where('pk_armazem',$inventario->fk_armazem)->value('nome')}} </td>
                <td class="text-center"></td>

                   
                   
                </tr>
            @endforeach
            </tbody>
            </table>


        </div>
        <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-5" >
    
                </div>
         

                        <div class="col-xs-12 col-sm-12 col-md-2" >
                                <a href="{{ URL::previous() }}"  ><button type="button" class="btn btn-block btn-warning btn-flat">
                                        Voltar</button></a>
                            </div>
                            <div class="col-xs-12 col-sm-12 c2ol-md-5" >
    
                </div>
    </div><br><br>
        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-12">
                    
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
<script>
    let draw1=!1;           
$(document).ready(function() {
const table1=$('#aa').DataTable( {
"pageLength": 5,
"language": {
    "sEmptyTable":"Não foi encontrado nenhum registo", "sLoadingRecords":"A carregar...", "sProcessing":"A processar...", "sLengthMenu":"Mostrar _MENU_ registos", "sZeroRecords":"Não foram encontrados resultados", "sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos", "sInfoEmpty":"A mostrar de 0 até 0 de 0 registos", "sInfoFiltered":"(filtrado de _MAX_ registos no total)", "sInfoPostFix":"", "sSearch":"Procurar:", "sUrl":"", "oPaginate": {
        "sFirst": "Primeiro", "sPrevious": "Anterior", "sNext": "Seguinte", "sLast": "Último"
    }
    , "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente", "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
}
);
$.fn.dataTable.ext.errMode='none';
const tableData1=getTableData1(table1);
createHighcharts1(tableData1);
}

);
function getTableData1(table1) {
const dataArray1=[],
countryArray1=[],
populationArray1=[],
densityArray1=[];
table1.rows( {
search: "applied"
}
).every(function() {
const data1=this.data();
countryArray1.push(data1[2]);
populationArray1.push(parseInt(data1[5].replace(/\, /g, "")));
densityArray1.push(parseInt(data1[6].replace(/\, /g, "")))
}
);
dataArray1.push(countryArray1, populationArray1, densityArray1);
return dataArray1
}

function createHighcharts1(data1) {
Highcharts.setOptions( {
lang: {
    thousandsSep: ","
}
}
);
Highcharts.chart("chart1", {
title: {
    text: "Gráfico representativo da relação Quantidade/Custo Compras"
}
, subtitle: {
    text: ""
}
, xAxis:[ {
    categories:data1[0], labels: {
        rotation: 0
    }
}
], yAxis:[ {
    title: {
        text: "Quantidade"
    }
}
, {
    title: {
        text: "Custo"
    }
    , min:0, opposite:!0
}
], series:[ {
    name:"Qty.", color:"#0071A7", type:"column", data:data1[1], tooltip: {
        valueSuffix: ""
    }
}
, {
    name:"Custo", color:"#FF404E", type:"spline", data:data1[2], tooltip: {
        valueSuffix: " €"
    }
    , yAxis:1
}
], tooltip: {
    shared: !0
}
, legend: {
    backgroundColor: "#ececec", shadow: !0
}
, credits: {
    enabled: !1
}
, noData: {
    style: {
        fontSize: "16px"
    }
}
}
)
}
function setTableEvents1(table1) {
table1.on("page", ()=> {
  draw1=!0
}
);
table1.on("draw", ()=> {
  if(draw1) {
      draw1=!1
  }
  else {
      const tableData1=getTableData1(table1);
      createHighcharts1(tableData1)
  }
}
)
}

            </script>
         <div id="chart1"></div>
                    <table id="aa" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Nº Encomenda</th>
                                <th class="text-center">Data Recepção</th>
                                <th class="text-center">Fornecedor</th>

                                <th class="text-center">Estado</th>
                                <th class="text-center">Encomendado por</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center">Preço Unitário</th>
                                <th class="text-center">Gerir</th>

                            
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($artigoscompra as $artigoscompra)
                
                        <td class="text-center">{{$artigoscompra->fk_compra}}</td>
                        <td class="text-center">{{$artigoscompra->dataRecebimento}}</td>    
                        <td class="text-center">{{App\fornecedor::where('pk_fornecedor',$artigoscompra->fk_fornecedor)->value('nomeAbreviado')}}</td>    
                        <td class="text-center">{{DB::table('estado_compra')->where('pk_estadocompra',$artigoscompra->fk_estadoCompra)->value('estado')}}</td>                  
                        <td class="text-center">  <img src= {{$artigoscompra->foto}}  class="img-circle img-sm" alt="User Image">    ({{$artigoscompra->sigla}}) {{$artigoscompra->name}}</td>
                        <td class="text-center">{{$artigoscompra->quantidade}}</td>
                        <td class="text-center">{{$artigoscompra->precoUnitario}} €</td>
                        <td class="text-center"></td> 
    
                           
                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                   
                </div>
            </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-md-12">
                            <script>
                                let draw3=!1;
                               $(document).ready(function() {
                                   const table3=$('#cc').DataTable( {
                                       "pageLength": 5,
                                       "language": {
                                           "sEmptyTable":"Não foi encontrado nenhum registo", "sLoadingRecords":"A carregar...", "sProcessing":"A processar...", "sLengthMenu":"Mostrar _MENU_ registos", "sZeroRecords":"Não foram encontrados resultados", "sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos", "sInfoEmpty":"A mostrar de 0 até 0 de 0 registos", "sInfoFiltered":"(filtrado de _MAX_ registos no total)", "sInfoPostFix":"", "sSearch":"Procurar:", "sUrl":"", "oPaginate": {
                                               "sFirst": "Primeiro", "sPrevious": "Anterior", "sNext": "Seguinte", "sLast": "Último"
                                           }
                                           , "oAria": {
                                               "sSortAscending": ": Ordenar colunas de forma ascendente", "sSortDescending": ": Ordenar colunas de forma descendente"
                                           }
                                       }
                                   }
                                   );
                                   $.fn.dataTable.ext.errMode='none';
                                   const tableData3=getTableData3(table3);
                                   createHighcharts3(tableData3);
                               }
                               
                               );
                               function getTableData3(table3) {
                                   const dataArray3=[],
                                   countryArray3=[],
                                   populationArray3=[],
                                   densityArray3=[];
                                   table3.rows( {
                                       search: "applied"
                                   }
                                   ).every(function() {
                                       const data3=this.data();
                                       countryArray3.push(data3[2]);
                                       populationArray3.push(parseInt(data3[5].replace(/\, /g, "")));
                                       densityArray3.push(parseInt(data3[6].replace(/\, /g, "")))
                                   }
                                   );
                                   dataArray3.push(countryArray3, populationArray3, densityArray3);
                                   return dataArray3
                               }
                               
                               function createHighcharts3(data3) {
                                   Highcharts.setOptions( {
                                       lang: {
                                           thousandsSep: ","
                                       }
                                   }
                                   );
                                   Highcharts.chart("chart3", {
                                       title: {
                                           text: "Gráfico representativo da relação Quantidade/Custo Vendas"
                                       }
                                       , subtitle: {
                                           text: ""
                                       }
                                       , xAxis:[ {
                                           categories:data3[0], labels: {
                                               rotation: 0
                                           }
                                       }
                                       ], yAxis:[ {
                                           title: {
                                               text: "Quantidade"
                                           }
                                       }
                                       , {
                                           title: {
                                               text: "Preço Unitário"
                                           }
                                           , min:0, opposite:!0
                                       }
                                       ], series:[ {
                                           name:"Qty.", color:"#0071A7", type:"column", data:data3[1], tooltip: {
                                               valueSuffix: ""
                                           }
                                       }
                                       , {
                                           name:"Preço U.", color:"#FF404E", type:"spline", data:data3[2], tooltip: {
                                               valueSuffix: " €"
                                           }
                                           , yAxis:1
                                       }
                                       ], tooltip: {
                                           shared: !0
                                       }
                                       , legend: {
                                           backgroundColor: "#ececec", shadow: !0
                                       }
                                       , credits: {
                                           enabled: !1
                                       }
                                       , noData: {
                                           style: {
                                               fontSize: "16px"
                                           }
                                       }
                                   }
                                   )
                               }
                               
                               function setTableEvents3(table3) {
                                     table3.on("page", ()=> {
                                         draw3=!0
                                     }
                                     );
                                     table3.on("draw", ()=> {
                                         if(draw3) {
                                             draw3=!1
                                         }
                                         else {
                                             const tableData3=getTableData3(table3);
                                             createHighcharts3(tableData3)
                                         }
                                     }
                                     )
                                 }                  </script>
                                                   <div id="chart3"></div>
                            <table id="cc" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nº Venda</th>
                                        <th class="text-center">Data Venda</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Responsável</th>
                                        <th class="text-center">Quantidade</th>
                                        <th class="text-center">Preço Unitário</th>
                                        <th class="text-center">Gerir</th>
        
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($artigosvenda as $artigosvenda)
                        
                                <td class="text-center">{{$artigosvenda->fk_venda}}</td>
                                <td class="text-center">{{$artigosvenda->dataFechoVenda}}</td>   
                                <td class="text-center">{{App\cliente::where('pk_cliente',$artigosvenda->fk_cliente)->value('nomeAbreviado')}}</td>    

                                <td class="text-center">{{DB::table('estado_vendas')->where('pk_estadovenda',$artigosvenda->fk_estadovenda)->value('estado')}}</td>                  
                                <td class="text-center">  <img src= {{$artigosvenda->foto}}  class="img-circle img-sm" alt="User Image">    ({{$artigosvenda->sigla}}) {{$artigosvenda->name}}</td>
                                <td class="text-center">{{$artigosvenda->quantidade}}</td>
                                <td class="text-center">{{$artigosvenda->precoUnitario}}€</td>
                                <td class="text-center"></td> 
            
                                   
                                   
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                           
                        </div>
                     
                    </div>
                </div>
             
        </div>
    </div>  
    <script>
        //script para popup da imagem da empresa
        $('img.zoomable').css({cursor: 'pointer'}).live('click', function () {
              var img = $(this);
              var bigImg = $('<img />').css({
                    'max-width': '100%',
                    'max-height': '100%',
                    'display': 'inline'
              });
              bigImg.attr({
                    src: img.attr('src'),
                    alt: img.attr('alt'),
                    title: img.attr('title')
              });
  
              var over = $('<div />').text(' ').css({
                    'height': '100%',
                    'width': '100%',
                    'background': 'rgba(0,0,0,.82)',
                    'position': 'fixed',
                    'top': 0,
                    'left': 0,
                    'opacity': 0.0,
                    'cursor': 'pointer',
                    'z-index': 9999,
                    'text-align': 'center'
              }).append(bigImg).bind('click', function () {
              $(this).fadeOut(300, function () {
                    $(this).remove();
              });
              }).insertAfter(this).animate({
                    'opacity': 1
              },300);
              });
  </script>
                                <script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>

@stop
