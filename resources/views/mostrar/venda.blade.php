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
          }});;
        });
    </script>

<div class="box  box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR VENDAS</h1>
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
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Criada a</th>
                                <th class="text-center">Fechada a</th>
                                <th class="text-center">Paga a</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Gerir</th>



                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($venda as $venda)
                      <tr>
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$venda->pk_venda}}</td>
                            <td class="text-center">{{DB::table('clientes')->where('pk_cliente',$venda->fk_cliente)->value('nomeAbreviado')}}</td>
                        
                            <td class="text-center">{{DB::table('users')->where('id',$venda->fk_responsavel)->value('name')}}</td>
                            <td class="text-center">{{DB::table('estado_vendas')->where('pk_estadovenda',$venda->fk_estadovenda)->value('estado')}}</td>
                            <td class="text-center">{{$venda->dataVenda}} </td>
                            <td class="text-center">{{$venda->dataFechoVenda}} </td>
                            <td class="text-center">@if ($venda->fk_estadovenda==2)
                              
                    
                                    {!! Form::open(array('route' => ['venda.recebimento','id'=>$venda->pk_venda],'method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   
                                      {!! Form::dateTimeLocal('dataRecebimento',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                      <button type="submit" class="btn btn-success fas fa-chevron-circle-right pull-right" style="display:inline-block">
                                        {!! Form::close()!!}
                                 
                                       
                  
                            @else
                            {{$venda->dataRecebimento}}
                            @endif </td>

                            
                                
                     

                          
                           

                            <td class="text-center">{{DB::table('artigos_venda')->where('fk_venda',$venda->pk_venda)->sum('precoTotal')}}€</td>


                            <td class="text-justify">  {{--opçoes de gestão de clientes--}}
                                    
                                        {!! Form::open(array('route' => 'venda.mostrar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                        <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$venda->pk_venda}}">
                                                <button type="submit" class="btn btn-success btn-sm far fa-eye  pull-right" title="Ver Venda">
                                               </button></a> 
                                              
                                 
                                              
                                                  {!! Form::close()!!}         
                                
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
                                <a href="{{url('/')}}/novovenda" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Nova Venda</button></a>
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




