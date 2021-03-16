@extends('adminlte::master')
@section('adminlte_css')
    <link rel="stylesheet"href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} "> 
    @stack('css')
    @yield('css')
    <style>
      @media screen and (max-width: 1000px) {
        #tele {
          display: none;
        }
      }
    </style>
@stop
@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? ['boxed' => 'layout-boxed','fixed' => 'fixed','top-nav' => 'layout-top-nav'][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))
@section('body')
  <div class="wrapper">
    <div class="hidden">
      {{ $now= Carbon\Carbon::parse('00:00:00')->diffInSeconds(Carbon\Carbon::now())}}
      {{$data =Carbon\Carbon::now()->formatLocalized('%A  %d  %B   %Y')}}
      {{--  --}}
    </div>
    <header class="main-header">
      @if(config('adminlte.layout') == 'top-nav')
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
              </a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
              </ul>
            </div>
      @else         
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
              <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
              <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
              <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
                <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
              </a>
      @endif
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class=""id="tele" style="padding:15px; color:white">
                  <span>
                    <a  id="relogio" style="color:inherit"></a> - {{$data}}
                  </span>
                </li>           
                <li class="dropdown messages-menu" id="refresh">
                  <div class="hidden">
                    {{$a=0}}
                    {{$notifica=0}}
                    {{ $msg=DB::table('mensagens')->leftjoin('caixa_entradas','pk_caixaEntrada','mensagens.caixa')->where('destinatario',auth::id())->orWhere('proprietario',auth::id())->orderBy('mensagens.created_at','DESC')->get(['mensagens.pk_mensagem','mensagens.remetente','mensagens.mensagem','mensagens.lido','mensagens.created_at'])}}    
                    {{$tasks=DB::table('tasks')->where('tipo',2)->where('fk_tecnico',Auth::id())->whereIN('fk_estadoIntervencao',array(1,4,5))->where ('start_date','like', date('Y-m-d').'%')->orderBy('start_date')->get()}}
                    {{$notificacoes=DB::table('notificacoes')->where('fk_user',Auth::id())->where('lida',0)->orderBy('fk_tipoNotificacao')->get()}}
                    {{$todolist=DB::table('todo_lists')->where('fk_user',auth::id())->get()}}
                  
                  @for ($i = 0; $i < count($msg); $i++)
                    @if ($msg[$i]->remetente != auth::id() and $msg[$i]->lido==0)
                      {{$a++}}
                      @if ((carbon\carbon::parse($msg[$i]->created_at)->diffInSeconds(carbon\carbon::now()))<90)
                        {{$notifica=1}}
                      @endif
                    @endif
                  @endfor
                  @for ($t = 0; $t < count($tasks); $t++)
                    @if ((carbon\carbon::parse($tasks[$t]->created_at)->diffInSeconds(carbon\carbon::now()))<90)
                      {{$notifica=1}}
                    @endif
                  @endfor
                  @for ($n = 0; $n < count($notificacoes); $n++)
                    @if ((carbon\carbon::parse($notificacoes[$n]->created_at)->diffInSeconds(carbon\carbon::now()))<90)
                      {{$notifica=1}}
                    @endif
                  @endfor
                </div>

                  
                  @if ($notifica==1)
                    <audio id="myAudio"  onload="playAudio()"src="{{url('/notificacao.mp3')}}" autoplay ></audio>
                  @endif
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-envelope"></i> 
                    @if ($a>0)
                      <span  class="label label-success" style="background-color:#307a25 !important" >{{$a}}</span> 
                    @endif
                  </a> 
                  <ul class="dropdown-menu">
                    @if ($a<2)
                      <li class="header">Tem {{$a}} mensagem não lida.</li>
                    @else
                      <li class="header">Tem {{$a}} mensagens não lidas.</li>
                    @endif
                    <li>
                      <ul class="menu">
                        @for ($i = 0; $i < count($msg); $i++)
                          <li>
                            @if ($msg[$i]->remetente != auth::id() and $msg[$i]->lido==0)
                              <a href="{{url('/').'/chat'}}">
                                <div class="pull-left">
                                  <img src="{{asset(DB::table('users')->where('id',$msg[$i]->remetente)->value('foto'))}}" class="img-circle" alt="User Image"> 
                                  
                                </div>
                                <h4>
                                  {{DB::table('users')->where('id',$msg[$i]->remetente)->value('name')}}
                                  ({{DB::table('users')->where('id',$msg[$i]->remetente)->value('sigla')}})
                                  <div class="hidden">
                                    {{$tempo =Carbon\Carbon::parse($msg[$i]->created_at)->diffInSeconds(Carbon\Carbon::now())}}
                                    {{$min = intval($tempo)}} 
                                    @if ($min >60*60)
                                      {{ $env= gmdate("H:i",$min) . ' h atrás'}}
                                    @else
                                      {{ $env= gmdate("i",$min) . ' min atrás'}}
                                    @endif
                                  </div>
                                  <small>
                                    <i class="fa fa-clock"></i>  {{$env}}
                                  </small>
                                </h4>
                                <p>
                                  {{$msg[$i]->mensagem}}
                                </p>
                              </a>
                              @endif
                          </li>
                        @endfor
                      </ul>
                    </li>
                    <li class="footer">
                      <a href={{url('/').'/chat'}}>
                        Ver Todas
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown tasks-menu "id="refresh1">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fab fa-font-awesome-flag"></i>
                    @if (count($tasks)>0)
                      <span class="label label-danger">{{count($tasks)}}</span>
                    @endif
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Tem {{count($tasks)}} tarefas agendadas para o dia de hoje.</li>
                    <li>
                      <ul class="menu">
                        @if (count($tasks)==0)
                          <li>
                            <p>Sem tarefas para hoje</p>
                          </li> 
                        @else
                          @foreach ($tasks as $tasks)
                            <li id="li">
                              <div class="row">
                                <div class="col-xs-12 col-md-7 text-justify">
                                  @if(strlen($tasks->text)>22)
                                    <i class="fab fa-font-awesome-flag text-aqua"></i>  {{substr($tasks->text, 0, 22).' '.'...'}}
                                  @else
                                    <i class="fab fa-font-awesome-flag text-aqua"></i>   {{$tasks->text}}
                                  @endif
                                  <br>
                                  {{$tasks->start_date}} 
                                </div>
                                <style>#li:nth-child(odd) {background-color: #f4f4f4;}</style>
                                <div class="col-xs-12 col-md-5 text-center">
                                  <span style=" display: inline;">
                                    {!! Form::open(array('route' => 'tarefa.iniciar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                        <a href="" >
                                          <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                          <button type="submit" class="btn-xs btn-success fas fa-play"></button>
                                        </a> 
                                    {!! Form::close()!!}
                                    {!! Form::open(array('route' => 'tarefa.prereagendar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                        <a href="" >
                                          <input id="aaa" name="id" type="hidden" value={{$tasks->id}}>
                                          <button type="submit" class="btn-xs btn-success fas fa-sync-alt"></button>
                                        </a> 
                                    {!! Form::close()!!}      
                                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                        <a href="{{$tasks->id}}" >
                                          <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                          <button type="submit" class="btn-xs btn-success fas fa-eye">
                                          </button>
                                        </a> 
                                    {!! Form::close()!!}
                                  </span>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </li>
                    <li class="footer">
                      <a href="{{url('/').'/registo?kanban'}}">Ver todas</a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown notifications-menu " id="refresh2">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="far fa-bell"></i>
                    @if (count($notificacoes)>0)
                      <span class="label label-warning">{{count($notificacoes)}}</span>
                    @endif
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Tem {{count($notificacoes)}} notificações. </li>
                    <li>
                      <ul class="menu">
                        @if (count($notificacoes)==0)
                          <li>
                            <p>Sem notificacoes</p>
                          </li> 
                        @else
                          @foreach ($notificacoes as $notificacoes)
                            <ul class="menu">
                              <li>
                                @if ($notificacoes->fk_tipoNotificacao==3)
                                  @if (auth()->user()->fk_departamento==3)
                                    <a href="{{url('/').'/mostrarausencias'}}">
                                  @else
                                    <a href="{{url('/').'/perfil?notificacoes'}}">
                                  @endif
                                  <i class="fas fa-running text-aqua"></i>
                                @elseif($notificacoes->fk_tipoNotificacao==2)
                                  @if (auth()->user()->fk_departamento==3)
                                    <a href="{{url('/').'/aprovarpontos'}}">
                                  @else
                                    <a href="{{url('/').'/perfil?notificacoes'}}">
                                  @endif
                                  <i class="fas fa-running text-aqua"></i>
                                  @elseif($notificacoes->fk_tipoNotificacao==6)
                                
                                    <a href="{{url('/').'/correspondencias'}}">
                                
                                  <i class="fas fa-mail-bulk  text-aqua"></i>
                                  @elseif($notificacoes->fk_tipoNotificacao==5)
                                
                                  <a href="{{url('/').'/requisicoescarro'}}">
                              
                                <i class="fas fa-car  text-aqua"></i>
                                @elseif($notificacoes->fk_tipoNotificacao==4)
                                
                                <a href="{{url('/').'/perfil?kanban'}}">
                                
                              <i class="fas fa-tasks  text-aqua"></i>
                              @elseif($notificacoes->fk_tipoNotificacao==7)
                                
                              <a href="{{url('/').'/minhaformacao'}}">
                          
                            <i class="fas  fa-check  text-aqua"></i>
                                @elseif($notificacoes->fk_tipoNotificacao==9)
                                  <a href="{{url('/').'/perfil?notificacoes'}}">
                                  <small class="label label-danger pull-right"><i class="fa fa-clock-o"></i> Normal</small>
                                @else
                                  <small class="label label-info pull-right"><i class="fa fa-clock-o"></i> Informativo</small>
                                @endif
                                @if(strlen($notificacoes->descricao)>100)
                                  {{substr($notificacoes->descricao, 0, 22).' '.'...'}}
                                @else
                                  {{$notificacoes->descricao}}
                                @endif
                                </a>
                              </li>
                            </ul>
                          @endforeach
                        @endif
                      </ul>
                    </li>
                    <li class="footer">
                      <a href="{{url('/').'/perfil?notificacoes'}}">Ver Todas</a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown notifications-menu " id="refresh3">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="fas fa-list-ul"></i>
                    @if (count(DB::table('todo_lists')->where('feito',0)->where('fk_user',auth::id())->get())>0)
                      <span class="label label-info">{{count(DB::table('todo_lists')->where('feito',0)->where('fk_user',auth::id())->get())}}</span>
                    @endif
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">Tem {{count($todolist)}} notas!</li>
                    <li>
                      <ul class="menu">
                        @if (count($todolist)==0)
                          <li>
                            <p>Sem notas</p>
                          </li> 
                        @else
                          @foreach ($todolist as $list)
                            <li>
                              <a href="{{url('/').'/perfil?notas'}}">
                              @if ($list->feito==0)
                                @if(strlen($list->descricao)>22)
                                  <i class="fa fa-users text-aqua"></i>  {{substr($list->descricao, 0, 22).' '.'...'}}
                                @else
                                  <i class="fa fa-users text-aqua"></i>   {{$list->descricao}}
                                @endif
                                @if ($list->label==2)
                                  <small class="label label-success ">
                                    <i class="fa fa-clock-o"></i> Prioritário
                                  </small>
                                @elseif($list->label==1)
                                  <small class="label label-danger ">
                                    <i class="fa fa-clock-o"></i> Normal
                                  </small>
                                @else
                                  <small class="label label-info ">
                                    <i class="fa fa-clock-o"></i> Informativo
                                  </small>
                                @endif 
                                <form id="form"class="pull-right important" action="/apagartodo" method="POST" style="display:inline-block !important">
                                  {{ csrf_field() }}
                                  <button  id="delete-icon"onClick="this.form.submit()" class=""name="id"  value={{$list->pk_todoList}}>
                                    <i class="	glyphicon glyphicon-remove"></i>
                                  </button>
                                </form>
                              @else
                                <strike>   
                                  @if(strlen($list->descricao)>22)
                                    <i class="fa fa-users text-aqua"></i>  {{substr($list->descricao, 0, 22).' '.'...'}}
                                  @else
                                    <i class="fa fa-users text-aqua"></i>   {{$list->descricao}}
                                  @endif
                                </strike>
                                @if ($list->label==2)
                                  <small class="label label-success ">
                                    <i class="fa fa-clock-o"></i> Prioritário
                                  </small>
                                @elseif($list->label==1)
                                  <small class="label label-danger ">
                                    <i class="fa fa-clock-o"></i> Normal
                                  </small>
                                @else
                                  <small class="label label-info ">
                                    <i class="fa fa-clock-o"></i> Informativo
                                  </small>
                                  <form id="form"class="pull-right important" action="/apagartodo" method="POST" style="display:inline-block !important">
                                    {{ csrf_field() }}
                                    <button  id="delete-icon"onClick="this.form.submit()" class=""name="id"  value={{$list->pk_todoList}}>
                                      <i class="	glyphicon glyphicon-remove"></i>
                                    </button>
                                  </form>
                                @endif        
                              @endif
                              </a>
                            </li>
                          @endforeach
                        @endif
                      </ul>
                    </li>
                    <li class="footer">
                      <a href="{{url('/').'/perfil?notas'}}">Ver Todas</a>
                    </li>
                  </ul>
                </li>

                <li > <a href="{{url('/').'/faq'}}"><i class="fa fa-info-circle"></i></a></li>
                <li class="dropdown user user-menu">
                  <div class="hidden">
                    {{$cargo = DB::table('cargos')->where('pk_cargo',auth()->user()->fk_cargo)->value('descricao')}}
                    {{$empresa = DB::table('empresas')->where('pk_empresa',auth()->user()->fk_empresa)->value('nomeCompleto')}}
                    {{$empresa2 = DB::table('empresas')->where('pk_empresa',auth()->user()->fk_empresa)->value('nomeAbreviado')}}
                    {{$idUser= auth()->user()->id}}
                  </div>
                  <a href="#" >
                    <img src="{{asset(auth()->user()->foto)}}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{auth()->user()->name}}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <img src="{{asset(auth()->user()->foto)}}" class="img-circle" alt="User Image">
                      <p>
                        {{auth()->user()->name}} - {{$cargo}}
                        <small>{{$empresa}}</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="{{url('/')}}/perfil" class="btn btn-default btn-flat">Perfil</a>
                      </div>
                      <div class="pull-right">
                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                          <a class="btn btn-default btn-flat"href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                          </a>
                        @else
                          <a href="#" class="btn btn-default btn-flat"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                          </a>
                          <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                            @if(config('adminlte.logout_method'))
                              {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                          </form>
                        @endif
                      </div>
                    </li>       
                    <li>
                      @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
                        <li>
                          <a href="#" data-toggle="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif>
                            <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                          </a>
                        </li>
                      @endif
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        @if(config('adminlte.layout') == 'top-nav')
      @endif
    </header>
    @if(config('adminlte.layout') != 'top-nav')
      <aside class="main-sidebar" >
        <section class="sidebar">
          <ul class="sidebar-menu" data-widget="tree">
            @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
          </ul>
        </section>
      </aside>
    @endif
    <div class="content-wrapper">
      @if(config('adminlte.layout') == 'top-nav')
        <div class="container">
      @endif
      <section class="content-header">
        @yield('content_header')
      </section>
      <section class="content">
        @yield('content')
      </section>
      @if(config('adminlte.layout') == 'top-nav')
        </div>
      @endif
    </div>
    @hasSection('footer')
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.13
        </div>
        <strong>Copyright © 2014-2019
          <a href="https://adminlte.io">AdminLTE</a>.
        </strong> All rights reserved.
      @yield('footer')
      </footer>
      @endif
      @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
        <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
          @yield('right-sidebar')
        </aside>
        <div class="control-sidebar-bg hidden"></div>
      @endif
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versão</b> 1.0
        </div>
        Todos os direitos reservados a TurtleDestiny...
      </footer>
  </div>
@stop
@section('adminlte_js')
<script>
  var x = document.getElementById("myAudio"); 
  function playAudio() { 
    x.play(); 
  }           
  var auto_refresh = setInterval(
    function(){
      $("#refresh").load(" #refresh > *");
      $("#refresh1").load(" #refresh1 > *");
      $("#refresh2").load(" #refresh2 > *");
      $("#refresh3").load(" #refresh3 > *");
    }, 60000);
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
  $(document).ready(function() {
    /**
     * for showing edit item popup
     */
    $(document).on('click', "#edit2-item", function() {
      $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
      var options = {
        'backdrop': 'static'
      };
      $('#edit2-modal').modal(options)
    })
    // on modal show
    $('#edit2-modal').on('show.bs.modal', function() {
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
    $('#edit2-modal').on('hide.bs.modal', function() {
      $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
      $("#edit2-form").trigger("reset");
    })
  })
</script>
<script>
  var indice = JSON.parse("{{ json_encode($now) }}");
  var  raio = document.getElementById("relogio");
  window.setInterval(function(){
    raio.innerHTML = new Date(indice * 1000).toISOString().substr(11, 8);
    indice++;
  },1000);
</script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
@stop
