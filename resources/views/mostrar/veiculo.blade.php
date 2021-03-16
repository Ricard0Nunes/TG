@extends('adminlte::page')

@section('Veículo', 'AdminLTE')




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
<style>
td:hover{
    background-color: #e2e2e2;
}


</style>
<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR VEÍCULO</h1>
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

                                <th class="text-center">Matrícula</th>
                                <th class="text-center">Data da Matrícula</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Modelo</th>
                                <th class="text-center">Kms</th>
                                <th class="text-center">Autonomia</th>
                                <th class="text-center">Localização</th>
                                <th class="text-center">Nif Empresa</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($veiculo as $veiculo)
                  
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$veiculo->matricula}}</td>
                            <td class="text-center">{{$veiculo->dataMatricula}}</td>
                           
                            <td class="text-center">{{$veiculo->marca}}</td>
                            <td class="text-center">{{$veiculo->modelo}}</td>
                            <td class="text-center">{{$veiculo->kms}}</td>
                            <td class="text-center">{{$veiculo->autonomia}}</td>
                            <td class="text-center">{{$veiculo->localizacao}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$veiculo->nifEmpresa)->value('nomeAbreviado')}}</td>
                            <td class="text-center">
                                <a href="editarveiculo/{{$veiculo->pk_veiculo}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Veiculo"></a> {{--Editar recurso--}}


                                {{-- {!! Form::open(array('route' => 'veiculo.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                            <a>   <input id="invisible_id" name="id" type="hidden"  value="{{$veiculo->pk_veiculo}}"}>
                                <button type="submit" class="btn btn-warning far fa-edit"  text=""  title="Editar Veículo"> 
                               </button></a>
                                    {!! Form::close()!!}  --}}
                                 
                               </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
               
                {{-- <a href="novoveiculo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar veiculo</a> Editar recurso --}}

            </div>
      
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/novoveiculo" ><button type="button" class="btn btn-block btn-success btn-flat">
                                    Criar Veículo</button></a>
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




