@extends('adminlte::page')

@section('Equipamento', 'AdminLTE')




@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').dataTable( {
            "language": {
                "url": "js/localeDataTable.js"
            },
            "scrollX": true,
            "autoWidth":false,
         
  
        } );
    } );
    
   
</script>

<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR EQUIPAMENTO</h1>
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
                <div class="col-md-12 col-xs-12">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th class="text-center">Código</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Modelo</th>
                                <th class="text-center">Data de Aquisição</th>
                                <th class="text-center">Fornecedor</th>
                                <th class="text-center">Nº Série</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">SI</th>
                                <th class="text-center">Fatura</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Requisitado</th>

                                <th class="text-center">Observações</th>
                                <th class="text-center">Defeitos</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($equipamento as $equipamento)
                  
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$equipamento->codigo}}</td>
                            <td class="text-justify">{{$equipamento->marca}}</td>
                            <td class="text-justify">{{$equipamento->modelo}}</td>
                            <td class="text-justify">{{$equipamento->dataAquisicao}}</td>
                            <td class="text-justify">{{$equipamento->fornecedor}}</td>
                            <td class="text-justify">{{$equipamento->numeroSerie}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$equipamento->nifEmpresa)->value('nomeAbreviado')}}</td>
                            <td class="text-justify">{{$equipamento->SI}}</td>
                            <td class="text-justify">{{$equipamento->fatura}}</td>
                            <td class="text-justify">{{$equipamento->status}}</td>
                            <td class="text-center">
                                @if ($equipamento->requisitado==0)
                                <span class="badge bg-green">Livre</span> 
                                @else
                                <span class="badge bg-red">Requisitado</span> 
                                @endif
                            </td>
                     
                            <td class="text-justify">{{$equipamento->observacoes}}</td>
                            <td class="text-justify">{{$equipamento->manutencao}}</td>








                         
                            <td class="text-center">
                                {!! Form::open(array('route' => 'equipamento.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$equipamento->pk_equipamento}}>
                                    <button type="submit" class="btn btn-success fas fa-eye" text="Ver Projeto" title="Ver Equipamento"> 
                                   </button>
                                </a> 
                                    {!! Form::close()!!} 
                               

                                {!! Form::open(array('route' => 'equipamento.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                            <a>   <input id="invisible_id" name="id" type="hidden"  value="{{$equipamento->pk_equipamento}}"}>
                                <button type="submit" class="btn btn-warning far fa-edit"  text="" title="Editar Equipamento"> 
                               </button></a>
                                    {!! Form::close()!!} 
                                 
                               </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
               
                {{-- <a href="novoequipamento" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar equipamento</a> Editar recurso --}}

            </div>
      
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/novoequipamento" ><button type="button" class="btn btn-block btn-success btn-flat">
                                    Criar Equipamento</button></a>
                        </div>

                            <div class="col-xs-12 col-sm-12 col-md-2" >
                                    <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                            Voltar</button></a>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
        </div><br><br>
    </div> 
@endsection




