@extends('adminlte::page')

@section('title', 'Tarefa')
@section('content')
<style>
.box{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;
}
.row-relative{
    position:relative;
}
.col-border-padding{
    padding-left:15px;
}
.col-border{
    padding-left:0;
    position:static;
}
.col-border:before{
   content:"";
    position:absolute;
    top: 0;
    bottom: 0;
    border-left:2px solid lightgray;
}
.vcenter {
    /* display: inline; */
    vertical-align: middle;
    float: none;
}
</style>
<div class="hidden">
{{$dep = DB::table('departamentos')->where('pk_departamento',$tecnico->fk_departamento)->value('descricao')}}
{{$cargo = DB::table('cargos')->where('pk_cargo',$tecnico->fk_cargo)->value('descricao')}}
{{$area = DB::table('areas')->where('pk_area',$projeto->fk_areaProj)->value('projArea')}}
{{$urgencia = DB::table('urgencias')->where('pk_urgencia',$projeto->fk_urgencia)->value('descricaoUrgencia')}}
{{$estado = DB::table('estadointervencoes')->where('pk_estadoIntervencoes',$task->fk_estadoIntervencao)->value('descricao')}}

</div>
<div class="row">        
   <div class="col-xs-12 col-sm-12 col-md-12" >
        <div class="box box-solid ">
            <div class="box-body">
                <div class="row row-relative">        
                    <div class="col-xs-12 col-sm-12 col-md-3 " >
                        <div class="col-border-padding ">
                            <div class="row">        
                                <div class="col-xs-12 col-sm-12 col-md-3 " >
                                <a href="verprojeto/{{$projeto->pk_projeto}}"><i class="fas fa-file fa-4x" style="color:#40a431 !important; padding-top:0px;"></i> </a> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 vcenter" >
                                <strong ><h4>{{$projeto->codProj}}_{{$projeto->nomeProjeto}}</h4></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-border" > 
                        <div class="col-border-padding vcenter">
                            <div class="row">        
                                <div class="col-xs-12 col-sm-12 col-md-3 " >
                                    <i class="fas fa-running fa-4x" style="color:#40a431 !important; padding-top:0px;"></i> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 vcenter" >
                                    <strong ><h4>{{$sprint->text}}</h4></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-border" >
                        <div class="col-border-padding vcenter">
                            <div class="row">        
                                <div class="col-xs-12 col-sm-12 col-md-3 " >
                                    <i class="fas fa-tasks fa-4x" style="color:#40a431 !important; padding-top:0px;"></i> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 vcenter" >
                                    <strong ><h4>{{$task->text}}</h4></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-border" >  
                        <div class="col-border-padding vcenter">
                            <div class="row">        
                                <div class="col-xs-12 col-sm-12 col-md-2 " >
                                    <i class="fas fa-hourglass-half fa-4x" style="color:#40a431 !important; padding-top:0px;"></i> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-10 vcenter" >
                                 <h4>   <strong >Inicio:</strong> {{$task->start_date}} <br>
                                    <strong >Fim:</strong> {{$task->end_date}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
   </div>
</div>
<div class="row">        
    <div class="col-xs-12 col-sm-12 col-md-2" >
        <div class="box box-solid "style="max-height:fit-content;!important" >
            <div class="box-body">
                <div class="row">        
                    <div class="col-xs-12 col-sm-12 col-md-3" >
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6" >
                        <div class="widget-user-image ">
                            <img class="img-responsive" style="border:1px solid black; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;" src="{{$tecnico->foto}}"alt="User Avatar">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3" >
                    </div>
                </div>
                <div class="row">        
                    <div class="col-xs-12 col-sm-12 col-md-3" >
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6"style="text-align:center" ><br>
                     <strong>{{$tecnico->name}}</strong> <br>
                    <small>{{$cargo}} - {{$dep}}</small>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3" >
                    </div>
                </div>
                <hr>
                <div style="text-align:center">
                   <h4> <strong> Área </strong> </h4> {{$area}} <br>
                   <h4> <strong> Urgência </strong> </h4>  {{$urgencia}} <br>
                   <h4> <strong> Estado da Tarefa </strong> </h4>  {{$estado}} <br><br><br> <hr class="" style="padding-bottom:11px; border: 1px solid white;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5" >
            <div class="box box-solid ">
                <div class="box-body">
                    <h4>Informação referente ao Projeto:</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div id="graph">
                                {!! \Lava::render('BarChart', 'Grafico Teste', 'graph')!!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div id="2">
                                {!! \Lava::render('ScatterChart', 'horas', '2')!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5" >
            <div class="box box-solid ">
                <div class="box-body">
                   <h4>Informação referente á Tarefa:</h4>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div id="task1">
                                {!! \Lava::render('ColumnChart', 'task1', 'task1')!!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div id="task2">
                                {!! \Lava::render('BarChart', 'task2', 'task2')!!}
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12" >
        <div class="box box-success collapsed-box">
            <div class="box-header with-border">
        <h3 class="box-title">   Relatório:  </h3>
           
             <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>

      <div class="box-body">
                                   
                                         
                                 
                                      </h3>   
                           
                                      <div class="box-body text-justify">
                                            {!!$task->relatorio!!}
                                      </div>
                                  
                                  </div>
                 
                                </div> </div> </div>
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
{{-- <div class="row">        
   <div class="col-xs-12 col-sm-12 col-md-12" >
        <div class="box box-solid ">
            <div class="box-body">
               <h4>Relatório da Tarefa:</h4>
               @if($task->relatorio == null)
                FORM 
               @else
               {{$task->relatorio}}
               @endif
           </div>
        </div>
   </div>
</div>
    <div>
        task 
{{$task}}
</div> 
<br>
<div>
   projeto 
{{$projeto}}
</div>
<br>
<div> 
   sprint 
{{$sprint}}
</div> --}}
@stop 