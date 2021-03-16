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
                <h1 class="box-title" >MOSTRAR ARTIGOS</h1>
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
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Caracteristicas</th>
                                <th class="text-center">Preço</th>
                                <th class="text-center">Preço Compra Médio</th>
                                <th class="text-center">Peso (kg)</th>
                                <th class="text-center">Família</th>
                                <th class="text-center">Descontinuado</th>
                           
                             
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($artigo as $artigo)
                      <tr>
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$artigo->sku}}</td>
                        </td>
                        <td class="text-center">
                          @if ($artigo->tipoartigo==0)
                              Produto
                          @elseif ($artigo->tipoartigo==1)
                              Protução Própria
                          @else
                              Serviço
                          @endif
                        </td>
                            <td class="text-center"><img src="{{asset($artigo->foto)}}"class="img-circle img-sm" alt={{$artigo->sku}}> </td>
                            <td class="text-center">{{$artigo->descricao}}</td>
                            <td class="text-center">{{$artigo->caracteristicas}}</td>
                            <td class="text-center">{{number_format($artigo->precoCompra,2 ,'.', '')}}</td>
                            <td class="text-center">{{number_format(App\artigoscompra::where('fk_artigo',$artigo->pk_artigo)->leftjoin('compras','pk_compra','fk_compra')->where('fk_estadocompra',4)->avg('precoUnitario'),2 ,'.', '') }}</td>
                            <td class="text-center">{{number_format($artigo->peso,2 ,'.', '')}}</td>
                            <td class="text-center">{{DB::table('familia_artigos')->where('pk_familiaartigos',$artigo->fk_familiaartigos)->value('descricao')}}</td>
                            <td class="text-center">@if ($artigo->descontinuado==0)
                                Não
                            @else
                                Sim
                            @endif
                             
                            <td>  {{--opçoes de gestão de clientes--}}
                                    <div class="text-center">
                                        {!! Form::open(array('route' => 'artigo.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                        <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$artigo->pk_artigo}}">
                                                <button type="submit" class="btn btn-warning btn-sm far fa-edit pull-right" title="Editar Artigo">
                                               </button></a> 
                                               <div class="pull-right">
                                                  <span style=" display: inline;">
                                              
                                 
                                              
                                                  {!! Form::close()!!}                                    </div>


                                                  {!! Form::open(array('route' => 'artigo.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                  <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$artigo->pk_artigo}}">
                                                          <button type="submit" class="btn btn-success btn-sm far fa-eye  pull-right" title="Ver Artigo">
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
                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                <a href="{{url('/')}}/novoartigo" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar artigo</button></a>
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




