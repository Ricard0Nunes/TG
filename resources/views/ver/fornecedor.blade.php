

                                @extends('adminlte::page')

                                @section('Fornecedor', 'Ver Fornecedor')
                                
                                
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
</script>
              
                                    <!-- Content Header (Page header) -->
                                    <section class="content-header">
                                      <h1>
                                       PERFIL DE FORNECEDOR
                                        {{-- @if ($fornecedor->RGPD==1)
                                         - RGPD ATIVO
                                        @endif --}}
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
                                                <img class=" zoomable" width="100%" src="{{asset($fornecedor->logo)}}" alt="User profile picture"><br>
                                                <h3 class="profile-username text-center">  {{$fornecedor->nomeCompleto}} - ({{$fornecedor->nomeAbreviado}})</h3>
                                
                                                {{-- <p class="text-muted text-center">     {{DB::table('empresas')->where('pk_empresa', '=', $fornecedor->fk_empresa)->value('nomeCompleto')}}</p> --}}
                                    
                                                </div>
                                                <div class="col-md-8 col-sm-12">
                                          
                                            <ul class="list-group list-group-unbordered">
                                             
                                                <li class="list-group-item">
                                                  <b>Email Prof</b> <a class="pull-right">   {{$fornecedor->email}} </a>
                                                </li>
                                                <li class="list-group-item">
                                                  <b>Morada</b> <a class="pull-right"> {{$fornecedor->morada}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>NIF</b> <a class="pull-right"> {{$fornecedor->NIF}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                    <b>Contacto </b> <a class="pull-right"> {{$fornecedor->contacto}}</a>
                                                  </li>
                                                  <li class="list-group-item">
                                                        <b>Contacto Alternativo</b> <a class="pull-right"> {{$fornecedor->contactoAlternativo}}</a>
                                                      </li>
                                              </ul>
                                
                                              {!! Form::open(array('route' => 'fornecedor.editar','method'=>'POST','files'=>'true','style'=>'width:100%')) !!}
                                              <a href=""> <input id="invisible_id"  name="id" type="hidden" value="{{$fornecedor->pk_fornecedor}}">
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
                                                          <input id="invisible_id"  name="fk_fornecedor" type="hidden" value="{{$fornecedor->pk_fornecedor}}">
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
                                                          <li id="tabs" class="active"><a href="#contacto" data-toggle="tab" aria-expanded="true">Compras</a></li>
                                                          {{-- <li id="tabs" class=""><a href="#compras" data-toggle="tab" aria-expanded="false">Compras</a></li> --}}
                                            </ul>
                                            <div class="tab-content">
                                                   

                                                <div id="contacto" class="tab-pane active ">



                                                  <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                            
                                                            <th class="text-center">#</th>
                                                         
                                                            <th class="text-center">Responsável</th>
                                                            <th class="text-center">Estado</th>
                                                            <th class="text-center">Criada a</th>
                                                            <th class="text-center">Fechada a</th>
                                                            <th class="text-center">Prev. Chegada</th>
                                                            <th class="text-center">Chegada</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Gerir</th>
                            
                            
                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($compras as $compra)
                                                  <tr>
                                                        {{-- dados da tabela --}}
                                                        <td class="text-justify">{{$compra->pk_compra}}</td>
                                                        <td class="text-justify">{{DB::table('users')->where('id',$compra->fk_responsavel)->value('name')}}</td>
                                                        <td class="text-justify">{{DB::table('estado_compra')->where('pk_estadocompra',$compra->fk_estadoCompra)->value('estado')}}</td>
                                                        <td class="text-justify">{{$compra->dataCompra}} </td>
                                                        <td class="text-justify">{{$compra->dataFechoCompra}} </td>
                            
                                                        <td class="text-justify">@if ($compra->fk_estadoCompra==2)
                                                        
                                                                {!! Form::open(array('route' => ['compras.dataprevista','id'=>$compra->pk_compra],'method'=>'POST','files'=>'true','class'=>'form-horizontal','style'=>'display:inline-block')) !!}
                                                               
                                                                  {!! Form::dateTimeLocal('dataprevista',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                                  <button type="submit" class="btn btn-success fas fa-search pull-right" style="display:inline-block">
                                                                    {!! Form::close()!!}
                                                             
                                                  
                                                        @else
                                                        {{$compra->dataPrevistaChega}}
                                                        @endif
                                                            
                                                            
                                                            
                                                             </td>
                                                        <td class="text-justify">
                                                            @if ($compra->fk_estadoCompra==3)
                                                                
                                                           
                                                    
                                                            {!! Form::open(array('route' => ['compras.chegada','id'=>$compra->pk_compra],'method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                           
                                                              {!! Form::dateTimeLocal('datachegada',null,['class'=>'form-control']) !!}
                                                             
                            
                                                                {!! Form::select('fk_armazem',$armazem,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o armazém','required'=>'required']) !!}
                                                          
                                                                
                                                            
                                                              <button type="submit" class="btn btn-success fas fa-chevron-circle-right pull-right" style="display:inline-block">
                                                                {!! Form::close()!!}
                                                         
                                                
                                                        @else
                                                        {{$compra->dataRecebimento}}     
                                                        @endif
                                                            
                                                    </td> 
                            
                                                      
                                                       
                            
                                                        <td class="text-center">{{DB::table('artigos_compra')->where('fk_compra',$compra->pk_compra)->sum('precoTotal')}}€</td>
                            
                            
                                                        <td>  {{--opçoes de gestão de clientes--}}
                                                                <div class="text-center">
                                                                    {!! Form::open(array('route' => 'compras.mostrar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                                    <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$compra->pk_compra}}">
                                                                            <button type="submit" class="btn btn-success btn-sm far fa-eye  pull-right">
                                                                           </button></a> 
                                                                           <div class="pull-right">
                                                                              <span style=" display: inline;">
                                                                          
                                                             
                                                                          
                                                                              {!! Form::close()!!}                                    </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                 
                      <div class="row" align="center">
                          <div class="col-xs-12 col-sm-12 col-md-4" >
                  
                              </div>
                              {{-- <div class="col-xs-12 col-sm-12 col-md-2" >
                             <button type="button"  id="edit-item"class="btn btn-block btn-success btn-flat">
                                              Adicionar Contacto</button>
                                  </div> --}}

                                      <div class="col-xs-12 col-sm-12 col-md-2" >
                                              <a href="/fornecedores" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                      Voltar</button></a>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-4" >
                  
                              </div>
                  </div>
                                               
                    </div>   
                      


                  
                      {{--      comprass --}}
                                         
                      


                      <div id="compras" class="tab-pane fade ">

                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
  
                              </tr>
                          </thead>
                          <tbody>
                        
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