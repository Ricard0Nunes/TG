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
                <h1 class="box-title" >MOSTRAR CAMPANHAS</h1>
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

                                <th class="text-center">Data Início</th>
                                <th class="text-center">Data Fim</th>
                                <th class="text-center">Observações</th>
                                <th class="text-center">Eficácia</th>
                                <th class="text-center">Tipo Campanha</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Gerir</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($campanha as $campanha)
                      <tr>
                         
                            {{-- dados da tabela --}}
                            {{-- <td class="text-center">{{$campanha->dataInicio}}</td> --}}
                            <td class="text-center"> {{ Carbon\Carbon::parse($campanha->dataInicio)->format('Y-m-d') }}</td>
                            <td class="text-center"> {{ Carbon\Carbon::parse($campanha->dataFim)->format('Y-m-d') }}</td>
                            {{-- <td class="text-center">{{$campanha->dataFim}}</td> --}}
                            <td class="text-center">{{$campanha->observacoes}}</td>
                            <td class="text-center">{{$campanha->eficacia}}</td>
                            <td class="text-center"> {{DB::table('crm_tipo_campanhas')->where('pk_tipo_campanha',$campanha->fk_tipo_campanha)->value('tipoCampanha')}}</td>
                            <td class="text-center"> {{DB::table('users')->where('id',$campanha->fk_responsavel)->value('name')}}</td>
                            <td class="text-center">

                              {{-- {!! Form::open(array('route' => 'campanha.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'ver')) }}
                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$campanha->pk_campanha}}><button type="submit" class="fas fa-eye btn btn-success" title="Ver Campanha"> 
                              </button></a>     
                              {!! Form::close()!!} --}}

                              {!! Form::open(array('route' => 'campanha.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$campanha->pk_campanha}}><button type="submit" class="fas fa-pencil-alt btn btn-warning" title="Editar Campanha"> 
                              </button></a>     
                              {!! Form::close()!!}

                              {!! Form::open(array('route' => 'campanha.delete','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$campanha->pk_campanha}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Apagar Campanha"> 
                              </button></a>     
                              {!! Form::close()!!}

                              

                            </td>
                     
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                    <div class="row" align="center">
                        <div class="col-xs-12 col-sm-12 col-md-2" >
                
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3" >
                                <a href="{{url('/')}}/tipocampanha" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Mostrar Tipo de Campanha</button></a>
                                    </div>
                            <div class="col-xs-12 col-sm-12 col-md-3" >
                            <a href="{{url('/')}}/novacampanha" ><button type="button" class="btn btn-block btn-success btn-flat">
                                            Criar Campanha</button></a>
                                </div>

                                    <div class="col-xs-12 col-sm-12 col-md-3" >
                                            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                    Voltar</button></a>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3" > 
                            </div>
                </div> 
                    <br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




