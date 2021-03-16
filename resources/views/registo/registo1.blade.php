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



<div class="box box-widget " style="background-color:transparent">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class=""  >
          <div class="box-body" >
            
      
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
             
                   
           
                 
     
            {{-- </div> --}}
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

            {{-- {{$weather->getByCityName('casablanca') }}       --}}
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

    <!-- Left and right controls -->
    
  </div>


          
        </div>
            </div>
          </div>
        </div>
 <br>

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
      <li style="text-align:center;"><a href="criartarefa">Criar Tarefa</a></li>
      <li style="text-align:center;"><a href="marcarausenciapropria">Marcar Ausência</a></li>
      <li style="text-align:center;"><a href="mostrarpontomensal">Ver Registo Mensal</a></li>
      <li style="text-align:center;">
        
          <div >
            <a href="">
              {!! Form::open(array('route' => 'registo.editarregisto','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
              <input id="invisible_id"  name="data" type="hidden" value="{{$dia}}">
                <input id="invisible_id"  name="id" type="hidden" value="{{$user->id}}">
                <button type="submit" style="background-color: transparent; border:0px solid black; "> <i class="fas fa-pencil-alt"></i>Editar Ponto
               </button>
               <div class="pull-right">
                  <span style=" display: inline;">
              
                  {!! Form::close()!!}
                  </span>
                
                </div>
              </div>
            </a></li>
    </ul>
  </div>
</div>
</td>
</div>
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
                          {{-- <div class="tab-pane active" id="RegistoDiario"> --}}
                              <div class="box-body no-padding">
                                  <div class="pull-right link"></div>
                                
                                  <table class="table table" >
                                          <thead >
                                                  <tr>
                                                  <th>Hora Inicio</th>
                                                  <th>Referência Intervenção</th>
                                                  <th>Cliente</th>
                                                  <th>Estado</th>
                                                  <th>Hora Fim</th>
                                                  <th>Tempo Total</th>
                                           
                                                  <th>Gerir</th>
                                                  </tr>
                                                  
                                          </thead>
                                  <tbody>     
                                   
                   @if ( count($ponto)==0 and count($tasks)==0)
                  
                       
                           
                      
                         <tr id="tr"  class=""> 
                         <td><br><br><br><br></td>
                         <td><br><br><br><br></td>
                         <td><br><br><br></td>
                         <td><br><br><strong>Sem Registos</strong> </td>
                          </tr>
                          
                   @endif
                                               {{-- por minutos horas e segundos  --}}
                                            {{-- {{  $ponto1= }} --}}
                        @if (count($ponto)>0)
                        @if (($ponto[0]->fk_tipo==6))
                        <tr id="tr"  class="danger"> 
                        @elseif($ponto[0]->fk_tipo==7)
                        <tr id="tr"  class="warning">
                        @else
                        <tr id="tr"  class="success"> 
                        @endif
                      
                          <td>{{$ponto[0]->entradaManha}}</td>  
                          <td><strong>Entrada</strong>  </td>       
                          <td></td>   
                          @if ($ponto[0]->fk_tipo==5)
                          <td>Editado</td>
                          @elseif($ponto[0]->fk_tipo==6)
                          <td>Falta</td>
                          @else
                          <td>Validado</td>
                          @endif
                      
                          <td></td>
                          <td></td>
                          <td> 





                              {{-- <div class="btn-group " style="text-align:center;">
                                  <a href="editarregisto" value=10><button class="btn btn-success btn "  style="background-color:#40a431 !important;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;"  name="data"><i class="fas fa-pencil-alt"></i> </button></a>
                  
                              </div> --}}



                              
                              </td>
                   
                  
                  
                          
                        @endif
                  
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
                 
                  
                  @for($i = 0; $i < count($tasks); $i++)
                      @if ($tasks[$i]->fk_tecnico!=$user->id)
                        <div class="hidden">{{$totaltasks -- }}</div> 
                      @else
                      <div class="hidden">{{$totaltasks ++ }}</div> 

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

                     @if ( $horatask1<$almoco1 )
                  
                      {{-- tarefas antes de almoço --}}
                  
                        @if (($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4 )and $tasks[$i]->tipo==2 )
                           
                            <tr id="tr"  class="info">  
                           
                                <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}      </td>   
                                @elseif ($tasks[$i]->fk_estadoIntervencao==7  and $tasks[$i]->tipo==2 )
                                <tr id="tr"  class="info">  
                           
                                    <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}      </td>  

                                @elseif ($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 )
                            <tr id="tr"  class="warning">   
                                <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                                @elseif ($tasks[$i]->fk_estadoIntervencao==3 and $tasks[$i]->tipo==2 )
                                <tr id="tr"  class="success">   
                                    <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                                    @elseif ($tasks[$i]->fk_estadoIntervencao==5 and $tasks[$i]->tipo==2 )
                                    <tr id="tr"  class="success">   
                                        <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                                        @elseif ($tasks[$i]->tipo==3)
                                        
                                        <tr id="tr"  class="danger">  
                           
                                            <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('Y-m-d H:i:s')}}      </td>   
                            @endif
                  
                            <td>
                              @if(strlen($tasks[$i]->text)>40)
                              {{substr($tasks[$i]->text, 0, 37).' '.'...'}}
                              @else
                              {{$tasks[$i]->text}}
                              @endif  
                          
                            
                            </td>
                            <td>{{DB::table('clientes')->where('pk_cliente',(DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('fk_cliente')))->value('nomeAbreviado')}}</td>
                            <td><strong>{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks[$i]->fk_estadoIntervencao)->value('descricao')}}</strong></td>
                            
                  
                           @if ($tasks[$i]->end_date==null and $tasks[$i]->fk_estadoIntervencao!=4 and $tasks[$i]->fk_estadoIntervencao!=7 and $tasks[$i]->end_date==null and $tasks[$i]->tipo==2  or  ($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 ))
                           <td> --:--:--</td> 
                           @elseif($tasks[$i]->fk_estadoIntervencao>=4 and $tasks[$i]->tipo==2)
                               <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('H:i:s')}}</td>
                  
                           @elseif($tasks[$i]->fk_estadoIntervencao<=4 and $tasks[$i]->end_date!=null and $tasks[$i]->fk_estadoIntervencao!=2 and $tasks[$i]->tipo==2)
                               <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('H:i:s')}}</td>
                              
                               @elseif($tasks[$i]->tipo==3)
               
                          <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('Y-m-d H:i:s')}}</td>
                           @endif
                         
                  
                           @if ($tasks[$i]->duracao==null and $tasks[$i]->fk_estadoIntervencao!=2 and $tasks[$i]->fk_estadoIntervencao!=3 and $tasks[$i]->fk_estadoIntervencao!=5 and $tasks[$i]->fk_estadoIntervencao!=7)
                           <td> --:--:--</td> 
                           @elseif ($tasks[$i]->fk_estadoIntervencao==2)
                           <td>      <a  id="taskduracao"></a></td>
                           <div class="hidden">
                              {{$desbloqueiaContadorTask=1}}
                           </div>
                           @elseif ($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==5 or $tasks[$i]->fk_estadoIntervencao==7)
                           <td>{{$tasks[$i]->duracaoHorasReal}}</td>
                  
                           @endif
                  
                           @if (($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4) and $tasks[$i]->tipo==2 )
                  
                       
                           <td>
                             <span style=" display: inline;">
                              @if ($tasks[$i]->fk_tecnico==auth::id())
                            {!! Form::open(array('route' => 'tarefa.iniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                          
                              <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                <button type="submit" class="btn btn-success fas fa-play">
                               </button></a> 
                                {!! Form::close()!!}
                                
                                {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                <button type="submit" class="btn btn-success fas fa-sync-alt">
                                    </button></a> 
                                {!! Form::close()!!}     

                                @endif

                                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret') }}
                              
                                  <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                    <button type="submit" class="btn btn-success fas fa-eye">
                                   </button>
                                    {!! Form::close()!!}

                                    @if ($tasks[$i]->fk_tecnico==auth::id())

                                    {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pencil-alt btn btn-success">
                                        </button></a> 
                                    {!! Form::close()!!}
                                    
                                   {!! Form::open(array('route' => 'tarefa.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-trash-alt btn btn-success">
                                       </button></a> 
                                   {!! Form::close()!!}
                                   @endif
                              </span>
                             
                          </td>
                            @elseif($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 )
                  
                            <td>
                                <span>
                                  @if ($tasks[$i]->fk_tecnico==auth::id())
                               {!! Form::open(array('route' => 'tarefa.parar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                             
                     
                               {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                          
                                 <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-stop btn btn-success">
                                  </button></a> 
                                   {!! Form::close()!!}
                  
                                   {!! Form::open(array('route' => 'tarefa.pausar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                   @csrf
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pause-circle btn btn-success">
                                       </button></a> 
                                   {!! Form::close()!!}
                     
                                   {!! Form::open(array('route' => 'tarefa.cancelar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'cancelar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-times-circle btn btn-success">
                                       </button></a> 
                                   {!! Form::close()!!}
                  
                                   
                  
                                   {!! Form::open(array('route' => 'tarefa.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-trash-alt btn btn-success">
                                       </button></a> 
                                   {!! Form::close()!!}
                  
                                   {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pencil-alt btn btn-success">
                                       </button></a> 
                                   {!! Form::close()!!}
                                   @endif
                                 </span>
                        </td>
                  
                  
                          
                  
                            @elseif(($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==7 )and $tasks[$i]->tipo==2 )
                            <td> 
                                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      
                              
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                           
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class=" btn-success fas fa-eye btn">
                                   </button></a> 
                                    {!! Form::close()!!}
                                    @if ($tasks[$i]->fk_tecnico==auth::id())
                                    {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="btn-success  fas fa-pencil-alt btn">
                                        </button></a> 
                                    {!! Form::close()!!}
                                    @endif
                            </td>
                     
                           
                            @elseif($tasks[$i]->fk_estadoIntervencao==5 and $tasks[$i]->tipo==2 )
                            <td> 
                                <span>
                                  @if ($tasks[$i]->fk_tecnico==auth::id())
                                    {!! Form::open(array('route' => 'tarefa.reiniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  
                          
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  
                                      <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                        <button type="submit" class="btn btn-success fas fa-play">
                                       </button></a> 
                                        {!! Form::close()!!}

                                        {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                        {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                        <button type="submit" class="btn btn-success fas fa-sync-alt">
                                            </button></a> 
                                        {!! Form::close()!!}
                  @endif
                                        {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                        {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                        <button type="submit" class="btn btn-success fas fa-eye">
                                            </button></a> 
                                        {!! Form::close()!!}
                                      </span>
                            </td>
                  
                            @elseif($tasks[$i]->fk_estadoIntervencao==7 and $tasks[$i]->tipo==2 )
                            <td> 
                            <div class="btn-group " style="text-align:center;">
                              <button type="button" class="btn btn-success"><i class="fas fa-eye btn-xs"></i></button>
                              <button type="button" class="btn btn-success"> <i class="fas fa-pencil-alt"></i></button>
                              {{-- <button type="button" class="btn btn-success"><i class="fa fa-align-right"></i></button> --}}
                            </div>
                            </td>
                            @else 
                            <td></td>
                      @endif
                  </tr>
                  
{{-- tarefas depois de almoço tudo revisto  --}}
                   {{-- almoço --}}
              @elseif($i1==-1  and $posicao>1)
                  
                     
                            @if($posicao==2)
                              <tr id="tr"  class="warning">
                                
                                <td>{{$ponto[0]->saidaManha}}</td>              
                                      <td><strong>Almoço</strong>  </td>       
                                      <td></td>   
                                      
                                      <td>A decorrer</td>
                                      <td>  </td>
                                
                                  <td id="duracaoalmoco"></td>
                              </tr>
                            @endif 
                  
                            @if($posicao>2)
                              @if ($ponto[0]->fk_tipo==7)
                                <tr id="tr"  class="warning">
                              @else
                                <tr id="tr"  class="sucess">
                              @endif
                               
                                  <td>{{$ponto[0]->saidaManha}}</td>
                                  <td><strong>Almoço</strong>  </td>       
                                  <td></td>   
                                  <td>Finalizado</td>
                                  <td>
                                      {{$ponto[0]->entradaTarde}}
                                  </td>
                                  <td> {{ $ponto[0]->tempoAlmoco}} </td>
                                  <td></td>
                              </tr>
                  
                            @endif 
                  
                  
                            <div class="hidden">
                                {{$i1=0}}
                                {{$i--}}
                            </div>

                     {{-- fim almoço --}}
                     
                         {{-- tarefas depois de almoço  --}}
              @elseif ($horatask1>=$almoco1 )
                    {{-- hora de inicio  --}}
                    @if (($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4 )and $tasks[$i]->tipo==2 )
                           
                             <tr id="tr"  class="info">  
                            <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}      </td>   
                      @elseif ($tasks[$i]->fk_estadoIntervencao==7  and $tasks[$i]->tipo==2 )
                            <tr id="tr"  class="info">  
                            <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}      </td>  
                      @elseif ($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 )
                             <tr id="tr"  class="warning">   
                             <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                      @elseif ($tasks[$i]->fk_estadoIntervencao==3 and $tasks[$i]->tipo==2 )
                            <tr id="tr"  class="success">   
                            <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                      @elseif ($tasks[$i]->fk_estadoIntervencao==5 and $tasks[$i]->tipo==2 )
                            <tr id="tr"  class="success">   
                                <td>{{Carbon\Carbon::parse($tasks[$i]->start_date)->format('H:i:s')}}  </td> 
                      @elseif ($tasks[$i]->tipo==3)
                           <tr id="tr"  class="danger">  
                           <td>  {{Carbon\Carbon::parse($tasks[$i]->start_date)->format('Y-m-d H:i:s')}}      </td>   
                    @endif
                    {{-- fim de hora de inicio  --}}
                    <td> 
                      @if(strlen($tasks[$i]->text)>=40)
                      {{-- {{$tasks[$i]->text}} --}}
                              {{substr($tasks[$i]->text, 0, 37).' '.'...'}}
                              @else
                              {{$tasks[$i]->text}}
                              @endif  
                    </td>

                    <td>{{DB::table('clientes')->where('pk_cliente',(DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('fk_cliente')))->value('nomeAbreviado')}}</td>
                   
                    <td><strong>{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks[$i]->fk_estadoIntervencao)->value('descricao')}}</strong></td>
                    
                    {{-- end date  --}}
                    @if ($tasks[$i]->end_date==null and $tasks[$i]->fk_estadoIntervencao!=4 and $tasks[$i]->fk_estadoIntervencao!=7 and $tasks[$i]->end_date==null and $tasks[$i]->tipo==2  or  ($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 ))
                       <td> --:--:--</td> 
                      @elseif($tasks[$i]->fk_estadoIntervencao>=4 and $tasks[$i]->tipo==2)
                       <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('H:i:s')}}</td>
          
                      @elseif($tasks[$i]->fk_estadoIntervencao<=4 and $tasks[$i]->end_date!=null and $tasks[$i]->fk_estadoIntervencao!=2 and $tasks[$i]->tipo==2)
                       <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('H:i:s')}}</td>
                      
                       @elseif($tasks[$i]->tipo==3)
       
                      <td>{{Carbon\Carbon::parse($tasks[$i]->end_date)->format('Y-m-d H:i:s')}}</td>
                    @endif
                    {{--fim end date  --}}
                 
                    {{-- tempos de duração  --}}
                    @if ($tasks[$i]->duracao==null and $tasks[$i]->fk_estadoIntervencao!=2 and $tasks[$i]->fk_estadoIntervencao!=3 and $tasks[$i]->fk_estadoIntervencao!=5 and $tasks[$i]->fk_estadoIntervencao!=7)
                       <td> --:--:--</td> 
                      @elseif ($tasks[$i]->fk_estadoIntervencao==2)
                     <td><a  id="taskduracao"></a></td>
                      <div class="hidden">
                          {{$desbloqueiaContadorTask=1}}
                      </div>
                      @elseif ($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==5 or $tasks[$i]->fk_estadoIntervencao==7)
                       <td>{{$tasks[$i]->duracaoHorasReal}}</td>
          
                    @endif
                    {{--Fim tempos de duração  --}}

                    {{-- gestao de tarefas  --}}
                    @if (($tasks[$i]->fk_estadoIntervencao==1 or $tasks[$i]->fk_estadoIntervencao==4) and $tasks[$i]->tipo==2 )   {{-- tarefa em reagendada  ou agendada --}}
                       <td>
                          <span style=" display: inline;">
                             @if ($tasks[$i]->fk_tecnico==auth::id())
                                    {!! Form::open(array('route' => 'tarefa.iniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                        <a href="{{$tasks[$i]->id}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                        <button type="submit" class="btn btn-success fas fa-play">
                                      </button></a> 
                                    {!! Form::close()!!}
                                    
                                    {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                      <button type="submit" class="btn btn-success fas fa-sync-alt">
                                      </button></a> 
                                    {!! Form::close()!!}      
                              @endif    
                              {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                <a href="{{$tasks[$i]->id}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                  <button type="submit" class="btn btn-success fas fa-eye">
                                </button></a> 
                              {!! Form::close()!!}
                              
                              @if ($tasks[$i]->fk_tecnico==auth::id())

                              {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                            <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pencil-alt btn btn-success">
                                  </button></a> 
                              {!! Form::close()!!}
                              
                             {!! Form::open(array('route' => 'tarefa.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                             {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                           <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-trash-alt btn btn-success">
                                 </button></a> 
                             {!! Form::close()!!}
                             @endif
                         </span>
                     
                       </td>
                      @elseif($tasks[$i]->fk_estadoIntervencao==2 and $tasks[$i]->tipo==2 )   {{-- tarefa em andamento --}}
                      
                      <td>
                          <span>
                                @if ($tasks[$i]->fk_tecnico==auth::id())
                                {!! Form::open(array('route' => 'tarefa.parar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-stop btn btn-success">
                                  </button></a> 
                                {!! Form::close()!!}
                
                                {!! Form::open(array('route' => 'tarefa.pausar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                    @csrf
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pause-circle btn btn-success">
                                    </button></a> 
                                {!! Form::close()!!}
                  
                                {!! Form::open(array('route' => 'tarefa.cancelar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'cancelar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-times-circle btn btn-success">
                                  </button></a> 
                                {!! Form::close()!!}

                                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="{{$tasks[$i]->id}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                    <button type="submit" class="btn btn-success fas fa-eye">
                                  </button></a> 
                                {!! Form::close()!!}
                                
                
                                {!! Form::open(array('route' => 'tarefa.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-trash-alt btn btn-success">
                                  </button></a> 
                                {!! Form::close()!!}
                
                                {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="fas fa-pencil-alt btn btn-success">
                                  </button></a> 
                                {!! Form::close()!!}

                              
                              </span>
                            @endif
                          </span>
                        </td>
            
            
                    
            
                      @elseif(($tasks[$i]->fk_estadoIntervencao==3 or $tasks[$i]->fk_estadoIntervencao==7 )and $tasks[$i]->tipo==2 )  {{-- tarefas concluidas --}}
                    
                      <td> 
                          {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                              <a href="{{$tasks[$i]->id}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class=" btn-success fas fa-eye btn">
                            </button></a> 
                          {!! Form::close()!!}

                          @if ($tasks[$i]->fk_tecnico==auth::id())
                              {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}><button type="submit" class="btn-success  fas fa-pencil-alt btn">
                                  </button></a> 
                              {!! Form::close()!!}
                            @endif
                      </td>
              
                    
                      @elseif($tasks[$i]->fk_estadoIntervencao==5 and $tasks[$i]->tipo==2 ) {{-- tarefas em pausa  --}}
                      <td> 
                          <span>
                            @if ($tasks[$i]->fk_tecnico==auth::id())
                              {!! Form::open(array('route' => 'tarefa.reiniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                  <button type="submit" class="btn btn-success fas fa-play">
                                </button></a> 
                              {!! Form::close()!!}

                              {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                  <button type="submit" class="btn btn-success fas fa-sync-alt">
                                  </button></a> 
                              {!! Form::close()!!}
                                  {!! Form::open(array('route' => 'tarefa.reagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                  <button type="submit" class="btn btn-success fas fa-sync-alt">
                                      </button></a> 
                              {!! Form::close()!!}

                            @endif

                              {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tasks[$i]->id}}>
                                  <button type="submit" class="btn btn-success fas fa-eye">
                                      </button></a> 
                              {!! Form::close()!!}
                                </span>
                        </td>
                          
                      @elseif($tasks[$i]->fk_estadoIntervencao==7 and $tasks[$i]->tipo==2 )
                                  <td> 

                                    {{-- nao apagar. não sei que estado é este  - FB --}}
                                  <div class="btn-group " style="text-align:center;">
                                    <button type="button" class="btn btn-success"><i class="fas fa-eye btn-xs"></i></button>
                                    <button type="button" class="btn btn-success"> <i class="fas fa-pencil-alt"></i></button>
                                    {{-- <button type="button" class="btn btn-success"><i class="fa fa-align-right"></i></button> --}}
                                  </div>
                                  </td>
                                  @else 
                                  <td></td>
                    @endif
                    {{-- Fim gestao de tarefas  --}}
                </tr>
                        
                                        



                    {{-- tarefas depois de almoço  --}}
                  
              @endif
                         {{-- fim de tarefas depois de almoço  --}}
                      {{-- verificacao ferias  --}}
            @endif
         @endfor
                  
                  
                  
         {{-- saida e almoço sem tarefas  --}}
         @if ($posicao>0)
  
               @if (($ponto[0]->entradaTarde)==null and $i1==-1 and $posicao==2 and $posicao>0)
                  
                                                      <tr id="tr"  class="warning">
                                                          <td>{{$ponto[0]->saidaManha}}</td>
                                                          
                                                          <td><strong>Almoço</strong>  </td>       
                                                          <td></td>   
                                                  
                                                          <td>A decorrer</td>
                                                          <td>  </td>
                                                      <td id="duracaoalmoco"></td>
                                                      <td></td>
                                                      </tr>
                  
               @elseif($posicao>2 and $i1==-1)
                    @if (($ponto[0]->fk_tipo==6))
                        <tr id="tr"  class="danger"> 
                
                      @elseif( $ponto[0]->fk_tipo==7)
                      <tr id="tr"  class="warning"> 
                      @else
                      
                      <tr id="tr"  class="success"> 
                    @endif
                  
                    <td>{{$ponto[0]->saidaManha}}</td>
                    
                    <td><strong>Almoço</strong>  </td>       
                    <td></td>   
                    
                    @if ($ponto[0]->fk_tipo==5)
                     <td>Editado</td>
                    @elseif($ponto[0]->fk_tipo==6)
                     <td>Falta</td>
                    @else
                     <td>Finalizado</td>
                    @endif
                       <td> {{$ponto[0]->entradaTarde}}  </td>
                        <td> {{ $ponto[0]->tempoAlmoco}} </td>
                        <td></td>
                    </tr>

               @endif
                  
               {{-- saida --}}
               @if ($posicao>3)
                       @if (($ponto[0]->fk_tipo==6))
                       <tr id="tr"  class="danger"> 
                       @elseif((($ponto[0]->fk_tipo==7)))
                       <tr id="tr"  class="warning"> 
                       @else
                       <tr id="tr"  class="success"> 
                       @endif
                                             
                      <td>{{$ponto[0]->saidaTarde}}</td>  
                          <td><strong>Saída</strong>  </td>       
                          <td></td>   
                       @if ($ponto[0]->fk_tipo==5)
                          <td>Editado</td>
                       @elseif($ponto[0]->fk_tipo==6)
                          <td>Falta</td>
                       @else
                          <td>Validado</td>
                      @endif
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
               @endif
         @endif
                  
        </tbody>
        </table>
                  
                                 
{{-- reevisto ate aqui                --}}
                  {{-- resolver este problema quando tem uma ausencia --}}
                                <strong>Nº de Intervenções: 
                                  @if ($totaltasks<0)
                                      0
                                  @else
                                  {{count($tasks)}} 
                                  @endif
                                 
                                </strong> 
                                  <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempo trabalhado: </strong>
                                  @if ( $posicao==0  or $posicao==2)
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
                             
                              </div>
                              <!-- /.box-body -->
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
                                <select aria-label="Enter a new todo item"  name="label"placeholder="Escolha uma urgência" class="form-control">
                                    <option value="">Escolha uma Urgência</option>
                                    <option value="0">Informativo</option>
                                    <option  value="1">Normal</option>
                                    <option value="2">Prioritário</option>
                                    </select><br>
                              <input  type="text" name="descricao" aria-label="Enter a new todo item" placeholder="Inserir uma nova nota" class="form-control">
                          
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

@if ($posicao!=2 && $posicao!=4)
    

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

