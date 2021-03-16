@extends('adminlte::page')
@section('Dashboard', 'AdminLTE')
@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
</script>
<style>    
#tabs.active{
    border-top:3px solid #00a65a !important;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  max-width: 1200px;
  margin: auto;
  padding: 0 0 0 0;
  text-align: center;
  background-color: white;
  font-family: Arial, Helvetica, sans-serif;
  display: flex;
  /* flex:1 1 auto; */
}
.title{
  color:grey;
  font-size:18px;
  /* padding-bottom: 10px; */

}

</style>
<h2>Resumo do dia</h2>

  {!! Form::open(array('route' => 'dashboard.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block;')) !!}
  <a href="" > <input id="invisible_id"  name="id" type="hidden" value="">
    <button type="submit" class="btn btn-success fas fa-search pull-right" title="Pesquisar">
   </button></a> 
   <div class="pull-right">
      <span style=" display: inline;">
  


  {!! Form::date('dia',$dia,['class'=>'form-control']) !!}
    {{-- <a href="" > <input id="invisible_id" name="id" type="hidden" value="">
      <button type="submit" class="btn btn-success fas fa-search">
     </button></a>  --}}
      {!! Form::close()!!}
      </span>
    </div>


<!-- Add the bg color to the header using any of the bg-* classes -->

{{-- <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://code.highcharts.com/7.0.3/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>



<div class="row">
    
    <div class="col-md-6 col-xs-12">
        <div class="box box-widget "style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
            <div class="box-body" >
                <div class="row">
                    <script>
          let draw1=!1;$(document).ready(function(){const table1=$('#aa').DataTable({"pageLength":5,"language":{"sEmptyTable":"Não foi encontrado nenhum registo","sLoadingRecords":"A carregar...","sProcessing":"A processar...","sLengthMenu":"Mostrar _MENU_ registos","sZeroRecords":"Não foram encontrados resultados","sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos","sInfoEmpty":"A mostrar de 0 até 0 de 0 registos","sInfoFiltered":"(filtrado de _MAX_ registos no total)","sInfoPostFix":"","sSearch":"Procurar:","sUrl":"","oPaginate":{"sFirst":"Primeiro","sPrevious":"Anterior","sNext":"Seguinte","sLast":"Último"},"oAria":{"sSortAscending":": Ordenar colunas de forma ascendente","sSortDescending":": Ordenar colunas de forma descendente"}}});$.fn.dataTable.ext.errMode='none';const tableData1=getTableData1(table1);createHighcharts1(tableData1);setTableEvents1(table1)});function getTableData1(table1){const dataArray1=[],countryArray1=[],populationArray1=[],densityArray1=[];table1.rows({search:"applied"}).every(function(){const data1=this.data();countryArray1.push(data1[0]);populationArray1.push(parseInt(data1[3].replace(/\, /g,"")));densityArray1.push(parseInt(data1[2].replace(/\, /g,"")))});dataArray1.push(countryArray1,populationArray1,densityArray1);return dataArray1}
function createHighcharts1(data1){Highcharts.setOptions({lang:{thousandsSep:","}});Highcharts.chart("chart1",{title:{text:"Gráfico representativo das Tarefas"},subtitle:{text:""},xAxis:[{categories:data1[0],labels:{rotation:0}}],yAxis:[{title:{text:"Custo Previsto"}},{title:{text:"Custo Real"},min:0,opposite:!0}],series:[{name:"Custo Previsto",color:"#0071A7",type:"column",data:data1[1],tooltip:{valueSuffix:" €"}},{name:"Custo Real",color:"#FF404E",type:"spline",data:data1[2],tooltip:{valueSuffix:" €"},yAxis:1}],tooltip:{shared:!0},legend:{backgroundColor:"#ececec",shadow:!0},credits:{enabled:!1},noData:{style:{fontSize:"16px"}}})}
function setTableEvents1(table1){table1.on("page",()=>{draw1=!0});table1.on("draw",()=>{if(draw1){draw1=!1}else{const tableData1=getTableData1(table1);createHighcharts1(tableData1)}})}
                    </script>
                    <div id="chart1"></div>
                    <table id="aa" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th class="text-center">Tarefa</th>
                            <th class="text-center">Responsável</th>
                            <th class="text-center">Custo Real </th>
                            <th class="text-center">Custo Previsto </th>
                       
                           
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($tasksdia as $tasks)
                            <tr id="tr">
                              <td class="text-justify">{{$tasks->text}}</td>
                              <td class="text-center">{{DB::table('users')->where('id',$tasks->fk_tecnico)->value('sigla')}}</td>
                              <td class="text-center">{{$tasks->custoReal}} €</td>
                              <td class="text-center">{{$tasks->custoPrevisto}} €</td>
                     
                   
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="box box-widget "style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
            <div class="box-body" >
                <div class="row">
                    <script>
                        let draw3=!1;$(document).ready(function(){const table3=$('#cc').DataTable({"pageLength":5,"language":{"sEmptyTable":"Não foi encontrado nenhum registo","sLoadingRecords":"A carregar...","sProcessing":"A processar...","sLengthMenu":"Mostrar _MENU_ registos","sZeroRecords":"Não foram encontrados resultados","sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos","sInfoEmpty":"A mostrar de 0 até 0 de 0 registos","sInfoFiltered":"(filtrado de _MAX_ registos no total)","sInfoPostFix":"","sSearch":"Procurar:","sUrl":"","oPaginate":{"sFirst":"Primeiro","sPrevious":"Anterior","sNext":"Seguinte","sLast":"Último"},"oAria":{"sSortAscending":": Ordenar colunas de forma ascendente","sSortDescending":": Ordenar colunas de forma descendente"}}});$.fn.dataTable.ext.errMode='none';const tableData3=getTableData3(table3);createHighcharts3(tableData3);setTableEvents3(table3)});function getTableData3(table3){const dataArray3=[],countryArray3=[],populationArray3=[],densityArray3=[];table3.rows({search:"applied"}).every(function(){const data3=this.data();countryArray3.push(data3[0]);populationArray3.push(parseInt(data3[3].replace(/\, /g,"")));densityArray3.push(parseInt(data3[2].replace(/\, /g,"")))});dataArray3.push(countryArray3,populationArray3,densityArray3);return dataArray3}
function createHighcharts3(data3){Highcharts.setOptions({lang:{thousandsSep:","}});Highcharts.chart("chart3",{title:{text:"Gráfico representativo dos Projetos"},subtitle:{text:""},xAxis:[{categories:data3[0],labels:{rotation:0}}],yAxis:[{title:{text:"Custo Previsto"}},{title:{text:"Custo Real"},min:0,opposite:!0}],series:[{name:"Custo Previsto",color:"#0071A7",type:"column",data:data3[1],tooltip:{valueSuffix:" €"}},{name:"Custo Real",color:"#FF404E",type:"spline",data:data3[2],tooltip:{valueSuffix:" €"},yAxis:1}],tooltip:{shared:!0},legend:{backgroundColor:"#ececec",shadow:!0},credits:{enabled:!1},noData:{style:{fontSize:"16px"}}})}
function setTableEvents3(table3){table3.on("page",()=>{draw3=!0});table3.on("draw",()=>{if(draw3){draw3=!1}else{const tableData3=getTableData3(table3);createHighcharts3(tableData3)}})}
      </script>
                    <div id="chart3"></div>
                    <table id="cc" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th class="text-center">Projeto</th>
                            <th class="text-center">Responsável</th>
                            <th class="text-center">Custo Real </th>
                            <th class="text-center">Custo Previsto </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($projetos as $proj)
                            <tr id="tr">
                              <td class="text-justify">{{$proj->nomeProjeto}}</td>
                              <td class="text-center">{{$proj->sigla}}</td>
                              <td class="text-center">{{$proj->custoReal}} €</td>
                              <td class="text-center">{{$proj->custoPrevisto}} €</td>
                             
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="box box-widget "style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
            <div class="box-header with-border">
                <h3 class="box-title">Projetos a Terminar</h3>
              </div>        
            <div class="box-body">
                <ul class="products-list product-list-in-box">     
                @foreach ($projetosaterminar as $projetosaterminar)

         
                  <li class="item">
                    <div class="product-img">
                        {{$projetosaterminar->sigla}}<img src="{{$projetosaterminar->foto}}" class="img-circle img-sm" alt="User Image"> 
                    </div>
                    <div class="product-info">
                      <a class="product-title">{{$projetosaterminar->nomeProjeto}}
                        <span class="label label-success pull-right">{{$projetosaterminar->custoReal}}€</span></a>
                      <span class="product-description">
                          {{$projetosaterminar->descricaoProjeto}}
                      </span>
                    </div>
                  </li>          
                @endforeach                        
                </ul>
                
              </div>
              <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Ver Todos</a>
              </div>
        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <div class="box box-widget "style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
            <div class="box-header with-border">
                <h3 class="box-title">Etapas a Terminar</h3>
              </div>    
            <div class="box-body" >
                <ul class="products-list product-list-in-box">     
                    @foreach ($etapasaterminar as $etapasaterminar)                  
                    <li class="item">
                      <div class="product-img">
                      {{$etapasaterminar->sigla}}<img src="{{$etapasaterminar->foto}}" class="img-circle img-sm" alt="User Image">  
                      </div>
                      <div class="product-info">
                        <a class="product-title">{{$etapasaterminar->text}}
                          <span class="label label-success pull-right">{{$etapasaterminar->custoReal}}€</span></a>
                        <span class="product-description">
                            {{$etapasaterminar->observação}}
                        </span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                 
            </div>
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Ver Todos</a>
              </div>
        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <div class="box box-widget "style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
            <div class="box-header with-border">
                <h3 class="box-title">Últimos Clientes </h3>
              </div>    
            <div class="box-body" >
                <ul class="products-list product-list-in-box">
                    @foreach ($clientesultimos as $clientesultimos)
                    <li class="item">
                      <div class="product-img">
                      <img src="{{$clientesultimos->logo}}" class="img-circle img-sm" alt="User Image">  
                      </div>
                      <div class="product-info">
                        <a class="product-title">{{$clientesultimos->nomeAbreviado}}
                          <span class="label label-primary pull-right">{{$clientesultimos->NIF}}</span></a>
                        <span class="product-description">
                            {{$clientesultimos->morada}}
                            </span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                
            </div>
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Ver Todos</a>
              </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>

                  <th class="text-center">Sigla</th>
                  <th class="text-center">Nome</th>
                  <th class="text-center">Empresa</th>
                  <th class="text-center">Departamento</th>
             
                  <th class="text-center">Ponto</th>
                  <th class="text-center">Nº tarefas</th>
                
                
               
                  <th class="text-center">Ver Relatório</th>
             
              </tr>
          </thead>
          <tbody>
          @foreach ($users as $users)
    
              <tr id="tr" >
  
              <td class="text-justify">{{$users->sigla}} <img src={{asset($users->foto)}} class="img-circle img-sm" alt="User Image"> </td>
              <td class="text-justify">{{$users->name}}</td>
              <td class="text-justify">{{DB::connection('geraltg')->table('empresascomuns')->where('NIF',$users->nifEmpregador)->value('nomeAbreviado')}}</td>
             <td class="text-justify">{{DB::table('departamentos')->where('pk_departamento',$users->fk_departamento)->value('abreviatura')}}</td>
           
             
              <td class="text-center">
                  @for ($i = 0; $i < count($ponto); $i++)

                      @if ($users->bi==$ponto[$i]->ccuser)
                                            
                                @if ($ponto[$i]->entradaManha!=null)
                                    <strong class="pull-left"> EM: {{$ponto[$i]->entradaManha}} </strong>
                                @else
                                    <strong class="pull-left"> EM:--:--:-- </strong>
                                @endif
                                @if ($ponto[$i]->saidaManha!=null)
                                    <strong class="pull-right"> SM: {{$ponto[$i]->saidaManha}} </strong>
                                @else
                                    <strong class="pull-right"> SM: --:--:-- </strong>
                                @endif 

                                <br>
                                @if ($ponto[$i]->entradaTarde!=null)
                                <strong class="pull-left"> ET: {{$ponto[$i]->entradaTarde}}</strong>
                                @else
                                <strong class="pull-left"> ET: --:--:-- </strong>
                                @endif 
                                
                                @if ($ponto[$i]->saidaTarde!=null)
                                <strong class="pull-right"> ST: {{$ponto[$i]->saidaTarde}} </strong>
                                @else
                                <strong class="pull-right"> ST: --:--:-- </strong>
                                @endif
                                <br>

                                @if ($ponto[$i]->tempoAlmoco!=null)
                                <strong class="pull-left"><i class="fas fa-utensils"></i>  {{'    '.$ponto[$i]->tempoAlmoco.' '}}</strong>
                                @else
                                <strong class="pull-left"><i class="fas fa-utensils"></i> --:--:--</strong>
  
                                @endif 
                                @if ($ponto[$i]->totalDia!=null)
                                <strong class="pull-right"> <i class="far fa-clock "></i> {{' '.$ponto[$i]->totalDia.' '}} </strong>
                                @else
                                <strong  class="pull-right"><i class="far fa-clock "></i> --:--:-- <strong>
                                @endif


    

                      @endif

                  @endfor

              </td>
              <td>              {{count(DB::table('tasks')->where('tipo',2)->where('start_date','like',$dia.'%' )->where('fk_estadoIntervencao',3)->where('fk_tecnico',$users->id)->get())}}
                /{{count(DB::table('tasks')->where('tipo',2)->where('start_date','like',$dia.'%' )->where('fk_tecnico',$users->id)->get())}}
              </td>
           
      
             
             
              <td>  {{--opçoes de gestão de clientes--}}
                     
                {!! Form::open(array('route' => 'relatorio.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                <input id="invisible_id"  name="fk_tecnico" type="hidden" value="{{$users->id}}">
                <input id="invisible_id"  name="dia" type="hidden" value="{{$dia}}">
                        <button type="submit" class="btn btn-success btn-sm far fa-eye pull-right" title="Ver Relatório">
                       </button>
                       <div class="pull-right">
                          <span style=" display: inline;">
                      
         
                      
                          {!! Form::close()!!}
                  </div>
              </td>
          </tr>
      @endforeach
      </tbody>
      </table>
      {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
      <div class="row" align="center">
              <div class="col-xs-12 col-sm-12 col-md-4" >
      
                  </div>
                 

                          <div class="col-xs-12 col-sm-12 col-md-2" >
                                  <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                          Voltar</button></a>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-4" >
      
                  </div>
      </div><br><br>
  </div>
</div>
@stop