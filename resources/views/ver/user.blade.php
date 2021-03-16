@extends('adminlte::page')

@section('empresas', 'Perfil Utilizador')


@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<style>td, tr{
    padding:10px;
    font-size:16px;

  }</style>
    <script>
      $(document).ready(function() {
       $('#example').dataTable({"language": {
              "url": "js/localeDataTable.js"
          } } );
   } );

   $(document).ready(function() {
       $('#example2').dataTable( {"language": {
              "url": "js/localeDataTable.js"
          }} );
   } );

   </script>
<div class="row">
    <div class="col-md-3 col-xs-12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
            @elseif( Session::has('warning'))
            <div class="alert alert-danger">
                        {{ Session::get('warning')}}
                  </div>
           @endif 
    </div>
  </div>
<div class="hidden">
{{$cargo = DB::table('cargos')->where('pk_cargo',$user->fk_cargo)->value('descricao')}}
</div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil de Utilizador
      </h1>
   
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">
  <div class="col-md-12 col-xs-12 ">
    <div class="nav-tabs-custom" >
      <ul class="nav nav-tabs">
          <style>
          #tabs.active{
              border-top:3px solid #00a65a !important;
          }</style>

                    @if ($active_tab=='info')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class="active"><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class=""><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class=""><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>
                    @endif
                    @elseif ($active_tab=='kanban')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class=""><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class="active"><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class=""><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class=""><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>

                    @endif
                    @elseif ($active_tab=='notas')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class=""><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class="active"><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class=""><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class=""><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>

                    @endif
                    @elseif ($active_tab=='notificacoes')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class=""><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class="active"><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class=""><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>

                    @endif
                    @elseif ($active_tab=='ausencias')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class=""><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class=""><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class="active"><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>

                    @endif
                    @elseif ($active_tab=='projeto')
                    @if(Auth::id() != $user->id)
                    <li id="tabs"class=""><a href="#info" data-toggle="tab" aria-expanded="true">Informações</a></li>
                    @else
                    <li id="tabs" class=""><a href="#kanban" data-toggle="tab" aria-expanded="false">Kanban</a></li>
                    <li id="tabs" class=""><a href="#notas" data-toggle="tab" aria-expanded="false">Notas</a></li>
                    <li id="tabs" class=""><a href="#notificacoes" data-toggle="tab" aria-expanded="false">Notificações</a></li>
                    <li id="tabs" class=""><a href="#ausencias" data-toggle="tab" aria-expanded="false">Ausências</a></li>
                    <li id="tabs" class="active"><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>

                    @endif
                    @endif



      
      </ul>
      <div class="tab-content">
          <div id="info" class="tab-pane fade @if($active_tab=="info" AND Auth::id() != $user->id) in active @endif">

      
              <div class="row">
                      <div class="col-xs-12 col-md-8">
                          <p style="font-size:17px;">
                          <i class="far fa-calendar-alt fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Data de Inicio de Contrato:</b>&nbsp;
                          @if ($user->dataInicioContrato == null)
                              NA     
                          @else
                              {{$user->dataInicioContrato}}
                          @endif
                          </p>
                      </div> 
                      <div class="col-xs-12 col-md-4">
                          <p style="font-size:17px;">
                          <i class="far fa-handshake fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>É subcontratado:</b>&nbsp;
                          @if ($user->subcontratado == null)
                              NA
                          @elseif($user->subcontratado == 1)
                              Sim
                          @else
                              Não
                          @endif 
                          </p>
                      </div>
                  </div>
                  {{-- Fim Row: Dt.contrato e Subcontratado --}}

                  {{-- Row: Contato profissional e  Email profissional--}}
                  <div class="row">
                      <div class="col-xs-12 col-md-8">
                          <p style="font-size:17px;">
                          <i class="fas fa-envelope-open-text fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Email Profissional:</b>&nbsp;{{$user->email}}
                          </p>
                      </div> 
                      <div class="col-xs-12 col-md-4">
                          <p style="font-size:17px;">
                          <i class="fas fa-phone-square-alt fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Contacto Profissional:</b>&nbsp;
                          @if ($user->contactoProfissional == null)
                              NA     
                          @else
                              {{$user->contactoProfissional}}
                          @endif
                          </p>
                      </div> 
                  </div>
                  {{-- Fim Row: Contato profissional e  Email profissional--}}

                  {{-- Row: Morada e Custo/hora--}}
                  <div class="row">
                                              <div class="col-xs-12 col-md-8">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-home fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Morada:</b>&nbsp;
                                                      @if ($user->morada == null)
                                                          NA     
                                                      @else
                                                          {{$user->morada}}
                                                      @endif
                                                  </p>
                                              </div>
                                              <div class="col-xs-12 col-md-4">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-euro-sign fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Custo/Hora:</b>&nbsp;
                                                      @if ($user->custoHora == null)
                                                          NA     
                                                      @else
                                                          {{$user->custoHora}} €
                                                      @endif
                                                  </p>
                                              </div>
                  </div>
                  {{-- Fim Row: Morada e Custo/hora --}}

                  {{-- Row: Email pessoal e Contacto pessoal --}}
                  <div class="row">
                                              <div class="col-xs-12 col-md-8">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-envelope-square fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Email pessoal:</b>&nbsp;
                                                      @if ($user->emailPessoal == null)
                                                          NA     
                                                      @else
                                                          {{$user->emailPessoal}}
                                                      @endif
                                                  </p>
                                              </div>
                                              <div class="col-xs-12 col-md-4">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-phone-square fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Contacto pessoal:</b>&nbsp;
                                                      @if ($user->contactoPessoal == null)
                                                          NA     
                                                      @else
                                                          {{$user->contactoPessoal}}
                                                      @endif
                                                  </p>
                                              </div>
                  </div>
                  {{-- Fim Row: Email pessoal e Contacto pessoal --}}

                  {{-- Row: Dt.Nascimento e Sexo --}}
                  <div class="row">
                                              <div class="col-xs-12 col-md-8">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-birthday-cake fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Data de Nascimento:</b>&nbsp;
                                                      @if ($user->dtnsc == null)
                                                          NA     
                                                      @else
                                                          {{$user->dtnsc}}
                                                      @endif
                                                  </p>
                                              </div>
                                              <div class="col-xs-12 col-md-4">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-venus-mars fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Sexo:</b>&nbsp;
                                                      @if ($user->sexo == 0)
                                                          F 
                                                      @elseif($user->sexo == 1)
                                                          M
                                                      @else
                                                          NA
                                                      @endif
                                                  </p>
                                              </div>
                                              
                  </div>
                  {{-- Fim Row: Dt.Nascimento e Sexo --}}

                  {{-- Row: Contato emergência e BI --}}
                  <div class="row">
                                              <div class="col-xs-12 col-md-8">
                                                  <p style="font-size:17px;">
                                                      <i class="fas fa-phone-volume fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Contacto emergência:</b>&nbsp;
                                                      @if ($user->contactoEmergencia == null)
                                                          NA     
                                                      @else
                                                          {{$user->contactoEmergencia}}
                                                      @endif
                                                  </p>
                                              </div>
                                              <div class="col-xs-12 col-md-4">
                                                  <p style="font-size:17px;">
                                                      <i class="far fa-id-card fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>CC:</b>&nbsp;
                                                      @if ($user->bi == null)
                                                          NA     
                                                      @else
                                                          {{$user->bi}} - {{$user->validadecc}}
                                                      @endif
                                                  </p>
                                              </div>
                                          </div>
                                          {{-- Fim Row: Contato emergência e BI --}}
                  
                                          {{-- Row: NIF e S.Social --}}
                                          <div class="row">
                                                                      <div class="col-xs-12 col-md-8">
                                                                          <p style="font-size:17px;">
                                                                              <i class="far fa-id-card fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>NIF:</b>&nbsp;
                                                                              @if ($user->nif == null)
                                                                                  NA     
                                                                              @else
                                                                                  {{$user->nif}}
                                                                              @endif
                                                                          </p>
                                                                      </div>
                                                                      <div class="col-xs-12 col-md-4">
                                                                          <p style="font-size:17px;">
                                                                              <i class="far fa-id-card fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Segurança Social:</b>&nbsp;
                                                                              @if ($user->segSocial == null)
                                                                                  NA     
                                                                              @else
                                                                                  {{$user->segSocial}}
                                                                              @endif
                                                                          </p>
                                                                      </div>
                                                                  </div>
                                                                  {{-- Fim Row: NIF e S.Social--}}   
                                                                  <div class="row">
                                                                    <div class="col-xs-12 col-md-8">
                                                                        <p style="font-size:17px;">
                                                                            <i class="fas fa-car fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Carta de Condução:</b>&nbsp;
                                                                            @if ($user->cartaConducao == 0)
                                                                                Não     
                                                                            @else
                                                                             Sim
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-4">
                                                                        <p style="font-size:17px;">
                                                                            <i class="fas fa-coins fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Salário Base:</b>&nbsp;
                                                                            @if ($user->salarioBase == null)
                                                                                NA     
                                                                            @else
                                                                                {{$user->salarioBase}}€
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>     
                                                                <div class="row">
                                                                  <div class="col-xs-12 col-md-8">
                                                                      <p style="font-size:17px;">
                                                                          <i class="fas fa-piggy-bank fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Iban:</b>&nbsp;
                                                                          @if ($user->iban == null)
                                                                              NA     
                                                                          @else
                                                                           {{$user->iban}}
                                                                          @endif
                                                                      </p>
                                                                  </div>
                                                                  <div class="col-xs-12 col-md-4">
                                                                      <p style="font-size:17px;">
                                                                          <i class="fas fa-ring fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Estado Civil:</b>&nbsp;
                                                                          @if ($user->estadoCivil == null)
                                                                              NA     
                                                                          @else
                                                                              {{$user->estadoCivil}}
                                                                          @endif
                                                                      </p>
                                                                  </div>
                                                              </div>     
                                                              <div class="row">
                                                                <div class="col-xs-12 col-md-8">
                                                                    <p style="font-size:17px;">
                                                                        <i class="fas fa-baby fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Número de Filhos:</b>&nbsp;
                                                                        @if ($user->numeroFilhos == null)
                                                                            0     
                                                                        @else
                                                                         {{$user->numeroFilhos}}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="col-xs-12 col-md-4">
                                                                  <p style="font-size:17px;">
                                                                      <i class="fas fa-folder fa-2x" style="color:green;"></i>&nbsp;&nbsp;&nbsp;<b>Data Fim de Contrato:</b>&nbsp;
                                                                      @if ($user->dataFimContrato == null)
                                                                          NA     
                                                                      @else
                                                                          {{$user->dataFimContrato}}
                                                                      @endif
                                                                  </p>
                                                              </div>
                                                  
                                                            </div>      
                                                                  
                                                                  <br><br>
                                                                  <!-- /.col -->
                                                                </div>
                                                           
   
        <!-- /.tab-pane -->

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
                      
                      <button type="button" class="btn btn-success fas fa-history" id="edit2-item" data-item-id="{{$taskPendente->id}}"></button>
        
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
          {{-- <div class="form-group ">
              <label for="inputName" class="col-md-1 control-label">select</label>  
              <div class="col-md-5">
                  <div class="checkbox">
                      <input type="checkbox" name="packersOff" value="1"/>
                       <label class="strikethrough">sssssssss</label>
                  </div>
               </div>
          </div> --}}

 
              <div class="row" id="li2"style=" width:91%;" >
                <div class="col-md-10 col-sm-10 col-xs-10" >
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
          <form id="form"class="" action="/gravartodo" style=" width:90%;"  method="POST">
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
  <!-- /.col -->
    </div>
<!-- /.row -->
<div id="notificacoes" class="tab-pane fade @if($active_tab=="notificacoes") in active @endif">

    @if (count($notificacoes)>0)

   






  <div class="box-body no-padding">
      <table class="table table-striped">
        <tbody><tr>
       
          <th>Notificação</th>
          <th style="width: 40px">Estado</th>
          <th style="width: 40px">Apagar</th>
        </tr>
        @foreach ($notificacoes as $notificacoes)
        <tr>
      
          <td>

            @if (($notificacoes->lida)==0)
            @if ($notificacoes->fk_tipoNotificacao==3)
            @if (auth()->user()->fk_departamento==3)
            <a href="{{url('/').'/mostrarausencias'}}">
              @endif
              @elseif($notificacoes->fk_tipoNotificacao==2)
              @if (auth()->user()->fk_departamento==3)
              <a href="{{url('/').'/aprovarpontos'}}">
                @endif
          @endif
            {{$notificacoes->descricao}}
          </a>
            @else
            <strike>   {{$notificacoes->descricao}} </strike>
            @endif
            
          </td>
         
            @if ($notificacoes->lida==0)
            <td>
            <form id="form"class="pull-right important" action="/lernotificacao" method="POST" style="display:inline-block !important">
              {{ csrf_field() }}
              <button  id="delete-icon"onClick="this.form.submit()" class=""name="id"  value={{$notificacoes->pk_notificacao}}>
                  <i class=" fas fa-eye"></i></label>
                  
              </button>
              </form>
            @else
          
                <td>   <i class="fas fa-eye-slash"></i></td>
            @endif
          </td>
          <td> 
              <form id="form"class="pull-right important" action="/apagarnotificaacao" method="POST" style="display:inline-block !important">
                {{ csrf_field() }}
                <button  id="delete-icon"onClick="this.form.submit()" class=""name="id"  value={{$notificacoes->pk_notificacao}}>
                    <i class="	glyphicon glyphicon-remove"></i></label>
                    
                </button>
                </form>
          </td>

       

        </tr>
        @endforeach
      </tbody></table>
    </div>

  @else
      Sem notificacoes

  @endif
</div>
<div class="tab-pane" id="ausencias">
  

                <div class="row">
                  <div class="col-md-12" >
                      <table id="example" class="table table-striped table-bordered" style="width:100%" >
                          <thead >
                           
  
                                 
                                <th >Estado</th>                
                                <th >Colaborador</th>
                                <th >Descrição</th>
                            
                            <th >Inicio</th>
                            <th >Fim</th>
                            
                          </thead>
                          <tbody>
                            @foreach ($ausencias as $ausencias)

                  <tr>
                        @if ($ausencias->estado==1)
                        <td class=text-center><span class="label label-success">Aprovado</span></td> 
                        @elseif($ausencias->estado==0)
                    <td class=text-center><span class="label label-warning">Pendente</span></td> 
                            @elseif($ausencias->estado==2)
                    <td class=text-center><span class="label label-danger">Reprovado</span></td> 
                        @endif
                      <td>{{DB::connection('geraltg')->table('userscomuns')->where('BI',$ausencias->biuser)->value('nome')}}</td>
                <td>{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencias->fk_justificacao)->value('descricao')}}</td>
                <td >{{$ausencias->start}}</td>
                <td >{{$ausencias->end}}</td>
                </tr>
                  
                @endforeach
                       
                      </tbody>
                      </table>
                </div>
                </div>
                <div class="row" align="center">
                    <div class="col-xs-12 col-sm-12 col-md-4" >
                        <a href="{{url('/')}}/marcarausenciapropria" ><button type="button" class="btn btn-block btn-success btn-flat">
                            Criar Ausência</button></a>
                        </div>
                </div><br><br>
               
         
         

      </div>
      <div class="tab-pane" id="projeto">
  

        <div class="row">
          <div class="col-md-12">
              <table id="example2" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>

                          <th class="text-center">Código Projeto</th>
                          <th class="text-center">Estado</th>
                          <th class="text-center">Área</th>
                          <th class="text-center">Cliente</th>
                          <th class="text-center">Nome Projeto</th>
                          <th class="text-center">Custos Previstos</th>
                          <th class="text-center">Custos Reais</th>
                          <th class="text-center">Responsável</th>
                          <th class="text-center">Departamentos</th>
                          <th class="text-center">Prazos</th>
                          <th class="text-center">Gerir</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach ($projeto as $projeto)

                  <div class="hidden">
                          {{$pois=DB::table('projdeps')->where('fk_projeto',$projeto->pk_projeto)->get()}}
                  </div>
                 
                  @if ($projeto->fk_estadoproj == 1)
                     
                      <tr id="tr"  class="{{$teste = 'success'}}">
                  @elseif($projeto->fk_estadoproj == 2)
                  
                      <tr id="tr"  class="{{$teste = 'warning'}}">

                  @elseif($projeto->fk_estadoproj == 3)
                       <tr id="tr"  class="{{$teste = 'info'}}">
                  @elseif($projeto->fk_estadoproj == 4)
                       <tr id="tr"  class="{{$teste = 'danger'}}">
                     
                  @endif
                      {{-- dados da tabela --}}
                      <td class="text-justify">{{$projeto->codProj}}</td>
                      <td class="text-justify">{{DB::table('estadoprojetos')->where('pk_estadoprojeto',$projeto->fk_estadoproj)->value('descricaoEstado')}}</td>
                      <td class="text-justify">{{DB::table('areas')->where('pk_area',$projeto->fk_areaProj)->value('projArea')}}</td>

                      <td class="text-justify">{{DB::table('clientes')->where('pk_cliente',$projeto->fk_cliente)->value('nomeAbreviado')}}</td>
                      <td class="text-justify">{{$projeto->nomeProjeto}}</td>
                      <td class="text-justify">{{$projeto->custoPrevisto}}€</td>
                      <td class="text-justify">
                          @if ($projeto->custoReal==null)
                              -- €
                          @else
                          {{$projeto->custoReal}}€</td>
                          @endif
                      
                      <td class="text-justify">{{DB::table('users')->where('id',$projeto->fk_responsavel)->value('sigla')}}</td>
                      <td class="text-justify">@foreach ($pois as $a)
                           {{DB::table('departamentos')->where('pk_departamento',$a->fk_departamento)->value('abreviatura')}} <br> 
                      @endforeach</td>

                      <td class="text-justify">Data Prevista Início:
                              @if ($projeto->dataPrevistaInicio==null)
                               ---- -- --
                              @else
                              {{$projeto->dataPrevistaInicio}} 
                              @endif
                               <br>Data Início: 
                               @if ($projeto->dataInicio==null)
                                   ---- -- --
                               @else
                               {{$projeto->dataInicio}}
                               @endif
                               <br> Data Prevista Fim:
                               @if ($projeto->dataPrevistaFim==null)
                               ---- -- --
                               @else
                               {{$projeto->dataPrevistaFim}}
                               @endif
                              <br>Data Fim: 
                              @if ($projeto->dataFim==null)
                              ---- -- --
                              @else
                              {{$projeto->dataFim}}
                              @endif
                          </td>
                     
                      <td>  {{--opçoes de gestão de clientes--}}
                          <div class="text-center">
                           @if ($projeto->fk_estadoproj==2 and $projeto->fk_responsavel==auth::id())
                           <a href="startprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm far fa-play-circle" title="Iniciar Projeto"></a>

                           @elseif(($projeto->fk_estadoproj==1 || $projeto->fk_estadoproj==3 )  and $projeto->fk_responsavel==auth::id())
                           <a href="stopprojeto/{{$projeto->pk_projeto}}" class="btn btn-danger btn-sm far fa-stop-circle" title="Finalizar Projeto"></a>
                           @elseif($projeto->fk_estadoproj==4  and $projeto->fk_responsavel==auth::id())
                           <a href="restartprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-sm fas fa-redo" title="Reabrir Projeto"></a>

                           @endif
                          <br>
                              <a href="verprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm far fa-eye" title="Ver Projeto"></a>
                          <br>@if ( $projeto->fk_responsavel==auth::id())
                          <a href="editarprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Projeto"></a> {{--Editar recurso--}}

                          @endif
                       
                          </div>
                      </td>
                  </tr>
              @endforeach
              </tbody>
              </table>
              {{-- <a href="novoprojeto" class="btn btn-success btn-sm far fa-edit" title="criar projeto">Criar projeto</a> Editar recurso --}}
              <div class="row" align="center">
                      <div class="col-xs-12 col-sm-12 col-md-4" >
              
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-2" >
                                  <a href="{{url('/')}}/novoprojeto" ><button type="button" class="btn btn-block btn-success btn-flat">
                                          Criar Projeto</button></a>
                              </div>

                                  <div class="col-xs-12 col-sm-12 col-md-2" >
                                          <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                  Voltar</button></a>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-4" >
              
                          </div>
              </div>
       <br><br>
 
 

</div>
  </div>
</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-12">

          <!-- Profile Image -->
          <div class="box box-success">
            <div class="box-body box-profile">
                <script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>
                <img class="profile-user-img img-responsive img-circle  zoomable"  src="{{asset($user->foto)}}" alt="User profile picture">

            <h3 class="profile-username text-center">{{$user->nomeCompleto}}</h3>

            <p class="text-muted text-center">{{$cargo}}</p>

            <ul class="list-group list-group-unbordered">
             
                <li class="list-group-item">
                <b>Email Prof</b> <a class="pull-right">{{$user->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email Pessoal</b> <a class="pull-right">{{$user->emailPessoal}}</a>
                </li>
                <li class="list-group-item">
                    <b>NIF</b> <a class="pull-right">{{$user->nif}}</a>
                  </li>
                  <li class="list-group-item">
                  <b>Contacto Profissional</b> <a class="pull-right">{{$user->contactoProfissional}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Contacto Pessoal</b> <a class="pull-right">{{$user->contactoPessoal}}</a>
                  </li>
              </ul>
@if ($user->id!=auth::id())
<a href="/editaruser/{{$user->id}}" class="btn btn-success btn-block"><b>Editar Informações</b></a><br>
@else
<a href="/editaruser/{{$user->id}}" class="btn btn-success btn-block disabled"><b>Editar Informações (contactar RH)</b></a><br>
@endif
           
              {{-- <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Tarefas Incluido</b> <a class="pull-right">Count das tarefas</a>
                  </li>
                  <li class="list-group-item">
                    <b>Projetos Concluidos</b> <a class="pull-right">Count</a>
                  </li>
                  <li class="list-group-item">
                      <b>Etapas Conc </b> <a class="pull-right">Count das tarefas</a>
                    </li>
  
                </ul> --}}
                <br>
            </div>
            <!-- /.box-body -->
          </div>   
          <!-- /.box -->
        </div>   
        <!-- /.col -->
        <div class="col-md-8 col-xs-12">

          <!-- Profile Image -->
          <div class="box box-success">
            <div class="box-body box-profile">
              <br>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                        <h3>{{$totalsemanal}}  de {{$totalPrevisto}}</h3>
            
                        <p>Horas</p>
                        </div>
                        <div class="icon">
                          <i class="far fa-clock"></i>
                        </div>
                        <a  class="small-box-footer">
                          Total Semana <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>@if ($saldohoras>0)
                             -  {{gmdate("H:i:s", $saldohoras)}}<sup style="font-size: 20px">h</sup></h3>
                          @else
                          {{gmdate("H:i:s", 0)}}<sup style="font-size: 20px">h</sup></h3>
                          @endif
                            
                           
            
                          <p>Saldo Horas</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a  class="small-box-footer">
                          Horas a compensar <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                      
                        <div class="inner">
                          <div class="row" style="text-align:center !important;">

                        
                          <div class="col-lg-4 col-xs-4">
                          <h3>{{$userscomuns[0]->anoAnt}}</h3>
            
                          <p>Dias {{Carbon\Carbon::now()->subYear()->format('Y')}}</p>
                        </div>

                        <div class="col-lg-4 col-xs-4">
                          <h3>{{$userscomuns[0]->ano}}</h3>
            
                          <p>Dias {{Carbon\Carbon::now()->format('Y')}}</p>
                        </div>
                        <div class="col-lg-4 col-xs-4">
                          <h3>{{$userscomuns[0]->anoProx}}</h3>
            
                          <p>Dias {{Carbon\Carbon::now()->addYear()->format('Y')}}</p>
                        </div>
                      </div>
                       </div>
                          <div class="icon">
                          <i class="fas fa-umbrella-beach"></i>
                        </div>
                      <a href="/feriascolaborador/{{$user->id}}" class="small-box-footer">
                          Dias Disponíveis de Férias<i class="fa fa-arrow-circle-right"></i>
                        </a>
                     
                    </div>
                        
                    </div>
                    
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>xx</h3>
            
                          <p>A Determinar</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>xx</h3>
            
                          <p>A Determinar</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>xx</h3>
            
                          <p>A Determinar</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
            </div>
            <!-- /.box-body -->
          </div>   
          <!-- /.box -->
        </div> 
      </div>
 
    </section>
    <!-- /.content -->
    <div class="row">
    </div> 
        <script>
  //          $('#example').css( 'display', 'block' );
  // $('#example').DataTable().columns.adjust().draw();
  var table = $('#example').DataTable();
table.columns.adjust().draw();
         </script>
        <script>
            $(document).ready(function() {
            /**
             * for showing edit item popup
             */
          
            $(document).on('click', "#edit-item", function() {
              $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
          
              var options = {
                'backdrop': 'static'
              };
              $('#edit-modal').modal(options)
            })
          
            // on modal show
            $('#edit-modal').on('show.bs.modal', function() {
              var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
              var row = el.closest(".data-row");
          
              // get the data
              var id = el.data('item-id');
              var name = el.data("start_date");
              var description = row.children(".description").text();
          
              // fill the data in the input fields
              $("#modal-input-id").val(id);
              $("#modal-input-name").val(name);
              $("#modal-input-description").val(description);
          
            })
          
            // on modal hide
            $('#edit-modal').on('hide.bs.modal', function() {
              $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
              $("#edit-form").trigger("reset");
            })
          })
            </script>
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
{{-- script necessário para popup da imagem --}}
<script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>
@stop