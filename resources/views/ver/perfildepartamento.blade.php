@extends('adminlte::page')

@section('Kanban', 'Kanban De Departamento')

@section('content')
<style>     #tabs.active{
    border-top:3px solid  #40a431 !important;
}</style>
<div class="box box-success">
    <div class="box-header with-border">
    <h3 class="box-title">Departamento -{{$departamento->descricao}}({{$departamento->abreviatura}}) -</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    </div>
    <!-- /.box-body -->
  </div>
  <div class="nav-tabs-custom" >
    <ul class="nav nav-tabs">
      <li id="tabs"class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Contactos</a></li>
      <li id="tabs" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Kanban</a></li>
      <li id="tabs" class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Projetos</a></li>
      <li id="tabs" class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Relatório</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th class="text-center">Colaborador</th>
                            <th class="text-center">Contacto Profissional</th>
                           
                            <th class="text-center">Contacto Pessoal</th>

                            <th class="text-center">Skype</th>
                            <th class="text-center">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                 
                        <tr id="tr" >
                 
                        {{-- dados da tabela --}}
                        <td class="text-justify">  {{$user->sigla}}<img src="{{$user->foto}}" class="img-circle img-sm" alt="User Image"> </td>
                        <td class="text-justify">{{$user->contactoProfissional}}</td>
                        <td class="text-justify">{{$user->contactoPessoal}}</td>
                        <td class="text-justify">@if ($user->skype==null)
                            <i class="fab fa-skype" > Sem skype
                        @else
                        <a href='skype:{{$user->skype}}?chat&topic=Teste'><i class="fab fa-skype" >{{$user->skype}}</a></td>
                        @endif</td>
                        <td class="text-justify">{{$user->email}}</td>
                       
                    </tr>
                @endforeach
                </tbody>
                </table>
                {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
             
        </div>
    </div>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center">Pendentes ({{count($tasksPendentes[0])}})</h4>  
              <hr style="  border: 5px solid  #009abf;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row"  style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                  @if(count($tasksPendentes[0])<0)
                  @else
                      @for ($i = 0; $i < count($tasksPendentes[0]); $i++)
                          
                   
         
                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #009abf !important;">
                        <div class="row">
                          <div class="pull-left">
                          <span>{{$tasksPendentes[0][$i]->text}}</span> 
                          </div>
                          <div class="pull-right">
                            <span style="color:red"> </span>
                        
                          </div>
                        </div>  
                        <br>
                        <div class="row">                         
                          <div class="pull-left">
                          Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$tasksPendentes[0][$i]->fk_tecnico)->value('name')}}</span>
                          </div>
                          <div class="pull-right">
                          <span class="badge bg-red" style="background-color:#eb4e4e !important">{{$tasksPendentes[0][$i]->custoPrevisto}}€</span>
                          </div>
                        </div> 
                      </div>  
                    </div> 
                    @endfor
                 @endif
                </div>  
              </div>   
            </div>     
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center">Em Curso ({{count($tasksEmCurso[0])}})</h4>  
              <hr style="  border: 5px solid #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row" style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                  @if(count($tasksEmCurso[0])<0)
                  @else
                  @for ($i = 0; $i < count($tasksEmCurso[0]); $i++)
                    

                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;">
                        <div class="row">
                          <div class="pull-left">
                            <span>{{$tasksEmCurso[0][$i]->text}}</span>
                          </div>
                          <div class="pull-right">
                            <span style=""></span>
                          </div>   
                        </div>
                        <br>
                        <div class="row">                         
                          <div class="pull-left">
                            Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$tasksEmCurso[0][$i]->fk_tecnico)->value('name')}}</span>
                          </div>
                          <div class="pull-right">
                            <span class="badge bg-red" style="background-color:#eb4e4e !important">{{$tasksEmCurso[0][$i]->custoPrevisto}}€</span>
                          </div>
                        </div> 
                      </div>  
                    </div> 
                    @endfor
                    @endif
                                  </div>   
              </div> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center"> Concluido ({{count($tasksConcluidas[0])}})</h4>  
              <hr style="  border: 5px solid #eb4e4e;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row" style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                  @if(count($tasksConcluidas[0])<0)
                  @else
                  @for ($i = 0; $i < count($tasksConcluidas[0]); $i++)
                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #eb4e4e !important;">
                        <div class="row">
                          <div class="pull-left">
                            <span>{{$tasksConcluidas[0][$i]->text}}</span>
                          </div>
                          <div class="pull-right">
                            <span style="color:green"></span>
                          </div>  
                        </div>             
                        <br>            
                        <div class="row">                         
                          <div class="pull-left">
                            Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$tasksConcluidas[0][$i]->fk_tecnico)->value('name')}}</span>
                          </div>
                          <div class="pull-right">
                            <span class="badge bg-red" style="background-color:#eb4e4e !important">{{$tasksConcluidas[0][$i]->custoPrevisto}}€</span>
                          </div>
                        </div> 
                      </div>  
                    </div> 
                    @endfor
                    @endif 
                </div>
              </div>
            </div>     
          </div>   
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
        <div class="row">
          <div class="col-md-12">
            <script>
              let draw=!1;$(document).ready(function(){const table=$('#aa').DataTable({"language":{"sEmptyTable":"Não foi encontrado nenhum registo","sLoadingRecords":"A carregar...","sProcessing":"A processar...","sLengthMenu":"Mostrar _MENU_ registos","sZeroRecords":"Não foram encontrados resultados","sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos","sInfoEmpty":"A mostrar de 0 até 0 de 0 registos","sInfoFiltered":"(filtrado de _MAX_ registos no total)","sInfoPostFix":"","sSearch":"Procurar:","sUrl":"","oPaginate":{"sFirst":"Primeiro","sPrevious":"Anterior","sNext":"Seguinte","sLast":"Último"},"oAria":{"sSortAscending":": Ordenar colunas de forma ascendente","sSortDescending":": Ordenar colunas de forma descendente"}}});$.fn.dataTable.ext.errMode='none';const tableData=getTableData(table);createHighcharts(tableData);setTableEvents(table)});function getTableData(table){const dataArray=[],countryArray=[],populationArray=[],densityArray=[];table.rows({search:"applied"}).every(function(){const data=this.data();countryArray.push(data[0]);populationArray.push(parseInt(data[3].replace(/\,/g,"")));densityArray.push(parseInt(data[2].replace(/\,/g,"")))});dataArray.push(countryArray,populationArray,densityArray);return dataArray}
              function createHighcharts(data){Highcharts.setOptions({lang:{thousandsSep:","}});Highcharts.chart("chart",{title:{text:"Gráfico representativo das Sprints"},subtitle:{text:""},xAxis:[{categories:data[0],labels:{rotation:0}}],yAxis:[{title:{text:"Custo Previsto"}},{title:{text:"Custo Real"},min:0,opposite:!0}],series:[{name:"Custo Previsto",color:"#0071A7",type:"column",data:data[1],tooltip:{valueSuffix:" €"}},{name:"Custo Real",color:"#FF404E",type:"spline",data:data[2],tooltip:{valueSuffix:" €"},yAxis:1}],tooltip:{shared:!0},legend:{backgroundColor:"#ececec",shadow:!0},credits:{enabled:!1},noData:{style:{fontSize:"16px"}}})}
              function setTableEvents(table){table.on("page",()=>{draw=!0});table.on("draw",()=>{if(draw){draw=!1}else{const tableData=getTableData(table);createHighcharts(tableData)}})}
            </script>
            <div id="chart"></div>
            <table id="aa" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Projeto</th>
                  <th class="text-center">Responsável</th>
                  <th class="text-center">Custo Real </th>
                  <th class="text-center">Custo Previsto </th>
                  <th class="text-center">Datas </th>

                </tr>
              </thead>
              <tbody>
                @foreach ($projeto as $tasks)
                  <tr id="tr">
                  <td class="text-justify">{{$tasks->nomeProjeto}} - {{$tasks->descricaoProjeto}}</td>
                    <td class="text-center">{{DB::table('users')->where('id',$tasks->fk_responsavel)->value('sigla')}}</td>
                    <td class="text-center">{{$tasks->custoReal}} €</td>
                    <td class="text-center">{{$tasks->custoPrevisto}} €</td>
                    <td>
                      Inicio: {{$tasks->dataInicio}} <br>
                      Fim: {{$tasks->dataFim}}
                    </td>
                  
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
            <br>
            <br>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab_4">
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
              <!-- timeline time label -->
              <li class="time-label">
                    <span class="bg-red">
                      Relatório Diário
                    </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              @if(count($tasksdia[0])<0)
              @else
              @for ($i = 0; $i < count($tasksdia[0]); $i++)
                  

              <li>
                <i class="fa "><img src={{asset(DB::table('users')->where('id',$tasksdia[0][$i]->fk_tecnico)->value('foto'))}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
  
                <div class="timeline-item">
                  <span class="time">({{$tasksdia[0][$i]->duracaoHorasEstimado}})</span>
  
                  <h3 class="timeline-header"><a href="#"> {{' '}} {{carbon\carbon::parse($tasksdia[0][$i]->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasksdia[0][$i]->end_date)->format('H:i')}} </a>{{$tasksdia[0][$i]->nomeProjeto}}</h3>
  
                  <div class="timeline-body">

                    <h3 class="timeline-header"><a> {{$tasksdia[0][$i]->text}} </a></h3>
                    {{(DB::table('users')->where('id',$tasksdia[0][$i]->fk_tecnico)->value('name'))}}
                  </div>
                  <div class="timeline-footer">
                    {{-- <a class="btn btn-primary btn-xs">Read more</a>
                    <a class="btn btn-danger btn-xs">Delete</a> --}}
                  </div>
                </div>
              </li>
              @endfor
              @endif
            </ul>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
@stop