

                                @extends('adminlte::page')

                                @section('Clientes', 'Ver Clientes')
                                
                                
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
    $(document).ready(function() {
    $('#example2').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
    $(document).ready(function() {
    $('#example3').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
</script>
              
                                    <!-- Content Header (Page header) -->
                                    <section class="content-header">
                                      <h1>
                                        Perfil de Cliente
                                        @if ($cliente->RGPD==1)
                                         - RGPD ATIVO
                                        @endif
                                      </h1>
                                    
                                   
                                    </section>
                                
                                    
                 
                 
                                    
                                    <!-- Main content -->
                                    <section class="content">
                                
                                   
                                          <!-- Profile Image -->
                                          <div class="box box-success">
                                            <div class="box-body box-profile">
                                          
                                    <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                <script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>
                                                <img class=" zoomable" width="100%" src="{{asset($cliente->logo)}}" alt="User profile picture"><br>
                                                <h3 class="profile-username text-center">  {{$cliente->nomeCompleto}} - ({{$cliente->nomeAbreviado}})</h3>
                                
                                                {{-- <p class="text-muted text-center">     {{DB::table('empresas')->where('pk_empresa', '=', $cliente->fk_empresa)->value('nomeCompleto')}}</p> --}}
                                    
                                                </div>
                                                <div class="col-md-8 col-sm-12">
                                          
                                            <ul class="list-group list-group-unbordered">
                                             
                                                <li class="list-group-item">
                                                  <b>Email Prof</b> <a class="pull-right">   {{$cliente->email}} </a>
                                                </li>
                                                <li class="list-group-item">
                                                  <b>Morada</b> <a class="pull-right"> {{$cliente->morada}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>NIF</b> <a class="pull-right"> {{$cliente->NIF}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                    <b>NISS</b> <a class="pull-right"> {{$cliente->NISS}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                    <b>Contacto </b> <a class="pull-right"> {{$cliente->contacto}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                        <b>Contacto Alternativo</b> <a class="pull-right"> {{$cliente->contactoAlternativo}}</a>
                                                      </li>
                                              </ul>
                                
                                              {!! Form::open(array('route' => 'cliente.editar','method'=>'POST','files'=>'true','style'=>'width:100%')) !!}
                                              <a href=""> <input id="invisible_id"  name="id" type="hidden" value="{{$cliente->pk_cliente}}">
                                                      <button type="submit" class="btn btn-success btn-block">Editar Informações
                                                     </button></a> 
                                                  
                                                    
                                       
                                                    
                                                        {!! Form::close()!!}
{{--                                                          
                                             <br> --}}
                                              {{-- <ul class="list-group list-group-unbordered">
                                                  <li class="list-group-item">
                                                    <b>Projetos em curso</b> <a class="pull-right">{{count($projetosTotal)}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                  <b>Projetos Concluidos</b> <a class="pull-right">{{count($projetosConcluidos)}}</a>
                                                  </li>
                                              
                                  
                                                </ul> --}}
                                            </div>
                                            <!-- /.box-body -->
                                          </div>   
                                          <!-- /.box -->
                                        </div>   
                                        <!-- /.col -->
                                          </div>
                                          <div class="row">
                                        <div class="col-md-12 col-xs-12 ">
                                          <div class="nav-tabs-custom" >
                                            <ul class="nav nav-tabs">
                                                <style>
                                                #tabs.active{
                                                    border-top:3px solid #00a65a !important;
                                                }</style>
                                
                                <div class="modal fade" id="edit-modal" tabindex="" role="dialog" aria-labelledby="edit-modal-label" >
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                    
                                        <div class="modal-body" id="attachment-body-content">
                                          <form id="edit-form" class="form-horizontal" method="POST" action="/gravarcontacto"> <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <div class="card text-white bg-dark mb-0">
                                              <div class="card-header">
                                                <h2 class="m-0">Adicionar Contacto</h2>
                                              </div>
                                              <div class="card-body">
                                                  @csrf
                                            
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
                                                          <input id="invisible_id"  name="fk_cliente" type="hidden" value="{{$cliente->pk_cliente}}">
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
                                            
                                                <a href="" ><button type="submit" class="btn btn-block btn-success btn-flat">
                                                        Adicionar</button></a>
                                           
                          
                                            {{-- <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              </div> --}}
                                          </form>
                                        </div>
                                       
                                      
                                      </div>
                                    </div>
                                  </div>                
                                                          <li id="tabs" class="active"><a href="#contacto" data-toggle="tab" aria-expanded="true">Agenda Cliente</a></li>
                                                          <li id="tabs" class=""><a href="#projeto" data-toggle="tab" aria-expanded="false">Projetos</a></li>
                                                          <li id="tabs" class=""><a href="#orcamentos" data-toggle="tab" aria-expanded="false">Orçamentos</a></li>

                                            </ul>
                                            <div class="tab-content">
                                                   

                                                <div id="contacto" class="tab-pane active ">



  <table id="example2" class="table table-striped table-bordered" style="width:100%">
    @if ($cliente->RGPD==0)
        
  
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
                        @foreach ($contacto as $contacto)
                      
                            <tr id="tr" >
                               
                                    {{-- dados da tabela --}}
                                 
                                    <td class="text-center">{{$contacto->funcao}}</td>
                                    <td class="text-center">{{$contacto->nome}}</td>
                                    <td class="text-center">{{$contacto->contacto1}}</td>
                                    <td class="text-center">{{$contacto->contacto2}}</td>
                                    <td class="text-center">{{$contacto->email}}</td>
                            
                                   
                                    <td>  {{--opçoes de gestão de clientes--}}
                                            <div class="text-center">
                                            <a href="editarcontato/{{$contacto->pk_contacto}}" class="btn btn-warning btn-sm far fa-edit" title="Editar clientes"></a> 
                                            {!! Form::open(array('route' => 'contacto.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                            {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                          <a href="" > <input id="aaa" name="id" type="hidden" value={{$contacto->pk_contacto}}><button type="submit" class="fas fa-trash-alt btn btn-danger">
                                                </button></a> 
                                            {!! Form::close()!!}  
                                          </div>
                                      
                                    </td>
                                </tr>

                         @endforeach
                       
                        </tbody>
                        @else
                        <p>Cliente com RGPD ativo</p>
        {{$cliente->dadosRGPD}}
                        @endif
                      </table>
                 
                      <div class="row" align="center">
                          <div class="col-xs-12 col-sm-12 col-md-4" >
                  
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-2" >
                             <button type="button"  id="edit-item"class="btn btn-block btn-success btn-flat">
                                              Adicionar Contacto</button>
                                  </div>

                                      <div class="col-xs-12 col-sm-12 col-md-2" >
                                              <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                      Voltar</button></a>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-4" >
                  
                              </div>
                  </div>
                                               
                    </div>   
                      


                  
                      {{--      projetos --}}
                                         
                      


                      <div id="projeto" class="tab-pane fade ">

                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
  
                                  <th class="text-center">Código Projeto</th>
                                  <th class="text-center">Estado</th>
                                  <th class="text-center">% Conclusão</th>
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
                          @foreach ($projetosTotal as $projeto)
                          <div class="hidden">
                              {{$pois=DB::table('projdeps')->where('fk_projeto',$projeto->pk_projeto)->get()}}
                              {{$percentagem1= (DB::table('tasks')->where('fk_projeto',$projeto->pk_projeto)->where('tipo',0)->value('progress'))*100}}
                              {{$percentagem="width: " .$percentagem1."%"}}
                      </div>
                              <tr id="tr" >
                                 
                                  <td class="text-center">{{$projeto->codProj}}</td>
                                  <td class="text-center">{{DB::table('estadoprojetos')->where('pk_estadoprojeto',$projeto->fk_estadoproj)->value('descricaoEstado')}}</td>
                                  <td>
                                      <div class="progress progress">{{'  '}}{{$percentagem1}}%
                                      <div class="progress-bar progress-bar-danger" style="{{$percentagem}}"></div>
                                      </div>
                                    </td>
                                  
                                  
                                  <td class="text-center">{{$projeto->nomeProjeto}}</td>
                                  <td class="text-center">{{$projeto->custoPrevisto}}€</td>
                                  <td class="text-center">
                                      @if ($projeto->custoReal==null)
                                          -- €
                                      @else
                                      {{$projeto->custoReal}}€</td>
                                      @endif
                                  
                                  <td class="text-center">{{DB::table('users')->where('id',$projeto->fk_responsavel)->value('sigla')}}</td>
                                  <td class="text-center">@foreach ($pois as $a)
                                       {{DB::table('departamentos')->where('pk_departamento',$a->fk_departamento)->value('abreviatura')}} <br> 
                                  @endforeach</td>
      
                                  <td class="text-center">Data Prevista Início:
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
                                 
                                  <td>  
                                     
                                  
                                              <div class="text-center">
                                              <a href="{{url('/')}}/verprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm far fa-eye" title="Ver Projeto"></a>
                                                </div>
                                         
                                        </td>

                                  </tr>
                           @endforeach
                          </tbody>
                        </table>
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

                      {{-- projetos  --}}
               
                                          
                                            </div>
                                            <!-- /.box-body -->
                                          </div>   
                                          <!-- /.box -->
                                        </div>   </div> 
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