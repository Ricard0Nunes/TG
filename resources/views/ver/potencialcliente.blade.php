@extends('adminlte::page')
@section('Potencial Cliente', 'Ver Potencial Cliente')
@section('content')
  <style>
    #tabs.active{
      border-top:3px solid #00a65a !important;
    }
  </style>
  <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js
  
  
  
  "></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
  </script>
   <script>
    $(document).ready(function() {
      $('#example3').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
  </script>
  <section class="content-header">
    <h1>Perfil de Potencial Cliente</h1>
  </section>
  <section class="content">
    <div class="box box-success">
      <div class="box-body box-profile">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <h3 class="profile-username text-center">{{$potencialcliente->nomeCompleto}} - ({{$potencialcliente->nomeAbreviado}})</h3>
          </div>
          <div class="col-md-8 col-sm-12">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Email Prof</b> <a class="pull-right">   {{$potencialcliente->email}} </a>
              </li>
              <li class="list-group-item">
                <b>Morada</b> <a class="pull-right"> {{$potencialcliente->morada}}</a>
              </li>
              <li class="list-group-item">
                <b>NIF</b> <a class="pull-right"> {{$potencialcliente->NIF}}</a>
              </li>
              <li class="list-group-item">
                <b>NISS</b> <a class="pull-right"> {{$potencialcliente->NISS}}</a>
              </li>
              <li class="list-group-item">
                <b>Contacto </b> <a class="pull-right"> {{$potencialcliente->contacto}}</a>
              </li>
              <li class="list-group-item">
                <b>Contacto Alternativo</b> <a class="pull-right"> {{$potencialcliente->contactoAlternativo}}</a>
              </li>
            </ul>
          </div>
        </div>    
        <div class="col-xs-12 col-sm-12 col-md-8" ></div>
        @if ($potencialcliente->convertido==0)
          {!! Form::open(array('route' => 'converter.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
            {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
            <a href="" >
              <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}>
              <button type="submit" class=" btn btn-block btn-info btn-flat" title="Converter Cliente"> Converter em Cliente
              </button>
            </a>   
          {!! Form::close()!!} 
        @endif
        <div class="col-xs-12 col-sm-12 col-md-2">
          <a href="{{url('/')}}/potencialcliente" >
            <button type="button" class="btn btn-block btn-warning btn-flat">
              Voltar
            </button>
          </a>
        </div>
      </div>   
    </div>
  </section>
        <div class="nav-tabs-custom" >
          <ul class="nav nav-tabs">
            <li id="tabs" class="active"><a href="#leads" data-toggle="tab" aria-expanded="true">Leads</a></li>
            <li id="tabs" class=""><a href="#agenda" data-toggle="tab" aria-expanded="false">Agenda </a></li>
            <li id="tabs" class=""><a href="#orcamentos" data-toggle="tab" aria-expanded="false">Orçamentos </a></li>
          </ul>
          <div class="tab-content">
            <div id="leads" class="tab-pane active ">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  @if (count($leads)>0)
                    @foreach ($leads as $leads)
                      <div class="row">
                        <div class="col-md-12 col-xs-12">
                          @if ($leads->pk_lead==$lead)
                            <h2>
                              <b>Lead:</b>{{$leads->objetivo}}
                              <button class="btn btn-success">
                                <i class="fa  fa-check"></i>
                              </button>
                            </h2> 
                          @else
                            <h2>
                              <b>Lead: </b>{{$leads->objetivo}}
                            </h2>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 col-xs-12">
                          <h4>
                            <b>Data de Início: </b>
                          </h4>
                          {{$leads->inicio}}
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <h4>
                            <b>Data de Fim: </b>
                          </h4>
                          {{$leads->fim}}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-xs-12">
                          <h4>
                            <b>Notas: </b>
                          </h4>
                          {{$leads->notas}}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 col-xs-12">
                          <h4>
                            <b>Responsável: </b>
                          </h4>
                          {{DB::table('users')->where('id',$leads->fk_responsavel)->value('name')}}
                        </div>
                        <div class="col-md-6 col-xs-12">
                          {!! Form::open(array('route' => 'contactos.lead','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                            {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                              <a href="" >
                                <input id="aaa" name="pk_lead" type="hidden" value={{$leads->pk_lead}}>
                                <input id="aaa" name="fk_potencialcliente" type="hidden" value={{$potencialcliente->pk_potencialCliente}}>
                                @if ($leads->pk_lead==$lead)
                                  <button type="submit" class="fas fa-eye-alt btn btn-primary" title="Ver contactos" disabled> Ver contactos
                                  </button>
                                @else
                                  <button type="submit" class="fas fa-eye-alt btn btn-primary" title="Ver contactos"> Ver contactos
                                  </button>
                                @endif
                              </a>  
                          {!! Form::close()!!} 
                        </div>
                      </div>
                      <hr>
                    @endforeach
                  @else
                    Sem leads Para o contacto
                  @endif
                  <div class="modal fade" id="edit-modal" tabindex="" role="dialog" aria-labelledby="edit-modal-label" >
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-body" id="attachment-body-content">
                          {!! Form::open(array('route' => 'store.contactosComClientespot','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="card text-white bg-dark mb-0">
                              <div class="card-header">
                                <h2 class="m-0">Adicionar Contacto Com Cliente</h2>
                              </div>
                              <div class="card-body">
                                <div class="form-group">
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-md-4 col-xs-12">
                                        <label class="col-form-label" for="modal-input-name">Data do Contacto(*)</label>
                                        <input type="datetime-local" name="dataContacto" class="form-control" id="modal-input-name" required autofocus>
                                      </div>
                                      <div class="col-md-4 col-xs-12">
                                        <label class="col-form-label" for="modal-input-name">Próximo Contacto</label>
                                        <input type="datetime-local" name="proximoContacto" class="form-control" id="modal-input-name"  autofocus>
                                        <input id="invisible_id"  name="fk_potencialcliente" type="hidden" value="{{$potencialcliente->pk_potencialCliente}}">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8 col-xs-12">
                                        <label class="col-form-label" for="modal-input-name">Mensagem(*)</label>
                                        <input type="text" rows="4" cols="50" name="mensagem" class="form-control" id="modal-input-name" required autofocus>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4 col-xs-12">
                                        <label class="col-form-label" for="modal-input-name">Parecer(*)</label>
                                        <select name="parecer" class="form-control" id="modal-input-name" required autofocus>
                                          <option value="">Escolha o parecer</option>
                                          <option value="Positivo">Positivo</option>
                                          <option value="Cliente ficou de pensar">Cliente ficou de pensar</option>
                                          <option value="Cliente aguarda proposta">Cliente aguarda proposta</option>
                                          <option value="Desistência">Desistência</option>
                                        </select>
                                      </div>
                                      <div class="col-md-4 col-xs-12">
                                        <label class="col-form-label" for="modal-input-name">Tipo de Contacto(*)</label>
                                        <select name="fk_tipo_contacto" class="form-control" id="modal-input-name" required autofocus>
                                          <option value="">Escolha o tipo de contacto</option>
                                          @foreach ($contacto as $h)
                                            <option value="{{$h->pk_tipo_contacto}}">{{$h->tipoContacto}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a href="" >
                              <button type="submit" class="btn btn-block btn-success btn-flat">
                                <input id="aaa" name="lead" type="hidden" value={{$lead}}> 
                                Adicionar
                              </button>
                            </a>
                          {!! Form::close()!!}  
                        </div>
                      </div>
                    </div>
                  </div> 
                  {!! Form::open(array('route' => 'lead.create','method'=>'POST','class'=>'pull-right','files'=>'true','style'=>'display:inline-block')) !!}
                    {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                      <a href="" > 
                        <input id="aaa" name="lead" type="hidden" value={{$lead}}> 
                        <input id="invisible_id"  name="fk_potencialcliente" type="hidden" value="{{$potencialcliente->pk_potencialCliente}}">
                        <button type="submit" class="fas fa-bookmark  btn btn-success pull-right"> Nova lead
                        </button>
                      </a> 
                  {!! Form::close()!!}
                </div>   
                <div class="col-md-6 col-xs-12">
                  <ul class="timeline">
                    @if ($lead>0)
                      <li class="time-label">
                        <span class="bg-green">
                          Contactos com o Cliente
                        </span>
                      </li>
                      @if (count($contactolead)>0)
                        @foreach ($contactolead as $contactolead)
                          <li>
                            @if ($contactolead->fk_tipo_contacto==1)
                              <i class="fa fa-at "></i>
                            @elseif($contactolead->fk_tipo_contacto==2)
                              <i class="fa fa-phone "></i>
                            @else
                              <i class="fa fa-users "></i>
                            @endif
                            <div class="timeline-item">
                              <span class="time">{{$contactolead->dataContacto}}</span>
                              <h3 class="timeline-header">
                                <a href="#">
                                  <img src= {{$contactolead->foto}}  class="img-circle img-sm" alt="User Image">
                                  ({{$contactolead->sigla}}) {{$contactolead->name}}
                                </a>
                              </h3>
                              <div class="timeline-body">
                                <h3 class="timeline-header"></h3>
                                {{$contactolead->mensagem}}                                                          
                              </div>
                              <div class="timeline-footer">
                                Parecer <a class="btn btn-primary btn-xs">{{$contactolead->parecer}}</a>
                                Próximo Contacto 
                                @if ($contactolead->proximoContacto=='0000-00-00 00:00:00')
                                  <strong> N.A.</strong>
                                @else
                                  <a class="btn btn-danger btn-xs">{{$contactolead->proximoContacto}}</a>  
                                @endif
                                {!! Form::open(array('route' => 'contactocomcliente.apagar','method'=>'POST','class'=>'pull-right','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                    <a href="" >
                                      <input id="aaa" name="id" type="hidden" value={{$contactolead->pk_contactoscomclientes}}>
                                      <input id="aaa" name="lead" type="hidden" value={{$lead}}> 
                                      <input id="invisible_id"  name="fk_potencialcliente" type="hidden" value="{{$potencialcliente->pk_potencialCliente}}">
                                      <button type="submit" class="fas fa-trash-alt btn-sm btn-danger pull-right">
                                      </button>
                                    </a> 
                                {!! Form::close()!!}
                              </div>
                            </div>
                          </li>
                        @endforeach
                      @else
                        <li>
                          <i class=""></i>
                          <div class="timeline-item">
                            Sem contactos na lead
                          </div>
                        </li>
                      @endif
                    @endif
                  </ul>
                  <button type="button"  id="edit-item"class="btn btn-success pull-right" style="display:inline-block">
                    <i class="fa fa-plus"> </i> Adicionar Contacto
                  </button>
                </div>
              </div>
            </div> 
            <div class="modal fade" id="theModal-2" tabindex="" role="dialog"style="z-index:9999999;" aria-labelledby="edit-modal-label" >
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-body" id="attachment-body-content">
                    {!! Form::open(array('route' => 'adicionar.agendapotencialcliente','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="card text-white bg-dark mb-0">
                        <div class="card-header">
                          <h2 class="m-0">Adicionar Contacto</h2>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <div class="container">
                              <div class="row">
                                <div class="col-md-4 col-xs-12">
                                  <label class="col-form-label" for="modal-input-name">Função</label>
                                  <input type="text" name="funcao" class="form-control" id="modal-input-name" required autofocus>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                  <label class="col-form-label" for="modal-input-name">Nome</label>
                                  <input type="text" name="nome" class="form-control" id="modal-input-name" required autofocus>
                                  <input id="invisible_id"  name="fk_cliente" type="hidden" value="">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-xs-12">
                                  <label class="col-form-label" for="modal-input-name">Contacto</label>
                                  <input type="text" name="contacto1" class="form-control" id="modal-input-name" required autofocus>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                  <label class="col-form-label" for="modal-input-name">Contacto Alternativo</label>
                                  <input type="text" name="contacto2" class="form-control" id="modal-input-name"  autofocus>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-xs-12">
                                  <label class="col-form-label" for="modal-input-name">Email</label>
                                  <input type="text" name="email" class="form-control" id="modal-input-name" required autofocus>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="" >
                        <button type="submit" class="btn btn-block btn-success btn-flat">
                          <input id="aaa" name="lead" type="hidden" value={{$lead}}> 
                          <input id="aaa" name="fk_potencialcliente" type="hidden" value={{$potencialcliente->pk_potencialCliente}}> 
                          Adicionar
                        </button>
                      </a>
                    {!! Form::close()!!}  
                  </div>
                </div>
              </div>
            </div>  
            <div id="agenda" class="tab-pane">                    
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">Função</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Contacto</th>
                    <th class="text-center">Contacto Alternativo</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Gerir</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($agenda as $agenda)
                    <tr id="tr" >
                      <td class="text-center">{{$agenda->funcao}}</td>
                      <td class="text-center">{{$agenda->nome}}</td>
                      <td class="text-center">{{$agenda->contacto1}}</td>
                      <td class="text-center">{{$agenda->contacto2}}</td>
                      <td class="text-center">{{$agenda->email}}</td>
                      <td>
                        <div class="text-center">
                          <a href="editarcontatocomcliente/{{$agenda->pk_contacto}}" class="btn btn-warning btn-sm far fa-edit" title="Editar clientes"></a> 
                            {!! Form::open(array('route' => 'contactocomclientec.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                <a href="" >
                                  <input id="aaa" name="id" type="hidden" value={{$agenda->pk_contacto}}>
                                  <button type="submit" class="fas fa-trash-alt btn btn-danger">
                                  </button>
                                </a> 
                            {!! Form::close()!!}  
                          </a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="#" data-target="#theModal-2" data-toggle="modal">
                    <button type="button" class="btn btn-block btn-success btn-flat">
                      Adicionar Contacto
                    </button>
                  </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="{{ URL::previous() }}" >
                    <button type="button" class="btn btn-block btn-warning btn-flat">
                      Voltar
                    </button>
                  </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4" >
                </div>
              </div>
            </div>
            <div id="orcamentos" class="tab-pane fade ">

              <table id="example3" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
          
                        <th class="text-center">Nº Orçamento</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Data da Proposta</th>
                        <th class="text-center">Data Envio da Proposta</th>
                        <th class="text-center">Data de Adjudicação</th>
                        <th class="text-center">Data de Validade</th>
                        <th class="text-center">Adjudicado</th>
                        <th class="text-center">Valor s/IVA</th>
                        <th class="text-center">Valor c/IVA</th>
                        <th class="text-center">Gerir</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($orcamentos as $orcamentos)
                    <tr id="tr" >
                       
                    <td class="text-center">{{$orcamentos->numeroOrcamento}}</td>
                        <td class="text-center">{{App\orc_Tipo::where('pk_orcTipo',$orcamentos->fk_tipo)->value('tipoOrcamento')}}</td>
                        <td class="text-center"> 
                          @if ($orcamentos->fk_estado==1)
                          <span class="label label-primary">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamentos->fk_estado)->value('estado')}}</span>
                           @elseif ($orcamentos->fk_estado==2)
                          <span class="label label-warning">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamentos->fk_estado)->value('estado')}}</span>
                           @elseif ($orcamentos->fk_estado==3)
                           <span class="label label-success">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamentos->fk_estado)->value('estado')}}</span>
                           @else
                           <span class="label label-danger">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamentos->fk_estado)->value('estado')}}</span>
           
                           @endif
                        </td>
                        <td class="text-center">{{$orcamentos->dataProposta}}</td>
                        <td class="text-center">{{$orcamentos->dataEnvioProposta}}</td>
                        <td class="text-center">{{$orcamentos->dataAdjudicacao}}</td>
                        <td class="text-center">{{$orcamentos->dataValidade}}</td>
                        <td class="text-center">{{$orcamentos->adjudicado}}</td>
                        <td class="text-center">{{$orcamentos->valorSemIva}}</td>
                        <td class="text-center">{{$orcamentos->valorComIva}}</td>        
                        <td>
                          <div class="text-center">
                            <a href="{{url('/')}}/verprojeto/" class="btn btn-success btn-sm far fa-eye" title="Ver Orçamento"></a>
                          </div>
                        </td>
                      </tr>
          @endforeach
                </tbody>
              </table>
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

                                @stop