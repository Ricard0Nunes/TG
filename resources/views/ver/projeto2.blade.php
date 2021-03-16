@extends('adminlte::page')

@section('Cliente', 'AdminLTE')
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
<script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<script src="{{URL('/')}}/js/locale.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<style>

  #tabs.active{
    border-top:3px solid #00a65a !important;
  } 
  .nested_task .gantt_add{display: none !important;}
  .fa-pencil-alt,.fa-plus,.fa-times {cursor: pointer;font-size: 14px;text-align: center;opacity: 0.2;padding: 5px;}
	.fa:hover {opacity: 1;}.fa-pencil-alt {color: #ffa011;}.fa-plus {color: #328EA0;}.fa-times {color: red;}
  .dhx_horas input {
  width: 96px;
  padding: 5px;
  margin: 3px 10px 10px 10px;
  /* font-size: 11px; */
  height: 30px;
  text-align: center;
  border: 1px solid #ccc;
  color: #646464;
  }
  @media screen and (max-width: 1024px) {
      #logo {
          display: none !important;
      }
  }
  .dhx_calendar_cont input {
		width: 200px;
		padding: 0;
		margin: 3px 10px 10px 10px;
		font-size: 11px;
		height: 32px;
		text-align: center;
		border: 1px solid #ccc;
		color: #646464;
	}
</style>
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
@section('content')
<div class="box" style="background-color:transparent; border:0px solid transparent; box-shadow: 0 0 0 0 rgba(0,0,0,0.2);"> 
  <div class="box-body">
    <div class="row" style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
      <div class="col-xs-9 col-md-2" id="logo">
        <div class="card ">
          <img class="img-responsive" src="{{asset($clienteLogo)}}" alt="empresa logo Avatar" width="300px">
        </div>
      </div>
      <div class="col-xs-12 col-md-3">
      <h1 class="" style="">{{$cliente}}</h1>
        <p class="title">Contacto: {{$clienteContacto}}  | Email: {{$clienteEmail}}</p>
      </div>
      <div class="col-xs-12 col-md-3">
        <canvas id="myChart" width="300" height="100"></canvas>
      </div>
      <div class="col-xs-12 col-md-4 pull-right" style="text-align:right">
      <h1 class="" style="">{{$projeto->nomeProjeto}}</h1>
        <p class="title">Área: {{$area}}  | Código: {{$projeto->codProj}}</p>
        <p class="title" style="padding-top:0px ">
          Início:{{$projeto->dataInicio}}
            | Fim: 
          @if ($projeto->dataFim == null)
                {{$projeto->dataPrevistaFim}}
          @else
            {{$projeto->dataFim}}
          @endif
        </p>
      </div> 
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2 col-sm-12"></div>
  @if ( $projeto->fk_responsavel==auth::id())
    <div class="col-md-4 col-sm-12">
      @if ($projeto->fk_estadoproj==2)
        <a href="{{url('/')}}/startprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-block "> <i class="far fa-play-circle"></i> INICIAR O PROJETO</a>
      @elseif($projeto->fk_estadoproj==1 || $projeto->fk_estadoproj==3  )
        <a href="{{url('/')}}/stopprojeto/{{$projeto->pk_projeto}}" class="btn btn-danger btn-block " title="Finalizar Projeto"> <i class="far fa-stop-circle"></i> FINALIZAR O PROJETO</a>
      @elseif($projeto->fk_estadoproj==4)
        <a href="{{url('/')}}/restartprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-block " title="Reabrir Projeto"><i class="fas fa-redo"></i> REABRIR O PROJETO</a>
      @endif
    </div>
    <div class="col-md-4 col-sm-12">
      <a href="{{url('/')}}/editarprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-block " title="Editar Projeto"><i class="far fa-edit"></i> EDITAR O PROJETO</a> {{--Editar recurso--}}
    </div>
  @endif
  <div class="col-md-2 col-sm-12"></div>
</div>
<br>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li id="tabs" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Gantt</a></li>
    <li id="tabs" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Dados de Projeto</a></li>
    <li id="tabs" class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Gráficos</a></li>
    <li id="tabs" class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Kanban</a></li>
    <li id="tabs" class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Equipa</a></li>
    <li id="tabs" class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Etapas</a></li>  
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <span><span class="hidden"id="filter_days" style="display: none;"><span></span><strong>Display:&nbsp;</strong><label><input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="full_week"><span>Semana Completa</span></label><label><input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="work_week"><span>Dias de Trabalho</span></label></span></span><strong>Escala:&nbsp;</strong><label><input name="scales" onclick="zoom_tasks(this)" type="radio" value="week"><span>Hora</span></label><label><input name="scales" onclick="zoom_tasks(this)" type="radio" value="trplweek" checked="true"><span>Dia</span></label><label><input name="scales" onclick="zoom_tasks(this)" type="radio" value="year"><span>Mês</span></label><input value="PDF" type="button" onclick='gantt.exportToPDF()'><span class="hidden" id="filter_hours" style="display: none;"><span></span><strong>Display:&nbsp;</strong><label><input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="full_day">{{--<span>Dia Completo</span>--}}</label><label><input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="work_hours"><span>Office hours</span></label></span><div id="gantt_here" style='width:100%; height:100%;'></div><!--/.post --><script src="{{URL('/')}}/js/locale.js" charset="utf-8"></script><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script><script src="https://export.dhtmlx.com/gantt/api.js"></script><script type="text/javascript">
gantt.config.date_format="%Y-%m-%d %H:%i:%s";gantt.config.time_step=5;gantt.config.duration_unit="hour";gantt.serverList("users",[]);function getUser(fk_tecnico){var users=gantt.serverList("users");for(var s=0;s<users.length;s++){if(users[s].key==fk_tecnico){return users[s].label}}
return""}
gantt.serverList("dep",[]);function getDep(fk_departamento){var dep=gantt.serverList("dep");for(var v=0;v<dep.length;v++){if(dep[v].key==fk_departamento){return dep[v].label}}
return""}
gantt.locale.labels.section_users="Responsável";gantt.locale.labels.section_dep="Departamentos";gantt.locale.labels.section_start_date="Data de Inicio";gantt.locale.labels.section_end_date="Data de Fim";gantt.locale.labels.section_nulo="";gantt.locale.labels.section_inicio="Data de Inicio";gantt.locale.labels.section_fim="Data de Fim";gantt.templates.scale_cell_class=function(date){if(date.getDay()==0||date.getDay()==6){return"weekend"}};gantt.templates.timeline_cell_class=function(item,date){if(date.getDay()==0||date.getDay()==6){return"weekend"}};var gantt_filter=0;function filter_tasks(node){gantt_filter=node.value;gantt.refreshData()}
function show_scale_options(mode){var hourConf=document.getElementById("filter_hours"),dayConf=document.getElementById("filter_days");if(mode=='day'){hourConf.style.display="none";dayConf.style.display="";dayConf.getElementsByTagName("input")[0].checked=!0}else if(mode=="hour"){hourConf.style.display="";dayConf.style.display="none";hourConf.getElementsByTagName("input")[0].checked=!0}else{hourConf.style.display="none";dayConf.style.display="none"}}
function set_scale_units(mode){if(mode&&mode.getAttribute){mode=mode.getAttribute("value")}
switch(mode){case "work_hours":gantt.config.subscales=[{unit:"hour",step:1,date:"%H"}];gantt.ignore_time=function(date){if(date.getHours()<6||date.getHours()>23){return!0}else{return!1}};break;case "full_day":gantt.config.subscales=[{unit:"hour",step:1,date:"%H"}];gantt.ignore_time=null;break;case "work_week":gantt.ignore_time=function(date){if(date.getDay()==0||date.getDay()==6){return!0}else{return!1}};break;default:gantt.ignore_time=null;break}
gantt.render()}
function zoom_tasks(node){switch(node.value){case "week":gantt.config.scale_unit="day";gantt.config.date_scale="%d %M";gantt.config.scale_height=60;gantt.config.min_column_width=30;gantt.config.subscales=[{unit:"hour",step:1,date:"%H"}];show_scale_options("hour");break;case "trplweek":gantt.config.min_column_width=70;gantt.config.scale_unit="day";gantt.config.date_scale="%d %M";gantt.config.subscales=[];gantt.config.scale_height=35;show_scale_options("day");break;case "month":gantt.config.min_column_width=70;gantt.config.scale_unit="week";gantt.config.date_scale="Week #%W";gantt.config.subscales=[{unit:"day",step:1,date:"%D"}];show_scale_options();gantt.config.scale_height=60;break;case "year":gantt.config.min_column_width=70;gantt.config.scale_unit="month";gantt.config.date_scale="%M";gantt.config.scale_height=60;show_scale_options();gantt.config.subscales=[{unit:"week",step:1,date:"#%W"}];break}
set_scale_units();gantt.render()}
show_scale_options("day");gantt.config.details_on_create=!0;gantt.templates.task_class=function(start,end,obj){return obj.project?"project":""}
gantt.config.grid_width=390;gantt.attachEvent("onTaskLoading",function(task){if(task.progress==1.00){task.$open=!1}
return!0});var colHeader='Gerir',colContent=function(task){if(task.fechado==0){if(task.$level>1){return('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton('+task.id+', \'edit\')"></i>'+'<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton('+task.id+', \'delete\')"></i>')}
return('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton('+task.id+', \'edit\')"></i>'+'<i class="fa gantt_button_grid gantt_grid_add fa-plus" onclick="clickGridButton('+task.id+', \'add\')"></i>'+'<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton('+task.id+', \'delete\')"></i>')}else{if(task.$level==0){gantt.config.readonly=!0;return('')}
return('')}};function clickGridButton(id,action){switch(action){case "edit":gantt.showLightbox(id);break;case "add":gantt.createTask(null,id);break;case "delete":gantt.confirm({title:gantt.locale.labels.confirm_deleting_title,text:gantt.locale.labels.confirm_deleting,callback:function(res){if(res)
gantt.deleteTask(id)}});break}}
gantt.templates.leftside_text=function(start,end,task){if(task.duration==1)
return task.duration+" Hora";else return task.duration+" Horas"};gantt.config.order_branch=!0;gantt.config.order_branch_free=!0;gantt.attachEvent("onAfterLightbox",function(){gantt.clearAll();gantt.init('gantt_here');gantt.load("/api/data")});gantt.form_blocks.date_local_editor={render:function(sns){return"<div class='dhx_calendar_cont'><input type='datetime-local' name='1'></div>"},set_value:function(node,value,task){if(!task.unscheduled){var date_local_value=gantt.date.date_to_str("%Y-%m-%d")(value)+"T"+gantt.date.date_to_str("%H:%i")(value)
node.childNodes[0].value=date_local_value}},get_value:function(node,task){task.start_date=new Date(node.childNodes[0].value)
return task.start_date},focus:function(node){var a=node.childNodes[0];a.select();a.focus()}};gantt.form_blocks.date_local_end={render:function(sns){return"<div class='dhx_calendar_cont'><input type='datetime-local' name='2'></div>"},set_value:function(node,value,task){if(!task.unscheduled){var date_local_value2=gantt.date.date_to_str("%Y-%m-%d")(value)+"T"+gantt.date.date_to_str("%H:%i")(value)
node.childNodes[0].value=date_local_value2}},get_value:function(node,task){task.end_date=new Date(node.childNodes[0].value)
return task.end_date},focus:function(node){var a2=node.childNodes[0];a2.select();a2.focus()}};gantt.attachEvent("onBeforeLightbox",function(id){if(gantt.getParent(id)!=0){gantt.resetLightbox();var parent=gantt.getTask(gantt.getParent(id))
if(parent.tipo==0){gantt.config.lightbox.sections=[{name:"users",height:25,map_to:"fk_tecnico",type:"select",options:gantt.serverList("users")},{name:"dep",height:25,map_to:"fk_departamento",type:"select",options:gantt.serverList("dep")},{name:"description",height:70,map_to:"text",type:"textarea",focus:!0},{name:"start_date",height:25,map_to:"start_date",type:"date_local_editor",single_date:"true"},{name:"end_date",height:25,map_to:"end_date",type:"date_local_end",single_date:"true"}]}else if(parent.tipo==1){gantt.config.lightbox.sections=[{name:"users",height:25,map_to:"fk_tecnico",type:"select",options:gantt.serverList("users")},{name:"description",height:70,map_to:"text",type:"textarea",focus:!0},{name:"start_date",height:25,map_to:"start_date",type:"date_local_editor",single_date:"true"},{name:"end_date",height:25,map_to:"end_date",type:"date_local_end",single_date:"true"}]};return!0}});gantt.config.columns=[{name:"text",tree:!0,width:'*',resize:!0},{name:"fk_tecnico",label:"Responsável",align:"center",template:function(obj){return getUser(obj.fk_tecnico)}},{name:"buttons",label:colHeader,width:75,template:colContent}];gantt.config.initial_scroll=!1;gantt.attachEvent("onLoadEnd",function(){gantt.showDate(new Date())});gantt.init("gantt_here");gantt.load("/api/data");gantt.ajax.get("/api/users").then(function(response){var users=JSON.parse(response.responseText);gantt.updateCollection("users",users);gantt.render()});gantt.ajax.get("/api/dep").then(function(response){var dep=JSON.parse(response.responseText);gantt.updateCollection("dep",dep);gantt.render()});var scrollX=gantt.posFromDate(new Date());gantt.scrollTo(scrollX,0);var dp=new gantt.dataProcessor("/api");gantt.attachEvent("onLightboxSave",function(id,item){if(!item.text){gantt.message({type:"error",text:"Introduza uma descrição"});return!1}
if(!item.fk_tecnico){gantt.message({type:"error",text:"Escolha um técnico válido"});return!1}
if(!item.start_date){gantt.message({type:"error",text:"Introduza uma Data de Inicio válida"});return!1}
if(!item.end_date){gantt.message({type:"error",text:"Introduza uma Data de Fim válida"});return!1}
return!0});dp.init(gantt);dp.setTransactionMode("REST")
        </script>
    </div>
    <div class="tab-pane" id="tab_2">
      <div class="row">
        <div  class="col-md-3 col-xs-12">
          <h4><strong>Código de Projeto</strong></h4>
          {{$projeto->codProj}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Empresa </strong></h4> {{$empresa}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4> <strong>Estado do Projeto </strong> </h4>
          @if ($projeto->fk_estadoproj ==1)
          <span class="label label-success">Aberto</span>
          @elseif($projeto->fk_estadoproj ==2)
          <span class="label label-warning">Pendente</span>
          @elseif($projeto->fk_estadoproj ==3)
          <span class="label label-primary">Reaberto</span>
          @else
          <span class="label label-danger">Concluido</span>
          @endif
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Urgência </strong> </h4> 
          @if ($projeto->fk_urgencia ==1)
          <span class="label label-danger">Emergente</span>
          @elseif($projeto->fk_urgencia ==2)
          <span class="label label-warning">Urgente</span>
          @elseif($projeto->fk_urgencia ==3)
          <span class="label label-success">Pouco Urgente</span>
          @else
          <span class="label label-primary">Não Urgente</span>
          @endif
        </div>
      </div><br>
      <div class="row">
        <div  class="col-md-3 col-xs-12"> 
          <h4> <strong>Código do Projeto </strong> </h4> {{$projeto->codProj}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Nome do Projeto </strong> </h4> {{$projeto->nomeProjeto}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Área do Projeto </strong> </h4>{{$area}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4> <strong>Responsável </strong> </h4> {{$user2}}
        </div>
      </div><br>
      <div class="row">
        <div  class="col-md-3 col-xs-12"> 
          <h4> <strong>Data de Início </strong> </h4> {{$projeto->dataInicio}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Data de Fim </strong> </h4> {{$projeto->dataFim}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Início Previsto </strong> </h4>{{$projeto->dataPrevistaInicio}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Fim Previsto </strong> </h4> {{$projeto->dataPrevistaFim}}
        </div>
      </div><br>
      <div class="row">
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Custo Real </strong> </h4> {{$projeto->custoReal}}
        </div>
        <div  class="col-md-3 col-xs-12"> 
          <h4><strong>Custo Previsto</strong> </h4> {{$projeto->custoPrevisto}}
        </div>
        <div  class="col-md-6 col-xs-12"> 
          <h4><strong>Observações </strong> </h4>{{$projeto->observacoes}}
        </div>
      </div><br>
      <div class="row">
        <div  class="col-md-12 col-xs-12"> 
          <h4><strong>Descrição do Projeto </strong> </h4> {{$projeto->descricaoProjeto}}
        </div>
      </div><br>
      <div class="row"> 
        <script>
          $(document).ready(function(){   $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );$('#camposextra').dataTable({"language":{"sEmptyTable":"Não foi encontrado nenhum registo","sLoadingRecords":"A carregar...","sProcessing":"A processar...","sLengthMenu":"Mostrar _MENU_ registos","sZeroRecords":"Não foram encontrados resultados","sInfo":"A mostrar de _START_ até _END_ de _TOTAL_ registos","sInfoEmpty":"A mostrar de 0 até 0 de 0 registos","sInfoFiltered":"(filtrado de _MAX_ registos no total)","sInfoPostFix":"","sSearch":"Procurar:","sUrl":"","oPaginate":{"sFirst":"Primeiro","sPrevious":"Anterior","sNext":"Seguinte","sLast":"Último"},"oAria":{"sSortAscending":": Ordenar colunas de forma ascendente","sSortDescending":": Ordenar colunas de forma descendente"}},"scrollX":!0,"autoWidth":!0})})
        </script>
        <div class="col-md-6 col-xs-12">
          <table id="camposextra" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">Descrição</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Gerir</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($campoExtraProjeto as $campoExtraProjeto)
                <tr id="tr">
                  <td class="text-justify">{{$campoExtraProjeto->descricao}}</td>
                  <td class="text-justify">{{$campoExtraProjeto->valor}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-6 col-xs-12">
          <h4><strong>Adicionar um Campo Extra </strong> </h4>
          {!! Form::open(array('route' => 'campoextra.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
            <div class="box-body">
              <div class="form-group">
                {!! Form::label('descricaocampoextra','Descrição (*)' ,['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-5">
                  {!! Form::text('descricaocampoextra',null,['class'=>'form-control','required'=>'required','placeholder'=>'Descrição do Campo Extra']) !!}
                  {!! $errors->first('descricaocampoextra','<p class="alert alert-danger">:message</p>')!!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('valorcampoextra','Valor (*)' ,['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-5">
                  {!! Form::text('valorcampoextra',null,['class'=>'form-control','required'=>'required','placeholder'=>'Valor do Campo Extra']) !!}
                  <input id="invisible_id" name="fk_projeto" type="hidden" value={{$projeto->pk_projeto}}>
                  {!! $errors->first('valorcampoextra','<p class="alert alert-danger">:message</p>')!!}
                </div>
              </div>
            </div>
            <div class="box-footer ">
              <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
          {!! Form::close()!!}
        </div>
      </div>  
    </div>
    <div class="tab-pane" id="tab_3">
      <div class="row">
        <div class="col-md-2 col-sm-12">
          <h1 style="">Custos</h1>
          <hr style="border: 1px solid grey !important;opacity: 0.5;width: 300px !important;">
          <canvas id="custos" width="300" height="400"></canvas>
        </div>
        <div class="col-md-2 col-sm-12">
        </div>
        <div class="col-md-2 col-sm-12">
          <h1 style="">Horas</h1>
          <hr style="border: 1px solid grey !important;opacity: 0.5;width: 300px !important;">
          <canvas id="horas" width="300" height="400"></canvas>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab_4">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4" >   
          <h4 style="text-align:center">Pendentes ({{count($tasksPendentes)}})</h4>  
          <hr style="  border: 5px solid  #009abf;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
          <div class="row"  style="	max-height:450px;overflow-y:auto;">
            <div class="col-xs-12 col-sm-12 col-md-12" >
              @foreach ($tasksPendentes as $taskPendente)
                <div class="hidden">
                  {{  $data1=Carbon\Carbon::parse($taskPendente->horaInicioPrev)  }}
                  {{ $data2=Carbon\Carbon::now()}}                    
                  {{  $data3=Carbon\Carbon::parse($taskPendente->start_date)  }}
                  {{$verificacaohora=$data2->greaterThan($data1)}}
                  {{$verificacaodata=$data2->greaterThan($data3)}}
                  {{ $dataPrevista=Carbon\Carbon::parse($taskPendente->start_date)->formatLocalized('%Y-%m-%d')}}
                  @if ($taskPendente->horaInicioPrev==null)
                    {{$dataPrevista= $dataPrevista. " --:--:--"}}
                  @else
                    {{$dataPrevista=  $taskPendente->horaInicioPrev}}
                  @endif 
                </div>
                <div class="box-body">
                  <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #009abf !important;">
                    <div class="row">
                      <div class="pull-left">
                        <span>{{$taskPendente->text}}</span>
                      </div>
                      <div class="pull-right">
                        <span style="color:red"> </span>
                        @if (($verificacaohora>0 or $verificacaodata>0) )
                          <span style="color:red"> {{$dataPrevista}}</span>
                        @else
                          {{$dataPrevista}} 
                        @endif
                      </div>
                    </div>  
                    <br>
                    <div class="row">                         
                      <div class="pull-left">
                        Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$taskPendente->fk_tecnico)->value('sigla')}}</span>
                      </div>
                      <div class="pull-right">
                        <span class="badge bg-red" style="background-color:#eb4e4e !important">  {{DB::table('tasks')->where('id',$taskPendente->parent)->value('text')}}</span>
                      </div>
                    </div> 
                  </div>  
                </div> 
              @endforeach
            </div>  
          </div>   
        </div>     
        <div class="col-xs-12 col-sm-12 col-md-4" >   
          <h4 style="text-align:center">Em Curso ({{count($tasksEmCurso)}})</h4>  
          <hr style="  border: 5px solid #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
          <div class="row" style="	max-height:450px;overflow-y:auto;">
            <div class="col-xs-12 col-sm-12 col-md-12" >
              @foreach ($tasksEmCurso as $tasksEmCurso)
                <div class="box-body">
                  <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;">
                    <div class="row">
                      <div class="pull-left">
                        <span>{{$tasksEmCurso->text}}</span>
                      </div>
                      <div class="pull-right">
                        <span style=""> {{$tasksEmCurso->horaInicio}}</span>
                      </div>   
                    </div>
                    <br>
                    <div class="row">                         
                      <div class="pull-left">
                        Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$tasksEmCurso->fk_tecnico)->value('sigla')}}</span>
                      </div>
                      <div class="pull-right">
                        <span class="badge bg-red" style="background-color:#eb4e4e !important">  {{DB::table('tasks')->where('id',$tasksEmCurso->parent)->value('text')}}</span>
                      </div>
                    </div> 
                  </div>  
                </div> 
              @endforeach  
            </div>   
          </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4" >   
          <h4 style="text-align:center"> Concluido ({{count($tasksConcluidas)}})</h4>  
          <hr style="  border: 5px solid #eb4e4e;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
          <div class="row" style="	max-height:450px;overflow-y:auto;">
            <div class="col-xs-12 col-sm-12 col-md-12" >
              @foreach ($tasksConcluidas as $tasksConcluidas)
                <div class="box-body">
                  <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #eb4e4e !important;">
                    <div class="row">
                      <div class="pull-left">
                        <span>{{$tasksConcluidas->text}}</span>
                      </div>
                      <div class="pull-right">
                        <span style="color:green"> {{$tasksConcluidas->end_date}}</span>
                      </div>  
                    </div>             
                    <br>            
                    <div class="row">                         
                      <div class="pull-left">
                        Técnico:<span class="badge bg-green">{{DB::table('users')->where('id',$tasksConcluidas->fk_tecnico)->value('sigla')}}</span>
                      </div>
                      <div class="pull-right">
                        <span class="badge bg-red" style="background-color:#eb4e4e !important">  {{DB::table('tasks')->where('id',$tasksConcluidas->parent)->value('text')}}</span>
                      </div>
                    </div> 
                  </div>  
                </div>  
              @endforeach               
            </div>
          </div>
        </div>     
      </div>   
    </div>
    <div class="tab-pane" id="tab_5">
      <div class="row">
        <div class="col-md-2 col-sm-12">
          <div class="card">
            <h3 style="text-align:center">Responsável</h3>
            <img class="img-responsive align-center" src="{{asset($user2Img)}}"alt="User Avatar" width="200px" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);margin-left: auto;margin-right: auto;">
            <br>
            <p style="text-align:center!important;font-size:16px;"><strong>{{$user2}}</strong></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-xs-12">
            @foreach ($projDep as $dep)
            <div class="box box-success collapsed-box">
              <div class="box-header with-border">
                <h3 class="box-title">{{$dep->descricao}}</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              <div class="box-body" style="display: none;">
                @for ($i = 0; $i < count($contadordepessoas); $i++)
                  <div class="hidden">
                    {{$tecnico= DB::table('users')->where('id',$contadordepessoas[$i])->get()}}
                  </div>
                  @if ($dep->fk_departamento==$tecnico[0]->fk_departamento)
                    <img src="{{asset( $tecnico[0]->foto)}}" class="img-circle" alt="User Image" width="50px" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"> - <strong>{{ $tecnico[0]->name}}</strong>({{ $tecnico[0]->sigla}})
                    <br>        
                  @endif
                @endfor
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="tab_6">
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
                <th class="text-center">Etapa</th>
                <th class="text-center">Responsável</th>
                <th class="text-center">Custo Real </th>
                <th class="text-center">Custo Previsto </th>
                <th class="text-center">Datas </th>
                <th class="text-center">% de Conclusão </th>
                <th class="text-center">Estado</th>
                <th class="text-center">Gerir</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($etapas as $tasks)
                <tr id="tr">
                  <td class="text-justify">{{$tasks->text}}</td>
                  <td class="text-center">{{DB::table('users')->where('id',$tasks->fk_tecnico)->value('sigla')}}</td>
                  <td class="text-center">{{$tasks->custoReal}} €</td>
                  <td class="text-center">{{$tasks->custoPrevisto}} €</td>
                  <td>
                    Inicio: {{$tasks->start_date}} <br>
                    Fim: {{$tasks->end_date}}
                  </td>
                  <td class="text-justify">
                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div> 
                  </td>
                  @if ($tasks->fechado == 0)
                    <td class="text-center">
                      <span class="label label-success">Aberta</span>
                    </td>
                  @else
                    <td class="text-center"> <span class="label label-danger">Fechada</span>    
                  @endif
                  <td>
                    <div class="text-center">
                      {!! Form::open(array('route' => 'tarefa.veretapa','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                      {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                      <a href="" >
                        <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                        <button type="submit" class="btn btn-success fas fa-eye" text="Ver Projeto"> 
                        </button>
                      </a> 
                      {!! Form::close()!!} 
                      @if ($tasks->fechado == 0)
                        {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" >
                          <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                          <button type="submit" class="btn btn-warning fas fa-pencil-alt" text="Ver Projeto"> 
                          </button>
                        </a> 
                      {!! Form::close()!!} 
                      @else
                      @endif 
                    </div>
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
  </div>
</div>
<script>

  //Gráfico de Custos
  Chart.defaults.global.legend.display=!1;var real=JSON.parse(<?php echo json_encode($taskCustoR);?>);var previsto=JSON.parse(<?php echo json_encode($taskCustoP);?>);var custo=(real>previsto)?['#eb4e4e','#009abf']:['#40a431','#009abf'];var outline=(real>previsto)?['#b71414','#016982']:['#307a25','#016982'];var ctx2=document.getElementById("custos");var myChart=new Chart(ctx2,{type:'bar',data:{labels:["Custo Real (€)",'Custo Previsto (€)'],datasets:[{data:[real,previsto],backgroundColor:custo,borderColor:outline,borderWidth:1}]},options:{responsive:!1,scales:{xAxes:[{ticks:{maxRotation:90,minRotation:80}}],yAxes:[{ticks:{beginAtZero:!0}}]}}});
  
  //Gráfico de Horas
  Chart.defaults.global.legend.display=!1;var real=JSON.parse(<?php echo json_encode($taskHorasR);?>);var previsto=JSON.parse(<?php echo json_encode($taskHorasP);?>);var custo=(real>previsto)?['#eb4e4e','#009abf']:['#40a431','#009abf'];var outline=(real>previsto)?['#b71414','#016982']:['#307a25','#016982'];var ctx3=document.getElementById("horas");var myChart=new Chart(ctx3,{type:'bar',data:{labels:["Horas Reais",'Horas Previstas'],datasets:[{data:[real,previsto],backgroundColor:custo,borderColor:outline,borderWidth:1}]},options:{responsive:!1,scales:{xAxes:[{ticks:{maxRotation:90,minRotation:80}}],yAxes:[{ticks:{beginAtZero:!0}}]}}});

  //Gráfico de Percentagem de conclusão
  window.onload=function(){var progress=JSON.parse(<?php echo json_encode($task);?>);var data={labels:['Completo(%)','Por Acabar(%)'],datasets:[{data:[progress*100,100-progress*100],backgroundColor:["#40a431","#b7d5b3"],hoverBackgroundColor:["#62c453","#c9d5c8"]}]};var ctx=document.getElementById("myChart");var myDoughnutChart=new Chart(ctx,{type:'doughnut',data:data,options:{rotation:1*Math.PI,circumference:1*Math.PI,legend:{display:!1}}})}
</script>
<div class="row" align="center">
  <div class="col-xs-12 col-sm-12 col-md-5" >

      </div>
              <div class="col-xs-12 col-sm-12 col-md-2" >
                
                  <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                          Voltar</button></a>
              
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5" >

      </div>
</div><br><br>
@stop