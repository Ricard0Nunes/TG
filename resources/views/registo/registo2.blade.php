@extends('adminlte::page')

@section('title', 'Registo Diário')

@section('content')
<link rel="stylesheet" href="{{ asset('css/clock.css') }}">

<style>         td, tr{
                  padding:10px;
                  font-size:16px;
                }

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
                .itemprop['geo']{
                  display: none !important;
                }
                </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<div class="hidden">
    {{$totaltasks=0}}
  {{$desbloqueiaContadorTask=0}}
</div>


{{-- cabeçalho  --}}
  <div class="box box-widget " style="background-color:transparent">
        
        <div class=""  >
            <div class="box-body" >
                <span>
              
                </span>
          
                <div class="row" style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
                    <div class="col-xs-9 col-md-1" >
                      
                      <div class="card ">
                        <img class="img-responsive" src="{{asset($user->foto)}}"alt="User Avatar" width="200px">
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-3" >
                      <h1 class="" style="">{{$user->name}}</h1>
                        <p class="title">{{$cargo}}-{{$departamento}}</p>
                    </div>
                
                      
              
                    
            
                    {{-- mensagens de alerta--}}
                  <div class="col-xs-12 col-md-2">
                    @if (session('Success'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                        <strong> {{ session('Success') }}</strong>
                      </div>
                    @endif  
                    @if (session('Warning'))
                      <div class="alert alert-warning alert-dismissible" role="alert">
                        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                        <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                        <strong> {{ session('Warning') }}</strong>
                      </div>
                    @endif  

                  </div>
                  <div class="col-xs-12 col-md-2">
                  </div>
                    <div class="col-xs-12 col-md-4">
                      <h2 class="pull-left" style="padding-top: 0;
                      margin: -7px 0px 10px 0px;">Notícias</h2>  

            
                      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">



                                <div class="carousel-inner">
                                  @for ($n = 0; $n < count($noticias); $n++)
                                  @if ($n==0)
                                  <div class="item active">
                            {{$noticias[$n]->mensagem }} 
                            </div>   
                            @else
                                  <div class="item ">
                                      {{$noticias[$n]->mensagem }} </div> 
                                      @endif
                                  @endfor
                                @if (count($noticias)==0)
                                <div class="item active">
                                  Sem notícias por ler.
                                </div>   
                                @endif

                      </div>

                    </div>


              
                </div>
            </div>
          </div>
  </div>
        
 <br>
    {{-- botoes gestao  --}}
  <div class="pull-right">
          @if ($bloqueio==0)
              
      
              @if ($posicao==0 )
              <a href="entradamanha"><button class="btn btn-success btn " style="background-color:#40a431 !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;"  name="data"><i class="fas fa-door-open"></i>  Entrada</button></a>

              @elseif ($posicao==1)
              <a href="saidamanha"><button class="btn btn-alert btn "  style="background-color:#FFD634 !important;color:white !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;" name="data"><i class="fas fa-utensils"></i> Iniciar Almoço</button></a>
              @elseif ($posicao==2)
              <a href="entradatarde"><button class="btn btn-alert btn " style="background-color:#ff6c00 !important;color:white !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;" name="data"><i class="fas fa-utensils"></i>  Fim de Almoço</button></a>
              @elseif ($posicao==3)
              <a href="saida"><button class="btn btn-danger btn"  style="background-color:#eb4e4e !important;color:white !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;" name="data"><i class="fas fa-door-closed"></i>  Saída</button></a>
              @elseif ($posicao==4)
              <button type="button" class="btn btn-primary disabled  btn" style="background-color:#009abf !important;color:white !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
                Já trabalhou tudo hoje!
              </button>

              @endif
          @endif
      <div class="btn-group pull-right">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false" text="Ferramentas Rápidas"><i class="fas fa-star"></i>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li style="text-align:center;"><a href="">
            {!! Form::open(array('route' => 'criar.tarefa','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
            <input id="invisible_id"  name="data" type="hidden" value="{{$dia}}">
              <button type="submit" style="background-color: transparent; border:0px solid black; ">Criar Tarefa
            </button>
            <div class="pull-right">
                <span style=" display: inline;">
            
                {!! Form::close()!!}
                </span>
              
              </a>
            
          </li>
          <li style="text-align:center;"><a href="marcarausenciapropria">Marcar Ausência</a></li>
          <li style="text-align:center;"><a href="requisitarcarro">Requisitar Carro</a></li>
          <li style="text-align:center;"><a href="mostrarpontomensal">Ver Registo Mensal</a></li>
          <li style="text-align:center;">
            
              <a href="">
              
                  {!! Form::open(array('route' => 'registo.editarregisto','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  <input id="invisible_id"  name="data" type="hidden" value="{{$dia}}">
                    <input id="invisible_id"  name="id" type="hidden" value="{{$user->id}}">
                    <button type="submit" style="background-color: transparent; border:0px solid black; ">Editar Ponto
                  </button>
                  <div class="pull-right">
                      <span style=" display: inline;">
                  
                      {!! Form::close()!!}
                      </span>
                    
                    </div>
                  </a>
          </li>
        </ul>
      </div>
  </div>
  {{-- </td> --}}
{{-- </div> --}}


{{-- registo  --}}
 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12" >

      
     <br>
                     
                                         
    
     <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box box-success">
                <div class="box-header">
                <h3 class="box-title" class="pull-left">Registo Diário: {{  Carbon\Carbon::parse($dia)->formatLocalized(' %A, %d de %B de %Y')}} 
                  </h3>
                  <div class="pull-right">
                      {!! Form::open(array('route' => 'registo.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                      <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$user->id}}">
                        <button type="submit" class="btn btn-success fas fa-search pull-right">
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
                      </div>
                   
                </div>
                    
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          @if ($active_tab=='RegistoDiario')
                       
                          <li  id="tabs" class="active"><a href="#RegistoDiario" data-toggle="tab" aria-expanded="true">Registo Diario</a></li>
                          <li  id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                          <li  id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                          @elseif ($active_tab=='kanban')
                          <li  id="tabs"class=""><a href="#RegistoDiario" data-toggle="tab" aria-expanded="true">Registo Diario</a></li>
                          <li  id="tabs"class="active"><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                          <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                          @elseif ($active_tab=='notas')
                          <li  id="tabs"class=""><a href="#RegistoDiario" data-toggle="tab" aria-expanded="true">Registo Diario</a></li>
                          <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                          <li  id="tabs"class="active"><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                          @endif
                        
                          
                          
                        </ul>
                        <div class="tab-content">
                           <div id="RegistoDiario" class="tab-pane fade @if($active_tab=="RegistoDiario") in active @endif">
                                <div class="row">
                                    <div class="col-md-12">
                                      <!-- The time line -->
                                      <ul class="timeline">
                                    {{-- Entrada  --}}
                                        <li class="time-label">
                                            
                                          
                                                  <i class="fa fas fa-door-open bg-green"></i> 
                                             

                                                @if (count($ponto)>0)
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$ponto[0]->entradaManha}}</span>
                                                @else
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>Sem registo</span> 
                                                @endif
                                            
                                              {{-- </span> --}}
                                              @if (count($ponto)>0)
                                                @if ($ponto[0]->entradaManha=='00:00:00')
                                                    <div class="row pull-right">
                                                      <div class="col-md-3 col-xs-12">
                                                        <span class="label label-success">
                                                        {{ DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[0]->fk_justificacao )->value('descricao')}}
                                                        </span>
                                                 @else
                                                    
                                                
                            
                                                  <div class="row pull-right">
                                                    <div class="col-md-3 col-xs-12">
                                            
                                            @if ($ponto[0]->entradaTarde!=null)
                                            <strong  style="text-align:center!important"> ET: {{$ponto[0]->entradaTarde}}</strong>
                                            @else
                                            <strong  style="text-align:center!important"> ET: --:--:-- </strong>
                                            @endif 
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                            @if ($ponto[0]->saidaTarde!=null)
                                            <strong  style="text-align:center!important"> ST: {{$ponto[0]->saidaTarde}} </strong>
                                            @else
                                            <strong  style="text-align:center!important"> ST: --:--:-- </strong>
                                            @endif
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                            
                                            @if ($ponto[0]->totalDia!=null)
                                            <strong  style="text-align:center!important"> <i class="far fa-clock "></i> {{' '.$ponto[0]->totalDia.' '}} </strong>
                                            @else
                                            <strong   style="text-align:center!important"><i class="far fa-clock "></i> --:--:-- <strong>
                                            @endif
                                            </div>
                                              </div>
                                              <div class="row pull-right" >
                                                <div class="col-md-3 col-xs-12">
                                                  @if ($ponto[0]->entradaManha!=null)
                                                  <strong  style="text-align:center!important"> EM: {{$ponto[0]->entradaManha}} </strong>
                                              @else
                                                  <strong  style="text-align:center!important"> EM:--:--:-- </strong>
                                              @endif
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                              @if ($ponto[0]->saidaManha!=null)
                                                  <strong  style="text-align:center!important"> SM: {{$ponto[0]->saidaManha}} </strong>
                                              @else
                                                  <strong  style="text-align:center!important"> SM: --:--:-- </strong>
                                              @endif 
                                                </div>
                                                <div class="col-md-3 col-xs-12">
                                              @if ($ponto[0]->tempoAlmoco!=null)
                                              <strong  style="text-align:center!important"><i class="fas fa-utensils"></i>  {{'    '.$ponto[0]->tempoAlmoco.' '}}</strong>
                                              @else
                                              <strong  style="text-align:center!important"><i class="fas fa-utensils"></i> --:--:--</strong>
                                              
                                              @endif 
                                              @endif
                                                </div>
                                                </div>
              
                                          @else
                                          <div class="row pull-right" >
                                          Sem ponto registado
                                          </div>
                                          @endif
                            
                                        </li>
                                        <br>
                                    {{-- Fim Entrada  --}}
                                    
    
                                       {{-- validaçoes  --}}



                                            {{-- ver estas validações  --}}
                                        <div class="hidden">
                                              {{$i1=-1}}
                                              {{$calculoalmoco=0}}
                                              {{$duracaotask =0}}
                                              @if (count($ponto)==0))
                                              {{$tempotrabalhado=0}}
                                              {{$calculoalmoco=0}}

                                              @endif
                                              @if(count($tasks)==0)
                                              {{$verificacaoalmoco=0}}
                                              @endif


                                              @if ($posicao==0)
                                              {{$tempotrabalhado=0}}
                                            {{ $inicioalmoco=0}}
                                            
                                              @elseif($posicao==1)
                                              {{$pontomanha=Carbon\Carbon::parse($ponto[0]->entradaManha)}}
                                              {{$tempotrabalhado= Carbon\Carbon::parse($pontomanha)->diffInSeconds(Carbon\Carbon::now())}}
                                              {{ $inicioalmoco=0}}
                                              @elseif($posicao==2)
                                              {{$tempotrabalhado= Carbon\Carbon::parse($ponto[0]->totalDia)->diffInSeconds(Carbon\Carbon::parse('00:00:00'))}}
                                              {{$calculoalmoco= Carbon\Carbon::parse($ponto[0]->saidaManha)->diffInSeconds(Carbon\Carbon::now())}}
                                              @elseif($posicao==3)
                                                {{$duracaoalmoco=(Carbon\Carbon::parse($ponto[0]->tempoAlmoco))}}
                                                {{$manha= Carbon\Carbon::parse($ponto[0]->totalDia)->diffInSeconds(Carbon\Carbon::parse('00:00:00'))}} 
                                              {{ $tarde= Carbon\Carbon::parse($ponto[0]->entradaTarde)->diffInSeconds(Carbon\Carbon::now())}}
                                              {{ $tempotrabalhado= $manha+$tarde}}
                                                @elseif($posicao==4)
                                                {{$duracaoalmoco=$ponto[0]->totalAlmoco}}
                                                {{$tempotrabalhado= $ponto[0]->totalDia}} 
                                              @endif

                                                
                                         </div> 

                                      {{-- validaçoes  --}}








                                        
                                    {{-- Task  --}}
                                    @if (count($tasks)>0)
                                    @for ($i = 0; $i < count($tasks); $i++)
                                      {{-- para o contador de tarefas- colocar aqui --}}
                                   
                                      <div class="hidden">
                                        {{-- calculos scripts  --}}
                                        {{-- verificações de tasks antes de almoço --}}
                                          @if (count($ponto)>0) 
                                              @if ($ponto[0]->saidaManha!=null)
                        
                                                {{ $almoco1=Carbon\Carbon::parse($ponto[0]->saidaManha)->diffInSeconds(Carbon\Carbon::parse('00:00:00'))}}
                                                {{ $horatask1=Carbon\Carbon::parse($tasks[$i]->start_date)->diffInSeconds(Carbon\Carbon::parse('00:00:00'))}}               
                                            
                                              @elseif($ponto[0]->saidaManha==null)
                                                {{$almoco1=1000000}}
                                                {{ $horatask1=Carbon\Carbon::parse($tasks[$i]->start_date)->diffInSeconds(Carbon\Carbon::parse('00:00:00'))}}               
                        
                                                @endif 
                                            @elseif(count($ponto)==0)
                                               {{$horatask1=10}}               
                                                {{$almoco1=100}}
                                           @endif
                                                
                                                
                                           @if (($tasks[$i]->fk_estadoIntervencao==2))
                                                {{$duracaotask=(Carbon\Carbon::parse($tasks[$i]->horaInicio)->diffInSeconds(Carbon\Carbon::now()))}}
                                           @endif 
                                  </div>
                            
                                   
                                         @if ( $tasks[$i]->tipo==2)
                                            <li>
                                              <i class="fa" style=""><img src={{asset($tasks[$i]->logo)}} class="img-circle img-sm" style="border:1px solid grey"alt="Logo"></i>
                                
                                              <div class="timeline-item">
                                                <span class="time"><i class="fa fas fa-stopwatch"></i> 
                                                  @if ($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4)
                                                  ({{$tasks[$i]->duracaoHorasEstimado}}) 
                                                  @elseif ($tasks[$i]->fk_estadoIntervencao==2)
                                                  <td>      <a  id="taskduracao"></a></td>
                                                  <div class="hidden">
                                                    {{$desbloqueiaContadorTask=1}}
                                                  </div>
                                                  @elseif ($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==5 or $tasks[$i]->fk_estadoIntervencao==7)
                                                  {{$tasks[$i]->duracaoHorasReal}}
                                        
                                                  @endif
                                            
                                                </span>
                                
                                                <h3 class="timeline-header"><a href="#">
                                              
                                                  @if ($tasks[$i]->fk_estadoIntervencao==3)
                                                  <i class="fas fa-check"></i>  
                                                  @elseif($tasks[$i]->fk_estadoIntervencao==5)
                                                  <i class="far fa-pause-circle"></i>
                                                  @elseif($tasks[$i]->fk_estadoIntervencao==2)
                                                  <i class="fa fa-play "></i>
                                                  @else
                                                  <i class="far fa-calendar-alt"></i>
                                                  @endif
                                                  
                                                  
                                                  
                                                  {{' '}} {{carbon\carbon::parse($tasks[$i]->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasks[$i]->end_date)->format('H:i')}} </a>{{$tasks[$i]->text}}   </h3>
                                                
                                                <div class="timeline-body">
                                                <span>{{$tasks[$i]->nomeProjeto}}</span>  ({{($tasks[$i]->nomeCompleto)}})
                                                </div>
                                                <div class="timeline-footer">
                                               {{-- botoes de manipulacao  --}}
                                                    @if (($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4) and $tasks[$i]->tipo==2 )
                                                        @if ($tasks[$i]->fk_tecnico==auth::id())
                                                          {!! Form::open(array('route' => 'tarefa.iniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                          {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                              <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                              <button type="submit" class="btn btn-app btn-xs">
                                                              <i class="fa fa-play btn-xs"></i> Play
                                                              </button>
                                                          {!! Form::close()!!} 

                                                          {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                          {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                          <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                            <button type="submit" class="btn btn-app btn-xs">
                                                              <i class="fa fas fa-pencil-alt"></i> Editar
                                                              </button></a> 
                                                          {!! Form::close()!!}

                                                          {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                          {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                          <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                            <button type="submit" class="btn btn-app btn-xs">
                                                              <i class="fa fas fa-sync-alt"></i> Reagendar
                                                              </button></a> 
                                                          {!! Form::close()!!}

                                                          {!! Form::open(array('route' => 'tarefa.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                          {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                          <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                            <button type="submit" class="btn btn-app btn-xs">
                                                              <i class="fa fa-trash-alt"></i> Apagar
                                                              </button></a> 
                                                          {!! Form::close()!!}
                                                        @endif
                                                          {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                          {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                          <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                            <button type="submit" class="btn btn-app btn-xs">
                                                              <i class="fa fas fa-eye"></i> Ver
                                                              </button></a> 
                                                          {!! Form::close()!!}

                                                    @elseif($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 )
                                                      @if ($tasks[$i]->fk_tecnico==auth::id())
                                                      {!! Form::open(array('route' => 'tarefa.parar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                      {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                            <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                            <button type="submit" class="btn btn-app btn-xs">
                                                            <i class="fa fas fa-stop btn-xs"></i> Parar
                                                            </button>
                                                        {!! Form::close()!!} 

                                                        {!! Form::open(array('route' => 'tarefa.pausar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                        {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                                        @csrf
                                                      <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                        <button type="submit" class="btn btn-app btn-xs">
                                                          <i class="fa fa-pause-circle btn-xs"></i> Pausa
                                                            </button></a> 
                                                        {!! Form::close()!!}

                                                    

                                                        {!! Form::open(array('route' => 'tarefa.cancelar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                        {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                          <button type="submit" class="btn btn-app btn-xs">
                                                            <i class="fa fa-times-circle "></i> Cancelar
                                                            </button></a> 
                                                        {!! Form::close()!!}

                                                    

                                                        {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                        {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                          <button type="submit" class="btn btn-app btn-xs">
                                                            <i class="fa fas fa-pencil-alt"></i> Editar
                                                            </button></a> 
                                                        {!! Form::close()!!}
                                                        @endif

                                                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                    {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                    <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                      <button type="submit" class="btn btn-app btn-xs">
                                                        <i class="fa fas fa-eye"></i> Ver
                                                        </button></a> 
                                                    {!! Form::close()!!}

                                                    @elseif(($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==7 )and $tasks[$i]->tipo==2 )
                                                        @if ($tasks[$i]->fk_tecnico==auth::id())
                                                        {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                        {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                          <button type="submit" class="btn btn-app btn-xs">
                                                            <i class="fa fas fa-pencil-alt"></i> Editar
                                                            </button></a> 
                                                        {!! Form::close()!!}
                                                        @endif

                                                        {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                        {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                          <button type="submit" class="btn btn-app btn-xs">
                                                            <i class="fa fas fa-eye"></i> Ver
                                                            </button></a> 
                                                        {!! Form::close()!!}
                                                        @elseif($tasks[$i]->fk_estadoIntervencao==5 and $tasks[$i]->tipo==2 ) {{-- tarefas em pausa  --}}
                                                        <td> 
                                                            <span>
                                                              @if ($tasks[$i]->fk_tecnico==auth::id())
                                                              {!! Form::open(array('route' => 'tarefa.reiniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                              {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                                  <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                                <button type="submit" class="btn btn-app btn-xs">
                                                                  <i class="fa fa-play btn-xs"></i> Play
                                                                </button>
                                                            {!! Form::close()!!} 


                                                            {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                            {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                              <button type="submit" class="btn btn-app btn-xs">
                                                                <i class="fa fas fa-sync-alt"></i> Reagendar
                                                                </button></a> 
                                                            {!! Form::close()!!}
                                  
                                                              @endif
                                  
                                                                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                                    {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                                                    <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                                                      <button type="submit" class="btn btn-app btn-xs">
                                                                        <i class="fa fas fa-eye"></i> Ver
                                                                        </button></a> 
                                                                {!! Form::close()!!}

                                                    @endif
                                                {{-- botoes manipulaçao  --}}

                                                  
                                                </div>
                                              </div>
                                            </li>
                                              @elseif ( $tasks[$i]->tipo==3)
                                                    {{-- Ausencia  --}}
                                                      <li >
                                                        <i class="fa" style=""><img src={{asset($user->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
                                          
                                                        <div class="timeline-item"style="background-color:rgba(255, 0, 0, 0.2);">
                                                          <span class="time"><i class="fa fa-clock-o"></i> Ausência</span>
                                          
                                                          <h3 class="timeline-header"><a href="#">{{carbon\carbon::parse($tasks[$i]->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasks[$i]->end_date)->format('H:i')}} </a>{{$tasks[$i]->text}}  </a></h3>
                                          
                                                          <div class="timeline-body">
                                                        
                                                          </div>
                                                          <div class="timeline-footer">
                                                          </div>
                                                        </div>
                                                      </li>
                                               @elseif ( $tasks[$i]->tipo==4)
                                                      <li>
                                                        <i class="fa fa-utensils bg-yellow"></i>
        
                                                        <div class="timeline-item">
                                                          @if ($posicao==2)
                                                          <span class="time"><i id="duracaoalmoco" class="fa fas fa-stopwatch"></i> </span>
                                                          @else
                                                          <span class="time"><i class="fa fas fa-stopwatch"></i>{{$ponto[0]->tempoAlmoco}} </span> 
                                                          @endif
        
        
                                                          <h3 class="timeline-header no-border"><a href="#">{{carbon\carbon::parse($ponto[0]->saidaManha)->format('H:i')}} -
                                                            @if ($ponto[0]->entradaTarde==null)
                                                                --:--
                                                            @else
                                                            {{carbon\carbon::parse($ponto[0]->entradaTarde)->format('H:i')}}
                                                            @endif
                                                          </a> Almoço </h3>  
                                                        </div>
                                                        <br>
                                                        @if($posicao==2)
                                                        <div class="hidden">
                                                          {{-- {{$i1=0}}
                                                          {{$i--}} --}}
                                                      </div>
                                                      @endif
                                                     {{-- {{ $horatask1}} -{{$almoco1}} --}}
                                                      {{-- {{carbon\carbon::parse($tasks[$i]->start_date)->format('H:i')}} --}}
                                                    </li>
                                              
                                           
                                   @endif
                                        @endfor
                                        @endif 
                                    {{-- Task  --}}
                                                                 
                                    

                                  
                                      <br>
                                        <li class="time-label">
                                              <i class="fa fas fa-door-closed bg-red"></i> 
                                                

                                              @if (count($ponto)>0)
                                                @if ($ponto[0]->saidaTarde!=NULL)
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>{{$ponto[0]->saidaTarde}}</span>
                                              @else
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>Sem registo</span> 
                                              @endif
                                              @else
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>Sem registo</span> 
                                              @endif
                                              <span class="pull-right">
                                                Tempos Totais <br>
                                                Tarefas:  {{carbon\carbon::parse($tempotarefas)->format('H:i:s')}} <br>
                                                Trabalhado:
                                                @if ($bloqueio==0)
    

                                                @if ( $posicao==0  or $posicao==2 )
                                                @if ($tempotrabalhado-$totalAusencias<0)
                                                <strong>- {{ gmdate("H:i:s", abs($tempotrabalhado-$totalAusencias))}} </strong> 
                                                @else
                                                <strong> {{ gmdate("H:i:s", $tempotrabalhado-$totalAusencias)}} </strong> 
                                                @endif
                                
                                              @elseif($posicao==4)
                                              {{$tempotrabalhado}}
                                                @else
                                              
                                                <a  id="number"></a>
                                                @endif
                                                @elseif(count($ponto)>0)
                                                {{$tempotrabalhado}}
                                                @else
                                                00:00:00
                                                @endif

                                              </span>
                                        </li>
                                      </ul>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                              {{-- </div> --}}
                          
                            </div>
                    
                          
                            <!-- /.post -->
                        
                          <!-- /.tab-pane -->
                
{{-- barras inferiores --}}



                          <div id="kanban" class="tab-pane fade @if($active_tab=="kanban") in active @endif">
                          {{-- <div class="tab-pane" id="kanban"> --}}
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
                                {!! Form::open(array('route' => 'tarefa.iniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                              
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$taskPendente->id}}>
                                    <button type="submit" class="btn btn-success fas fa-play">
                                   </button></a> 
                                    {!! Form::close()!!}
                                    
                                    {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$taskPendente->id}}>
                                    <button type="submit" class="btn btn-success fas fa-sync-alt">
                                        </button></a> 
                                    {!! Form::close()!!}                      
                                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$taskPendente->id}}>
                                    <button type="submit" class="btn btn-success fas fa-eye">
                                        </button></a> 
                                    {!! Form::close()!!}
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
                                      <h4 style="text-align:center">Em Pausa ({{count($tasksEmPausa)}})</h4>  
                                      <hr style="  border: 5px solid #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
                                      <div class="row" style="	max-height:450px;overflow-y:auto;">
                                              <div class="col-xs-12 col-sm-12 col-md-12" >
                                                  @foreach ($tasksEmPausa as $tasksEmPausa)
                                                  <div class="box-body">
                                                          <div class="callout callout-success" style="background-color:white !important;
                                                            color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;">
                                                                  <div class="row">
                                                         
                                                                      <div class="pull-left">
                                                                         <span>{{$tasksEmPausa->text}}</span>
                                                                      </div>
                                                                      <div class="pull-right">
                                                                        
                                                                         <span style=""> {{$tasksEmPausa->horaInicio}}</span>
                                                          </div>   
                                                        </div>
                                                                                    
                                                      <br>
                                                      <div class="row">                         
                                                          <div class="pull-left">
                                                            <span>
                               
                                                              {!! Form::open(array('route' => 'tarefa.reiniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                            
                                                    
                                                              {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                            
                                                                <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasksEmPausa->id}}>
                                                                  <button type="submit" class="btn btn-success fas fa-play">
                                                                 </button></a> 
                                                                  {!! Form::close()!!}
                                                    
                                                                  {!! Form::open(array('route' => 'tarefa.reagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                                                <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasksEmPausa->id}}>
                                                                  <button type="submit" class="btn btn-success fas fa-sync-alt">
                                                                      </button></a> 
                                                                  {!! Form::close()!!}
                                            
                                                                  {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                                                <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasksEmPausa->id}}>
                                                                  <button type="submit" class="btn btn-success fas fa-eye">
                                                                      </button></a> 
                                                                  {!! Form::close()!!}
                                                                </span>
                                                                                         </div>
                                                                                         <div class="pull-right">
                                                                                             <span class="badge bg-red" style="background-color:#eb4e4e !important">  {{DB::table('tasks')->where('id',$tasksEmPausa->parent)->value('text')}}</span>
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
                                                                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                                {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasksConcluidas->id}}>
                                                                <button type="submit" class="btn btn-success fas fa-eye">
                                                                    </button></a> 
                                                                {!! Form::close()!!}
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
             
                        <!-- /.tab-content -->
                        <div id="notas" class="tab-pane fade @if($active_tab=="notas") in active @endif">
                          <div class="container">
                            
                            <h1>Notas</h1>
                         
                            @if(count($todolist) == 0)
                            <div class="empty-state">
                      
                              <h2 class="empty-state__title">Adicione Notas</h2>
                              <p class="empty-state__description">O que vai fazer hoje?</p>
                            </div>
                            @else
                            @foreach ($todolist as $t)
                          

                   
                                <div class="row" id="li2">
                                  <div class="col-md-10 col-xs-10" style="">
                              <form id="form"class="" action="/feitotodo" method="POST" style="display:inline-block">
                                  {{ csrf_field() }}
                                  @if($t->feito == 0)
                                  <label><input class="" name="id" value=""  onChange="this.form.submit()" type="checkbox">
                                <input type="hidden"   name="id" value={{$t->pk_todoList}} />
                                <span id="checkLabel">     
                                  {{$t->descricao}}  
                           
                              @else
                                  <strike>{{$t->descricao}}  </strike>
                              @endif
                            </div>  
                                  <div class="col-md-1 col-xs-1" style="text-align:center !important; margin:0 auto;">
                                  @if ($t->label==2)

                                    <small class="label label-success pull-right"><i class="fa fa-clock-o"></i> Prioritário</small>

                                    @elseif($t->label==1)
                                    <small class="label label-danger pull-right"><i class="fa fa-clock-o"></i> Normal</small>
                                    @else
                                  <small class="label label-info pull-right"><i class="fa fa-clock-o"></i> Informativo</small>

                                    @endif</span></label></div>
                              
                              </form>
                                 
                                  <div class="col-md-1 col-xs-1" >
                              <form id="form"class="" action="/apagartodo" method="POST" style="display:inline-block !important">
                                {{ csrf_field() }}
                                <button  id="delete-icon"onClick="this.form.submit()" class=""name="id"  value={{$t->pk_todoList}}>
                                    <i class="	glyphicon glyphicon-remove"></i></label>
                                    
                                  </button>
                                </form>
                                </div></div>
                            @endforeach
                            @endif
                            <br>
                            <form id="form"class="" action="/gravartodo" method="POST">
                              {{ csrf_field() }}
                            <div class="row">
                              <div class="col-md-6 col-xs-12 col-sm-12">
                                <select aria-label="Enter a new todo item"  name="label"placeholder="Escolha uma urgência" class="form-control">
                                  <option value="">Escolha uma Urgência</option>
                                  <option value="0">Informativo</option>
                                  <option  value="1">Normal</option>
                                  <option value="2">Prioritário</option>
                                  </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 col-xs-12 col-sm-12">
                                <br>
                                <input  type="text" name="descricao" aria-label="Enter a new todo item" placeholder="Inserir uma nova nota" class="form-control">
                              </div>
                            </div>
                           

                             
                          
                              {{-- <br>
                              <button class="js-todo-input btn btn-success pull-right "type="submit">Adicionar</button> --}}
                            </form>
                       
                          </div>
                          
                          <script>let todoItems = [];

                            function addTodo(text) {
                              const todo = {
                                text,
                                checked: false,
                                id:pk_todoList,
                              };
                            
                              todoItems.push(todo);
                            
                              const list = document.querySelector('.js-todo-list');
                              list.insertAdjacentHTML('beforeend', `
                                <li class="todo-item" data-key="${todo.pk_todoList}">
                                  <input id="${todo.pk_todoList}" type="checkbox"/>
                                  <label for="${todo.pk_todoList}" class="tick js-tick"></label>
                                  <span>${todo.descricao}</span>
                                  <button  id="delete-icon" class="delete-todo js-delete-todo">
                                    <i class="	glyphicon glyphicon-remove"><use href="#delete-icon"></use></i>
                                  </button>
                                </li>
                              `);
                            }
                            
                            function toggleDone(key) {
                              const index = todoItems.findIndex(item => item.pk_todoList == Number(key));
                              todoItems[index].checked = !todoItems[index].checked;
                            
                              const item = document.querySelector(`[data-key='${key}']`);
                              if (todoItems[index].checked) {
                                item.classList.add('done');
                              } else {
                                item.classList.remove('done');
                              }
                            }
                            
                            function deleteTodo(key) {
                              todoItems = todoItems.filter(item => item.pk_todoList !== Number(key));
                              const item = document.querySelector(`[data-key='${key}']`);
                              item.remove();
                              
                              const list = document.querySelector('.js-todo-list');
                              if (todoItems.length == 0) list.innerHTML = '';
                            }
                            
                            const form = document.querySelector('.js-form');
                            form.addEventListener('submit', event => {
                              // event.preventDefault();
                              const input = document.querySelector('.js-todo-input');
                            
                              const text = input.value.trim();
                              if (text !== '') {
                                addTodo(text);
                                input.value = text;
                                input.focus();
                              }
                            });
                            
                            const list = document.querySelector('.js-todo-list');
                            list.addEventListener('click', event => {
                              if (event.target.classList.contains('js-tick')) {
                                const itemKey = event.target.parentElement.dataset.key;
                                toggleDone(itemKey);
                              }
                              
                              if (event.target.classList.contains('js-delete-todo')) {
                                const itemKey = event.target.parentElement.dataset.key;
                                deleteTodo(itemKey);
                              }
                            
                            });</script>
                    </div>
    

 
            <!-- /.box-header -->
           
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
    

{{-- {{ $tempotrabalhado}} --}}
{{-- contador totais --}}

@if ($posicao!=2 && $posicao!=4 )
    

  <script>

  var ativa=0;
  var n = JSON.parse("{{ json_encode($tempotrabalhado-$totalAusencias) }}");
  if (n<0) {
    var n = JSON.parse("{{ json_encode($totalAusencias-$tempotrabalhado) }}");
    var ativa=1;
  }
  var  l = document.getElementById("number");
  window.setInterval(function(){


    if (ativa==1 && n>0) {
      l.innerHTML = '- '+new Date(n * 1000).toISOString().substr(11, 8);
      n--
    }else  {
      ativa=0;
      l.innerHTML = new Date(n * 1000).toISOString().substr(11, 8);
      n++;
    }
  
  },1000);
  </script>
@endif
{{-- contador almoço  --}}
@if ($posicao==2)
<script>


    var m = JSON.parse("{{ json_encode($calculoalmoco) }}");
   var  p = document.getElementById("duracaoalmoco");
   window.setInterval(function(){
     p.innerHTML = new Date(m * 1000).toISOString().substr(11, 8);
     m++;
   },1000);
   </script> 


@endif
   {{-- contador task --}}
@if ($desbloqueiaContadorTask==1)


   <script>


      var o = JSON.parse("{{ json_encode($duracaotask) }}");
     var  r = document.getElementById("taskduracao");
     window.setInterval(function(){
       r.innerHTML = new Date(o * 1000).toISOString().substr(11, 8);
       o++;
     },1000);
     </script>
     @endif
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    
     


<script>
    $(document).ready(function(){
      $('.dropdown-submenu a.test').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
      });
    });
    </script>
   
@stop

