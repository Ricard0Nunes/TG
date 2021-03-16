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
                <h1 class="box-title" >MOSTRAR INVENTÁRIO ARMAZEM: {{$armazem->nome}}</h1>
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

                                <th class="text-center">Sku</th>
                                <th class="text-center">Artigo</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center">Ultimo Preço Compra</th>
                                <th class="text-center">Total Mercadoria</th>

                                <th class="text-center">Corrigir Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($inventario as $inventario)
                      <tr>
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$inventario->sku}}</td>
                            <td class="text-center">{{$inventario->descricao}}</td>
                            <td class="text-center">{{$inventario->quantidade}}</td>
                            <td class="text-center">{{$inventario->ultimoPrecoCompra}}</td>
                            <td class="text-center">{{$inventario->ultimoPrecoCompra*$inventario->quantidade}}</td>


                            <td>  {{--opçoes de gestão de clientes--}}
                               
                                    <div class="text-center">
                                        {!! Form::open(array('route' => 'inventario.corrigir','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                        {{ Form::number('quantidade', 'value')}}
                                        <a href="" > <input id="invisible_id"  name="inventario" type="hidden" value="{{$inventario->pk_inventario}}" >
                                            
                                            <button type="submit" class="btn btn-primary btn far fa-check-square  pull-right" title="Corrigir Quantidade"> 

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
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                         

                                        <div class="col-xs-12 col-sm-12 col-md-3" >
                                                <a href="/armazens" ><button type="button" class="btn btn-block btn-warning btn-flat">
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




