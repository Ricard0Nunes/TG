@extends('adminlte::page')
@section('Cargos', 'AdminLTE')
@section('content')
    <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});
        });
    </script>

<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR ENCOMENDAS</h1>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->

        <div class="box-body">
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                              @if(Session::has('success'))
                        <div class="alert alert-success">
                              {{ Session::get('success')}}
                        </div>
                             @endif 
                        </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>

                                <th class="text-center">#</th>
                                <th class="text-center">Fornecedor</th>
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
                        @foreach ($compra as $compra)
                      <tr>
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$compra->pk_compra}}</td>
                            <td class="text-justify">{{DB::table('fornecedores')->where('pk_fornecedor',$compra->fk_fornecedor)->value('nomeAbreviado')}}</td>
                        
                            <td class="text-justify">{{DB::table('users')->where('id',$compra->fk_responsavel)->value('name')}}</td>
                            <td class="text-justify">{{DB::table('estado_compra')->where('pk_estadocompra',$compra->fk_estadoCompra)->value('estado')}}</td>
                            <td class="text-justify">{{$compra->dataCompra}} </td>
                            <td class="text-justify">{{$compra->dataFechoCompra}} </td>

                            <td class="text-justify">@if ($compra->fk_estadoCompra==2)
                            
                                    {!! Form::open(array('route' => ['compras.dataprevista','id'=>$compra->pk_compra],'method'=>'POST','files'=>'true','class'=>'form-horizontal','style'=>'display:inline-block')) !!}
                                   
                                      {!! Form::dateTimeLocal('dataprevista',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                      <button type="submit" class="btn btn-success fas fa-chevron-circle-right  pull-right" style="display:inline-block">
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
                                                <button type="submit" class=" btn btn-success btn-sm far fa-eye " title="Ver">
                                               </button></a> 
                                               <div class="pull-right">
                                                  <span style=" display: inline;"> 
                                              
                                 
                                              
                                                  {!! Form::close()!!}                                    </div>
                                @if ($compra->fk_estadoCompra==1)
                                {!! Form::open(array('route' => 'compras.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                <a href="" > <input id="aaa" name="id" type="hidden" value={{$compra->pk_compra}}><button type="submit" class="fas fa-trash-alt btn btn-danger btn-sm" title="Eliminar Encomenda"> 
                                </button></a>                  
                                {!! Form::close()!!}
                                @endif
                                                
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                <a href="{{url('/')}}/novocompra" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Nova Encomenda</button></a>
                                    </div>

                                        <div class="col-xs-12 col-sm-12 col-md-2" >
                                                <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                        Voltar</button></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




