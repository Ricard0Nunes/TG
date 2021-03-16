@extends('adminlte::page')

@section('Cliente', 'AdminLTE')

<script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<script src="{{URL('/')}}/js/locale.js" charset="utf-8"></script>

<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
@section('content')
<div class="box   box-success">
  <style>
    .nested_task .gantt_add{
    display: none !important;
}
.fa-pencil-alt,.fa-plus,.fa-times {
			cursor: pointer;
			font-size: 14px;
			text-align: center;
			opacity: 0.2;
			padding: 5px;
		}

		.fa:hover {
			opacity: 1;
		}

		.fa-pencil-alt {
			color: #ffa011;
		}

		.fa-plus {
			color: #328EA0;
		}

		.fa-times {
			color: red;
    }
    /* .gantt_bar_task{
      background-color: #40a431;
      border-color: black;
    } */
 </style>
            <div class="box-header with-border" >
            <h1 class="box-title" > {{$projeto->codProj}} - {{$projeto->nomeProjeto}} (              
              @if($projeto->fk_estadoproj=='1')
              
              <span style="color:white">{{$status}} </span>)
            @elseif($projeto->fk_estadoproj=='2')
            <span style="color:yellow">{{$status}} </span>)
         
            @else
            <span>{{$status}} </span>)
            @endif </h1><h1 class="box-title pull-right">{{$area}}</h1>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

    <div class="box-body">
   
    
<div class="row">
    <div class="col-md-2 col-sm-12">
    </div>
    
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


    <div class="col-md-2 col-sm-12">
      </div>
</div><br>
        <div class="row">
          
            <div class="col-xs-12 col-sm-12 col-md-6" >
                <div class="box box-success" >
                    <div class="box-header with-border">
                        <h3 class="box-title">Datas:</h3>
                   
                {{-- {!! $empresa !!}{!! $user !!}{!! $user2 !!}{!! $urgencia !!}{!! $projDep !!}{!! $cliente !!}
                <p><strong>Descrição: </strong>{{$projeto->descricaoProjeto}}</p> --}}
              </div>
              <div class="box-body">
                  <div class="row"> 
                      
                      <div class="col-xs-12 col-sm-12 col-md-6" >   
                @if($projeto->dataInicio ==null)
                <div class="info-box bg-olive" id="datas" >
                    <span class="info-box-icon" > <i class="far fa-play-circle" style="line-height: inherit;"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Início Previsto</span>
                      <span class="info-box-number">{{$projeto->dataPrevistaInicio}}</span>
        
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
                      <span class="progress-description">Início: <strong style="color:#eb4e4e">----:--:--</strong></span>
                     
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  @elseif($projeto->dataInicio == $projeto->dataPrevistaInicio)
                  <div class="info-box bg-olive" id="datas">
                    <span class="info-box-icon" > <i class="far fa-play-circle" style="line-height: inherit;"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Início Previsto</span>
                      <span class="info-box-number">{{$projeto->dataPrevistaInicio}}</span>
        
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
                      <span class="progress-description">Início: <strong>{{$projeto->dataInicio}}</strong></span>
                     
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                @else
                <div class="info-box bg-olive" id="datas">
                    <span class="info-box-icon" > <i class="far fa-play-circle" style="line-height: inherit;"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Início Previsto</span>
                      <span class="info-box-number">{{$projeto->dataPrevistaInicio}}</span>
        
                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
                      <span class="progress-description">Início: {{$projeto->dataInicio}} <strong style="color:#eb4e4e">(Derrapagem)</strong></span>
                     
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                
                @endif
                
               
                </div>
            
 
               
                <div class="col-xs-12 col-sm-12 col-md-6" >
                   
           
                    @if($projeto->dataFim ==null)
                    <div class="info-box bg-olive"id="datas" >
                        <span class="info-box-icon" > <i class="far fa-stop-circle" style="line-height: inherit;"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">Fim Previsto</span>
                          <span class="info-box-number">{{$projeto->dataPrevistaFim}}</span>
            
                          <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                          </div>
                          <span class="progress-description">Fim: <strong style="color:#eb4e4e">----:--:--</strong></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      @elseif($projeto->dataFim == $projeto->dataPrevistaFim)
                      <div class="info-box bg-olive"id="datas" >
                        <span class="info-box-icon" > <i class="far fa-stop-circle" style="line-height: inherit;"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">Fim Previsto</span>
                          <span class="info-box-number">{{$projeto->dataPrevistaFim}}</span>
            
                          <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                          </div>
                          <span class="progress-description">Fim: <strong>{{$projeto->dataFim}}</strong></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                    @else
                    <div class="info-box bg-olive" id="datas">
                        <span class="info-box-icon" > <i class="far fa-stop-circle" style="line-height: inherit;"></i></span>
            
                        <div class="info-box-content">
                          <span class="info-box-text">Fim Previsto</span>
                          <span class="info-box-number">{{$projeto->dataPrevistaFim}}</span>
            
                          <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                          </div>
                          <span class="progress-description">Fim: {{$projeto->dataFim}} <strong style="color:#eb4e4e">(Derrapagem)</strong></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                    
                    @endif
                  </div>
                  <!-- /.box-body -->
               
             
                  </div>
              </div>
            </div> 
          </div> 
                <div class="col-xs-12 col-sm-12 col-md-6" >
                        <div id="graph">
                                {!! \Lava::render('BarChart', 'Grafico Teste', 'graph')!!}
                              </div>
                    </div>
       
        </div>
        <div class="row">
        
                 
                <div class="col-xs-12 col-sm-12 col-md-3" >
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Equipa:</h3>
                          </div>
                          <div class="box-body">
                                  
                            <div class="row text-center">
                               
                                  
                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                  <strong>Criado Por</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                    <strong>Responsável</strong>
                                  </div>
                            </div>
                      
                            <div class="row text-center">
          
                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                    <img class="responsive-img center-block" id="imagem" align="middle" src="{{asset($user2Img)}}"width="75px" height="75px" style="align:center; border: 3px solid #ddd;
                                    " alt="Message User Image"> <strong> {{$user2}}</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                          <img class="responsive-img center-block" src="{{asset($userImg)}}" align="middle" width="75px" height="75px" style=" border: 3px solid #ddd;
                                    " alt="Message User Image">   <strong> {{$user}}</strong>  
                                  </div>
                            </div>
                        </div>
                      
                             
                      </div>
                      <!-- /.box-body -->
                    </div>
                 
                        <div class="col-xs-12 col-sm-12 col-md-3" >
                            <div class="box box-success">
                                <div class="box-header with-border">
                            <h3 class="box-title">Departamentos Envolvidos:</h3>
                                 </div>
                          <div class="box-body">
                      
                            <div class="row text-center">
                                <div class="col-xs-12 col-sm-12 col-md-12" >
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                          <th>Departamento</th>
                                          <th style="">Nº de Colaboradores</th>
                              
                                        </tr>
                                       

                                          @foreach ($projDep as $dep)
                                          <tr>
                                          <td>{{$dep->abreviatura}}</td>
                                      
                                        
                                           
                                          <td><span class="badge bg-green">{{count(DB::table('tasks')->where('fk_projeto',$projeto->pk_projeto)->leftjoin('users','users.id','tasks.fk_tecnico')->where('users.fk_departamento',$dep->fk_departamento)->groupBy('tasks.fk_tecnico')->get())}}</span></td> 
                          
                                    
                                          
                                 
                               
                              
                                                </tr>
                                              
                                         @endforeach
                                        </tbody>
                                        </table>
                                              </div>
            
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>
                           

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6" >
                                    <div id="2">
                                            


                                            {!! \Lava::render('BarChart', 'horas', '2')!!}
                                          </div>
                                </div>
                   
                    </div>
<br><br>
                    <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12" >
                                    <div class="box box-success collapsed-box">
                                        <div class="box-header with-border">
                                    <h3 class="box-title">   Observações:  </h3>
                                       
                                         <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                          </div>
                                        </div>

                                  <div class="box-body">
                                                               
                                                                     
                                                             
                                                                  </h3>   
                                                       
                                                                  <div class="box-body text-justify">
                                                                        {{$projeto->observacoes}}
                                                                  </div>
                                                              
                                                              </div>
                                             
                                                            </div> </div> </div>

                    <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12" >
               
                                         
                                                
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                      <li class="active"><a href="#gantt" data-toggle="tab" aria-expanded="true">Gráfico Gantt</a></li>
                                                    
                                                      <li class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                      <div class="tab-pane active" id="gantt">
                                                          <div class="controls_bar">
                                                  
                                                              <span>   <span class="hidden"id="filter_days" style="display: none;">
                                                        
                                                                  <span> </span>
                                                                  <strong> Display: &nbsp; </strong>
                                                                  <label>
                                                                    <input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="full_week">
                                                                    <span>Semana Completa</span>
                                                                  </label>
                                                                  <label>
                                                                    <input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="work_week">
                                                                    <span>Dias de Trabalho</span>
                                                                  </label>
                                                                </span></span>
                                                              <strong> Escala: &nbsp; </strong>
                                                              <label>
                                                                <input name="scales" onclick="zoom_tasks(this)" type="radio" value="week">
                                                                <span>Hora</span></label>
                                                              <label>
                                                                <input name="scales" onclick="zoom_tasks(this)" type="radio" value="trplweek" checked="true">
                                                                <span>Dia</span></label>
                                                              <label>
                                                                <input name="scales" onclick="zoom_tasks(this)" type="radio" value="year">
                                                                <span>Mês</span></label>
                                                                <input value="PDF" type="button" onclick='gantt.exportToPDF()'>
                                                              <span class="hidden" id="filter_hours" style="display: none;">
                                                        
                                                                <span></span>
                                                                <strong> Display: &nbsp; </strong>
                                                                <label>
                                                                  <input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="full_day">
                                                                  {{-- <span>Dia Completo</span> --}}
                                                                </label>
                                                                <label>
                                                                  <input name="scales_filter" onclick="set_scale_units(this)" type="radio" value="work_hours">
                                                                  <span>Office hours</span>
                                                                </label>
                                                              </span>
                                                           
                                                            </div>
                                                          <div id="gantt_here" style='width:100%; height:100%;'></div>
                                                        <!-- /.post -->
                                                      </div>
                                                      <!-- /.tab-pane -->
                                                      
                                        
                                                      <div class="tab-pane" id="kanban">
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
                                                                            <div class="callout callout-success" style="background-color:white !important;
                                                                            color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #009abf !important;">
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
                                                         Técnico:   <span class="badge bg-green">{{DB::table('users')->where('id',$taskPendente->fk_tecnico)->value('sigla')}}</span>
                                                                                         {{-- <p>This is a green callout.</p> --}}
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
                                                                                    <div class="callout callout-success" style="background-color:white !important;
                                                                                      color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;">
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
                                                                                     Técnico:   <span class="badge bg-green">{{DB::table('users')->where('id',$tasksEmCurso->fk_tecnico)->value('sigla')}}</span>
                                                                                                                     {{-- <p>This is a green callout.</p> --}}
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
                                                                                    <div class="callout callout-success" style="background-color:white !important;
                                                                                    color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #eb4e4e !important;">
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
                                                                                        Técnico:   <span class="badge bg-green">{{DB::table('users')->where('id',$tasksConcluidas->fk_tecnico)->value('sigla')}}</span>
                                                                                                                        {{-- <p>This is a green callout.</p> --}}
                                                                                                                      </div>
                                                                                                                      <div class="pull-right">
                                                                                                                          <span class="badge bg-red" style="background-color:#eb4e4e !important">  {{DB::table('tasks')->where('id',$tasksConcluidas->parent)->value('text')}}</span>
                                                                                                                        </div>
                                                                                                                      </div> 
                                                    
                                                                           </div>  
                                                                          </div>  
                                                                        
                                                                         @endforeach  
                                                                            
                                                                                  
                                                                  </div>     </div>     </div>     
                                                                </div>   
                                                    
                                                      </div>
                                                      <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                   
                                                  </div>
                                       
                                  
       <style>	.dhx_horas input {
        width: 96px;
        padding: 5px;
        margin: 3px 10px 10px 10px;
        /* font-size: 11px; */
        height: 30px;
        text-align: center;
        border: 1px solid #ccc;
        color: #646464;
      }</style>
        <script src="{{URL('/')}}/js/locale.js" charset="utf-8"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://export.dhtmlx.com/gantt/api.js"></script>  
        <script type="text/javascript">

  



gantt.config.date_format = "%Y-%m-%d %H:%i:%s"; //Configura o formato do dateTime do gráfico
gantt.config.time_step = 5;
gantt.config.duration_unit = "hour";
 gantt.serverList("users", []); //server list que cria o array com os users
// Função que irá fazer loop à procura do nome do user que corresponda à fk_tecnico.
    function getUser(fk_tecnico) {
        var users = gantt.serverList("users");
        for (var s = 0; s < users.length; s++) {
            if (users[s].key == fk_tecnico) {
                return users[s].label;
            }
        }
        return "";
    }
    gantt.serverList("dep", []); //server list que cria o array com os dep
// Função que irá fazer loop à procura do nome do user que corresponda à fk_tecnico.
    function getDep(fk_departamento) {
        var dep = gantt.serverList("dep");
        for (var v = 0; v < dep.length; v++) {
            if (dep[v].key == fk_departamento) {
                return dep[v].label;
            }
        }
        return "";
    }
//Secções da lightbox
    gantt.locale.labels.section_users = "Responsável"; 
    gantt.locale.labels.section_dep = "Departamentos"; 
    gantt.locale.labels.section_start_date = "Data de Inicio";
    gantt.locale.labels.section_end_date = "Data de Fim";
    gantt.locale.labels.section_nulo = "";
    gantt.locale.labels.section_inicio = "Data de Inicio";
    gantt.locale.labels.section_fim = "Data de Fim";
//------------------
gantt.templates.scale_cell_class = function(date){
		    if(date.getDay()==0||date.getDay()==6){
		        return "weekend";
		    }
		};
		gantt.templates.task_cell_class = function(item,date){
		    if(date.getDay()==0||date.getDay()==6){ 
		        return "weekend" ;
		    }
		};

		var gantt_filter = 0;
		function filter_tasks(node){
			gantt_filter = node.value;
			gantt.refreshData();
		}


		function show_scale_options(mode){
			var hourConf = document.getElementById("filter_hours"),
				dayConf = document.getElementById("filter_days");
			if(mode == 'day'){
				hourConf.style.display = "none";
				dayConf.style.display = "";
				dayConf.getElementsByTagName("input")[0].checked = true;
			}else if(mode == "hour"){
				hourConf.style.display = "";
				dayConf.style.display = "none";
				hourConf.getElementsByTagName("input")[0].checked = true;
			}else{
				hourConf.style.display = "none";
				dayConf.style.display = "none";
			}
		}
		function set_scale_units(mode){
			if(mode && mode.getAttribute){
				mode = mode.getAttribute("value");
			}

			switch (mode){
				case "work_hours":
					gantt.config.subscales = [
            {unit:"hour", step:1, date:"%H"}
					];
					gantt.ignore_time = function(date){
						if(date.getHours() < 6 || date.getHours() > 23){
							return true;
						}else{
							return false;
						}
					};

					break;
				case "full_day":
					gantt.config.subscales = [
						{unit:"hour", step:1, date:"%H"}
					];
					gantt.ignore_time = null;
					break;
				case "work_week":
					gantt.ignore_time = function(date){
						if(date.getDay() == 0 || date.getDay() == 6){
							return true;
						}else{
							return false;
						}
					};

					break;
				default:
					gantt.ignore_time = null;
					break;
			}
			gantt.render();
		}
   

		function zoom_tasks(node){
			switch(node.value){
				case "week":
					gantt.config.scale_unit = "day"; 
					gantt.config.date_scale = "%d %M"; 
         
					gantt.config.scale_height = 60;
					gantt.config.min_column_width = 30;
					gantt.config.subscales = [
  						  {unit:"hour", step:1, date:"%H"}
					];
					show_scale_options("hour");
				break;
				case "trplweek":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "day"; 
					gantt.config.date_scale = "%d %M"; 
					gantt.config.subscales = [ ];
					gantt.config.scale_height = 35;
					show_scale_options("day");
				break;
				case "month":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "week"; 
					gantt.config.date_scale = "Week #%W"; 
					gantt.config.subscales = [
  						  {unit:"day", step:1, date:"%D"}
					];
					show_scale_options();
					gantt.config.scale_height = 60;
				break;
				case "year":
					gantt.config.min_column_width = 70;
					gantt.config.scale_unit = "month"; 
					gantt.config.date_scale = "%M"; 
					gantt.config.scale_height = 60;
					show_scale_options();
					gantt.config.subscales = [
  						  {unit:"week", step:1, date:"#%W"}
					];
				break;
			}
			set_scale_units();
			gantt.render();
		}

		show_scale_options("day");
		gantt.config.details_on_create = true;

		gantt.templates.task_class = function(start, end, obj){
			return obj.project ? "project" : "";
		}


		gantt.config.grid_width = 390;

    gantt.attachEvent("onTaskLoading", function(task){
      if(task.progress == 1.00){
        task.$open = false;
      }

    return true;
});

//Cria a coluna "Gerir" no dashboard do gráfico e aplica os botões de adicionar/editar/apagar
var colHeader = 'Gerir',
colContent = function (task) {
  if ( task.$level > 1 ){ //se a task conter um nivel superior a 1 apenas aparece o editar e apagar
        return ('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton(' + task.id + ', \'edit\')"></i>' +
			
				'<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton(' + task.id + ', \'delete\')"></i>');
		
    }
    //se não aparecem todos os botões normais
    return ('<i class="fa gantt_button_grid gantt_grid_edit fa-pencil-alt" onclick="clickGridButton(' + task.id + ', \'edit\')"></i>' +
				'<i class="fa gantt_button_grid gantt_grid_add fa-plus" onclick="clickGridButton(' + task.id + ', \'add\')"></i>' +
				'<i class="fa gantt_button_grid gantt_grid_delete fa-times" onclick="clickGridButton(' + task.id + ', \'delete\')"></i>');
		
    };
//------------------

//função que adiciona ação aos botões de gerir
function clickGridButton(id, action) {
    
		switch (action) {
			case "edit":
				gantt.showLightbox(id);
				break;
			case "add":
				gantt.createTask(null, id);
				break;
			case "delete":
				gantt.confirm({
					title: gantt.locale.labels.confirm_deleting_title,
					text: gantt.locale.labels.confirm_deleting,
					callback: function (res) {
						if (res)
							gantt.deleteTask(id);
					}
				});
				break;
		}
	}
//------------------
//Template que adiciona ao lado esquerdo das barras do gráfico a duração da mesma
		gantt.templates.leftside_text = function(start, end, task){
			if(task.duration ==1 )
			return task.duration + " Hora";
			else
			return task.duration + " Horas";
    };
//------------------

//configurações que permitem mover as tasks na vertical dentro do dashboard
    gantt.config.order_branch = true;
    gantt.config.order_branch_free = true;
//------------------

//função do dia
// var piada = function(titanic){
//   this.float = null;
// }

//------------------
//Evento accionado assim que a lightbox fecha, dando refresh ao gráfico para aparecer as novas tasks adicionadas
gantt.attachEvent("onAfterLightbox",function(){
      gantt.clearAll();
                gantt.init('gantt_here');
gantt.load("/api/data");}	);
//------------------
 
//------------------

//configuração das secções das lightboxes
gantt.attachEvent("onBeforeLightbox", function(id) {
 

  if(gantt.getParent(id) != 0){
    gantt.resetLightbox(); 
    var parent = gantt.getTask(gantt.getParent(id))

       

        if (parent.tipo == 0){
          gantt.config.lightbox.sections =[
        { name: "users", height: 25, map_to: "fk_tecnico", type: "select", options:gantt.serverList("users") },
        { name: "dep", height: 25, map_to: "fk_departamento", type: "select", options:gantt.serverList("dep") },
        { name: "description", height: 70, map_to: "text", type: "textarea", focus: true },
        { name: "start_date", height: 25, map_to: "start_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"],single_date:"true"},
        { name: "end_date", height: "25px !important", map_to: "end_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"], single_date:"true"}
          ];
        }
        else if (parent.tipo == 1){
          gantt.config.lightbox.sections = [
        { name: "users", height: 25, map_to: "fk_tecnico", type: "select", options:gantt.serverList("users") },
        { name: "description", height: 70, map_to: "text", type: "textarea", focus: true },
        { name: "start_date", height: 25, map_to: "start_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"],single_date:"true"},
        { name: "end_date", height: "25px !important", map_to: "end_date", type: "duration",time_format:["%d","%m","%Y","%H:%i"], single_date:"true"}
        ];
        };
        return true;
}});  
//------------------

//configuração das colunas de dashboard do gráfico
	gantt.config.columns = [
		{name: "text", tree: true, width: '*', resize: true},
    {
        name: "fk_tecnico", label: "Responsável",align: "center", template: function (obj) {
        return getUser(obj.fk_tecnico);
        }
        }, 
		{
			name: "buttons",
			label: colHeader,
			width: 75,
			template: colContent
		}
  ];
//------------------
//todo o código que faz o zoom funcionar
// var hourRangeFormat = function(step){
//     return function(date){
//         var intervalEnd = new Date(gantt.date.add(date, step, "hora") - 1)
//         return hourToStr(date) + " - " + hourToStr(intervalEnd);
//     };
// };


//------------------
gantt.config.initial_scroll = false;
 gantt.attachEvent("onLoadEnd", function(){ gantt.showDate(new Date()); });
   
gantt.init("gantt_here");

gantt.load("/api/data");
    gantt.ajax.get("/api/users").then(function(response){
    
        var users = JSON.parse(response.responseText); 
        gantt.updateCollection("users", users);
        gantt.render();
    });
    gantt.ajax.get("/api/dep").then(function(response){
    
    var dep = JSON.parse(response.responseText); 
    gantt.updateCollection("dep", dep);
    gantt.render();
});
var scrollX = gantt.posFromDate(new Date());
gantt.scrollTo(scrollX, 0);
// ganttChartControl.oData.scrollLeft = ((new Date() - ganttChartControl.startDate) / (24*60*60000) - 10) * ganttChartControl.dayInPixels; 
var dp = new gantt.dataProcessor("/api");

gantt.attachEvent("onLightboxSave", function(id, item){
    if(!item.text){
        gantt.message({type:"error", text:"Introduza uma descrição"});
        return false;
    }
    if(!item.fk_tecnico){
        gantt.message({type:"error", text:"Escolha um técnico válido"});
        return false;
    }
    if(!item.start_date){
        gantt.message({type:"error", text:"Introduza uma Data de Inicio válida"});
        return false;
    }

    if(!item.end_date){
        gantt.message({type:"error", text:"Introduza uma Data de Fim válida"});
        return false;
    }
        return true;
});
dp.init(gantt);

dp.setTransactionMode("REST");
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